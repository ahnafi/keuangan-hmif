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
        $request->validate([
            'administrator_id' => 'required|exists:administrators,id',
            'fund_id' => 'required|exists:funds,id',
            'month' => 'required|in:april,may,june,july,august,september,october,november',
            'penalty' => 'required|integer|min:0',
            'cash_amount' => 'required|integer|min:0',
            'date' => 'required|date',
        ]);

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

        // Create cash-fund relationship
        $cash->funds()->attach($request->fund_id, [
            'date' => $request->date,
            'month' => $request->month,
            'penalty' => $request->penalty
        ]);


        // Update the specific month in cash table with the cash amount + penalty
        $totalAmount = $request->cash_amount + $request->penalty;
        $cash->update([
            $request->month => $cash->{$request->month} + $totalAmount
        ]);

        return redirect()->route('home')->with('success', 'Data kas berhasil ditambahkan. Kas bulan ' . ucfirst($request->month) . ' diperbarui dengan jumlah Rp ' . number_format($totalAmount, 0, ',', '.') . ' (Kas: Rp ' . number_format($request->cash_amount, 0, ',', '.') . ' + Denda: Rp ' . number_format($request->penalty, 0, ',', '.') . ')');
    }

    public function edit(Cash $cash)
    {
        $cash->load('administrator.division', 'funds');
        // Get cash-fund history with fund details
        $cashHistory = $cash->funds()->withPivot('id', 'date', 'month', 'penalty')->get();
        return view("pages.cash.edit", compact('cash', 'cashHistory'));
    }

    public function update(Request $request, Cash $cash)
    {
        $request->validate([
            'april' => 'nullable|integer|min:0',
            'may' => 'nullable|integer|min:0',
            'june' => 'nullable|integer|min:0',
            'july' => 'nullable|integer|min:0',
            'august' => 'nullable|integer|min:0',
            'september' => 'nullable|integer|min:0',
            'october' => 'nullable|integer|min:0',
            'november' => 'nullable|integer|min:0',
        ]);

        $cash->update($request->all());

        return redirect()->route('home')->with('success', 'Data kas berhasil diperbarui.');
    }

    public function destroyHistory(Cash $cash, $fundId)
    {
        // Get the pivot data before deleting
        $pivotData = $cash->funds()->wherePivot('fund_id', $fundId)->first();

        if ($pivotData) {
            $month = $pivotData->pivot->month;
            $penalty = $pivotData->pivot->penalty;

            // Remove the penalty from the cash month
            $currentAmount = $cash->{$month};
            $newAmount = max(0, $currentAmount - $penalty); // Ensure not negative
            $cash->update([$month => $newAmount]);

            // Delete the relationship
            $cash->funds()->detach($fundId);

            return redirect()->route('cash.edit', $cash)->with('success', 'Histori pembayaran berhasil dihapus dan kas bulan ' . ucfirst($month) . ' telah diperbarui.');
        }

        return redirect()->route('cash.edit', $cash)->with('error', 'Histori tidak ditemukan.');
    }

    public function updateHistory(Request $request, Cash $cash, $fundId)
    {
        $request->validate([
            'date' => 'required|date',
            'month' => 'required|in:april,may,june,july,august,september,october,november',
            'penalty' => 'required|integer|min:0',
        ]);

        // Get current pivot data
        $currentPivot = $cash->funds()->wherePivot('fund_id', $fundId)->first();

        if ($currentPivot) {
            $oldMonth = $currentPivot->pivot->month;
            $oldPenalty = $currentPivot->pivot->penalty;

            // Remove old penalty from old month
            $oldMonthAmount = $cash->{$oldMonth};
            $cash->update([$oldMonth => max(0, $oldMonthAmount - $oldPenalty)]);

            // Update pivot data
            $cash->funds()->updateExistingPivot($fundId, [
                'date' => $request->date,
                'month' => $request->month,
                'penalty' => $request->penalty,
                'updated_at' => now(),
            ]);

            // Add new penalty to new month
            $newMonthAmount = $cash->{$request->month};
            $cash->update([$request->month => $newMonthAmount + $request->penalty]);

            return redirect()->route('cash.edit', $cash)->with('success', 'Histori pembayaran berhasil diperbarui.');
        }

        return redirect()->route('cash.edit', $cash)->with('error', 'Histori tidak ditemukan.');
    }

    public function transaction()
    {
        $transactions = Cash::with(['administrator.division', 'funds' => function($query) {
            $query->withPivot(['date', 'month', 'penalty']);
        }])->paginate(10);
        
        return response()->json($transactions);
    }
}
