<?php

namespace App\Http\Controllers;

use App\Models\Administrator;
use App\Models\Deposit;
use App\Models\DepositPenalty;
use App\Models\Fund;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DepositController extends Controller
{
    public function index()
    {
        // Use database transactions for better performance
        $deposits = Deposit::withFullData()->get();

        // Only load funds if needed
        $funds = Fund::select('id', 'name')->get();
        $administrators = Administrator::select("id", "name")->get();

        return view("pages.deposit", compact("deposits", "funds", "administrators"));
    }

    public function history()
    {
        $penalties = DepositPenalty::with([
            'deposit.administrator.division'
        ])->paginate(15);

        // Get pivot data with pagination using direct DB query
        $histories = DB::table('deposit_fund')
            ->join('deposits', 'deposit_fund.deposit_id', '=', 'deposits.id')
            ->join('funds', 'deposit_fund.fund_id', '=', 'funds.id')
            ->join('administrators', 'deposits.administrator_id', '=', 'administrators.id')
            ->join('divisions', 'administrators.division_id', '=', 'divisions.id')
            ->select([
                'deposit_fund.id',
                'deposit_fund.deposit_id',
                'deposit_fund.fund_id',
                'deposit_fund.date',
                'deposit_fund.amount',
                'deposit_fund.created_at',
                'deposit_fund.updated_at',
                'funds.name as fund_name',
                'administrators.name as administrator_name',
                'divisions.name as division_name'
            ])
            ->orderBy('deposit_fund.created_at', 'desc')
            ->paginate(15);

        return response()->json([
            "history" => $histories,
            "penalty" => $penalties
        ]);
        // return view("pages.deposit-history", compact("histories"));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            "date" => "required|date",
            "amount" => "required|numeric|min:1",
            'fund_id' => 'required|exists:funds,id',
            'administrator_id' => 'required|exists:administrators,id',
        ], [
            'date.required' => 'Tanggal harus diisi.',
            'date.date' => 'Format tanggal tidak valid.',
            'amount.required' => 'Jumlah deposit harus diisi.',
            'amount.numeric' => 'Jumlah deposit harus berupa angka.',
            'amount.min' => 'Jumlah deposit minimal adalah 1.',
            'fund_id.required' => 'Dana harus dipilih.',
            'fund_id.exists' => 'Dana yang dipilih tidak valid.',
            'administrator_id.required' => 'Pengurus harus dipilih.',
            'administrator_id.exists' => 'Pengurus yang dipilih tidak valid.',
        ]);

        try {
            // Use database transaction for data integrity
            DB::transaction(function () use ($validated) {
                $deposit = Deposit::firstOrCreate(
                    ["administrator_id" => $validated["administrator_id"]],
                    ["administrator_id" => $validated["administrator_id"]]
                );

                // Check if this fund is already attached to avoid duplicates
                if (!$deposit->funds()->where('fund_id', $validated['fund_id'])->exists()) {
                    $deposit->funds()->attach($validated['fund_id'], [
                        "date" => $validated["date"],
                        "amount" => $validated["amount"]
                    ]);
                } else {
                    // Update existing record
                    $deposit->funds()->updateExistingPivot($validated['fund_id'], [
                        "date" => $validated["date"],
                        "amount" => $validated["amount"]
                    ]);
                }
            });

            return back()->with("success", "Deposit telah dibayar");
        } catch (\Exception $err) {
            return back()->with("error", "Deposit gagal dibayar: " . $err->getMessage());
        }
    }

    public function update()
    {

    }

    public function destroy()
    {

    }

    // manage administrator deposit and penalty
    public function manage(Deposit $deposit)
    {
        // Load the deposit with all necessary relationships
        $deposit->load([
            'administrator.division',
            'funds' => function ($query) {
                $query->withPivot('date', 'amount');
            }
        ]);

        $penalties = $deposit->depositPenalties()->paginate(15);
        $depositFunds = $deposit->funds;

        return response()->json([
            'deposit' => $deposit,
            'penalties' => $penalties,
            'depositFunds' => $depositFunds
        ]);
        // return view('pages.deposit-manage', compact('deposit', 'penalties', 'depositFunds'));
    }

}
