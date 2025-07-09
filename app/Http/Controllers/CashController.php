<?php

namespace App\Http\Controllers;

use App\Models\Cash;
use App\Models\Administrator;
use App\Models\Fund;
use Illuminate\Http\Request;

class CashController extends Controller
{
    public function index()
    {
        $cashs = Cash::with(["administrator.division", "funds"])->get();

        // Calculate totals for each month
        $totals = [
            'april' => $cashs->sum('april'),
            'may' => $cashs->sum('may'),
            'june' => $cashs->sum('june'),
            'july' => $cashs->sum('july'),
            'august' => $cashs->sum('august'),
            'september' => $cashs->sum('september'),
            'october' => $cashs->sum('october'),
            'november' => $cashs->sum('november'),
        ];

        // Calculate grand total
        $grandTotal = array_sum($totals);
        return response()->view("pages.home", compact("cashs", "totals", "grandTotal"));
    }

    public function create()
    {
        $administrators = Administrator::with('division')->get();
        $funds = Fund::all();
        return view("pages.cash.create", compact('administrators', 'funds'));
    }

    public function store(Request $request)
    {
        // Check if we have an administrator_id to determine the redirect location
        $isFromHistoryPage = $request->has('administrator_id') && $request->header('referer') && 
                            str_contains($request->header('referer'), '/history');
        
        // Validate the request
        try {
            $validated = $request->validate([
                'administrator_id' => 'required|exists:administrators,id',
                'fund_id' => 'required|exists:funds,id',
                'month' => 'required|in:april,may,june,july,august,september,october,november',
                'penalty' => 'required|integer|min:0',
                'cash_amount' => 'required|integer|min:5000',
                'date' => 'required|date',
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            // If validation fails and we're from history page, redirect there
            if ($isFromHistoryPage && $request->administrator_id) {
                $cash = Cash::where('administrator_id', $request->administrator_id)->first();
                if ($cash) {
                    return redirect()->route('cash.history', $cash)->withErrors($e->validator)->withInput();
                }
            }
            // Otherwise, use default validation behavior
            throw $e;
        }

        // Find or create cash record for the administrator
        $cash = Cash::firstOrCreate(
            ['administrator_id' => $request->administrator_id],
            [
                'administrator_id' => $request->administrator_id,
                'april' => 0,
                'may' => 0,
                'june' => 0,
                'july' => 0,
                'august' => 0,
                'september' => 0,
                'october' => 0,
                'november' => 0,
            ]
        );

        // Check if cash for this month has already been paid by this administrator
        $existingPayment = $cash->funds()
            ->wherePivot('month', $request->month)
            ->exists();

        if ($existingPayment) {
            // Check if request came from history page
            if ($request->header('referer') && str_contains($request->header('referer'), '/cash/' . $cash->id . '/history')) {
                return redirect()->route('cash.history', $cash)
                    ->withInput()
                    ->with('error', 'Kas bulan ' . ucfirst($request->month) . ' untuk pengurus ini sudah dibayar sebelumnya.');
            }
            
            return redirect()->back()
                ->withInput()
                ->with('error', 'Kas bulan ' . ucfirst($request->month) . ' untuk pengurus ini sudah dibayar sebelumnya.');
        }

        $totalAmount = $request->cash_amount + $request->penalty;

        // Create cash-fund relationship
        $cash->funds()->attach($request->fund_id, [
            'date' => $request->date,
            'month' => $request->month,
            'penalty' => $request->penalty,
            'cash' => $request->cash_amount,
            'amount' => $totalAmount
        ]);

        // Update the specific month in cash table with the cash amount + penalty
        $cash->update([
            $request->month => $totalAmount
        ]);

        // Check if request came from history page
        if ($request->header('referer') && str_contains($request->header('referer'), '/cash/' . $cash->id . '/history')) {
            return redirect()->route('cash.history', $cash)
                ->with('success', 'Data kas berhasil ditambahkan. Kas bulan ' . ucfirst($request->month) . ' diperbarui dengan jumlah Rp ' . number_format($totalAmount, 0, ',', '.') . ' (Kas: Rp ' . number_format($request->cash_amount, 0, ',', '.') . ' + Denda: Rp ' . number_format($request->penalty, 0, ',', '.') . ')');
        }

        return back()->with('success', 'Data kas berhasil ditambahkan. Kas bulan ' . ucfirst($request->month) . ' diperbarui dengan jumlah Rp ' . number_format($totalAmount, 0, ',', '.') . ' (Kas: Rp ' . number_format($request->cash_amount, 0, ',', '.') . ' + Denda: Rp ' . number_format($request->penalty, 0, ',', '.') . ')');
    }

    public function history(Cash $cash)
    {
        $cash->load('administrator.division', 'funds');
        // Get cash-fund history with fund details
        $cashHistory = $cash->funds()->withPivot('id', 'date', 'month', 'penalty', 'cash', 'amount')->get();
        return view("pages.cash.history", compact('cash', 'cashHistory'));
    }

    public function destroyHistory(Cash $cash, $pivotId)
    {
        // Get the specific pivot data using the pivot ID
        $pivotData = $cash->funds()
            ->wherePivot('id', $pivotId)
            ->first();

        if ($pivotData) {
            $month = $pivotData->pivot->month;
            $cash->update([$month => 0]);

            // Delete only the specific pivot relationship using the pivot ID
            $cash->funds()->wherePivot('id', $pivotId)->detach();

            return redirect()->route('cash.history', $cash)->with('success', 'Histori pembayaran berhasil dihapus dan kas bulan ' . ucfirst($month) . ' telah diperbarui.');
        }

        return redirect()->route('cash.history', $cash)->with('error', 'Histori tidak ditemukan.');
    }

    public function updateHistory(Request $request, Cash $cash, $pivotId)
    {
        $request->validate([
            'fund_id' => 'required|exists:funds,id',
            'month' => 'required|in:april,may,june,july,august,september,october,november',
            'penalty' => 'required|integer|min:0',
            'cash_amount' => 'required|integer|min:0',
            'date' => 'required|date',
        ]);

        // Get current pivot data using pivot ID
        $currentPivot = $cash->funds()->wherePivot('id', $pivotId)->first();

        if (!$currentPivot) {
            return redirect()->route('cash.history', $cash)->with('error', 'Histori tidak ditemukan.');
        }

        $oldMonth = $currentPivot->pivot->month;
        $oldAmount = $currentPivot->pivot->amount;
        $oldFundId = $currentPivot->pivot->fund_id;

        // Check if trying to change to a month/fund combination that already exists (excluding current record)
        if ($request->month != $oldMonth || $request->fund_id != $oldFundId) {
            $existingPayment = $cash->funds()
                ->wherePivot('month', $request->month)
                ->wherePivot('fund_id', $request->fund_id)
                ->wherePivot('id', '!=', $pivotId)
                ->exists();

            if ($existingPayment) {
                return redirect()->back()
                    ->withInput()
                    ->with('error', 'Kas bulan ' . ucfirst($request->month) . ' untuk dana ini sudah dibayar sebelumnya.');
            }
        }

        $newTotalAmount = $request->cash_amount + $request->penalty;

        // Remove old amount from old month
        $oldMonthAmount = $cash->{$oldMonth};
        $cash->update([$oldMonth => max(0, $oldMonthAmount - $oldAmount)]);

        // Update pivot data
        $cash->funds()->wherePivot('id', $pivotId)->updateExistingPivot($currentPivot->id, [
            'fund_id' => $request->fund_id,
            'date' => $request->date,
            'month' => $request->month,
            'penalty' => $request->penalty,
            'cash' => $request->cash_amount,
            'amount' => $newTotalAmount,
            'updated_at' => now(),
        ]);

        // Add new amount to new month
        $newMonthAmount = $cash->{$request->month};
        $cash->update([$request->month => $newMonthAmount + $newTotalAmount]);

        return redirect()->route('cash.history', $cash)->with('success', 'Histori pembayaran berhasil diperbarui. Kas bulan ' . ucfirst($request->month) . ' diperbarui dengan jumlah Rp ' . number_format($newTotalAmount, 0, ',', '.') . ' (Kas: Rp ' . number_format($request->cash_amount, 0, ',', '.') . ' + Denda: Rp ' . number_format($request->penalty, 0, ',', '.') . ')');
    }

    public function transaction()
    {
        $transactions = Cash::with([
            'administrator.division',
            'funds' => function ($query) {
                $query->withPivot(['date', 'month', 'penalty']);
            }
        ])->paginate(10);

        return response()->json($transactions);
    }
}
