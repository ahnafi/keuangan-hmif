<?php

namespace App\Http\Controllers;

use App\Models\Administrator;
use App\Models\Deposit;
use App\Models\DepositPenalty;
use Illuminate\Http\Request;

class DepositPenaltyController extends Controller
{

    public function index()
    {
        $penalties = DepositPenalty::with([
            'deposit.administrator.division'
        ])->orderBy("date", "desc")->paginate(15);
        $administrators = Administrator::select("id", "name")->get();

        return view("pages.deposit.history", compact("penalties", "administrators"));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'administrator_id' => 'required|exists:administrators,id',
            'amount' => 'required|numeric|min:1',
            'date' => 'required|date',
            'detail' => 'required|in:plenary_meeting,jacket_day,graduation_ceremony,secretariat_maintenance,work_program,other'
        ], [
            'administrator_id.required' => 'Pengurus harus dipilih.',
            'administrator_id.exists' => 'Pengurus yang dipilih tidak valid.',
            'amount.required' => 'Jumlah denda harus diisi.',
            'amount.numeric' => 'Jumlah denda harus berupa angka.',
            'amount.min' => 'Jumlah denda minimal adalah 1.',
            'date.required' => 'Tanggal denda harus diisi.',
            'date.date' => 'Format tanggal tidak valid.',
            'detail.required' => 'Jenis denda harus dipilih.',
            'detail.in' => 'Jenis denda yang dipilih tidak valid. Pilih salah satu: Raplen, JahimDay, Wisuda, Pesek, Proker, atau Lainnya.',
        ]);

        try {
            // Get or create deposit for the administrator
            $deposit = Deposit::firstOrCreate([
                "administrator_id" => $validated["administrator_id"]
            ]);

            // Create the penalty record
            DepositPenalty::create([
                "deposit_id" => $deposit->id,
                "amount" => $validated["amount"],
                "date" => $validated["date"],
                "detail" => $validated["detail"]
            ]);

            // Update the corresponding deposit field
            $deposit->increment($validated["detail"], $validated["amount"]);

            return back()->with("success", "Denda deposit berhasil ditambahkan");
        } catch (\Exception $err) {
            return back()->with("error", "Denda deposit gagal ditambahkan: " . $err->getMessage());
        }
    }

    public function update(Deposit $deposit, DepositPenalty $depositPenalty, Request $request)
    {
        $validated = $request->validate([
            'amount' => 'required|numeric|min:1',
            'date' => 'required|date',
            'detail' => 'required|in:plenary_meeting,jacket_day,graduation_ceremony,secretariat_maintenance,work_program,other'
        ], [
            'amount.required' => 'Jumlah denda harus diisi.',
            'amount.numeric' => 'Jumlah denda harus berupa angka.',
            'amount.min' => 'Jumlah denda minimal adalah 1.',
            'date.required' => 'Tanggal denda harus diisi.',
            'date.date' => 'Format tanggal tidak valid.',
            'detail.required' => 'Jenis denda harus dipilih.',
            'detail.in' => 'Jenis denda yang dipilih tidak valid.',
        ]);

        try {
            // Get the old values to adjust the deposit amounts
            $oldAmount = $depositPenalty->amount;
            $oldDetail = $depositPenalty->detail;
            
            // If detail changed, adjust the deposit amounts
            if ($oldDetail !== $validated['detail']) {
                // Remove old amount from old detail
                $deposit->decrement($oldDetail, $oldAmount);
                // Add new amount to new detail
                $deposit->increment($validated['detail'], $validated['amount']);
            } else {
                // If detail is the same, just adjust the amount difference
                $amountDifference = $validated['amount'] - $oldAmount;
                if ($amountDifference > 0) {
                    $deposit->increment($validated['detail'], $amountDifference);
                } elseif ($amountDifference < 0) {
                    $deposit->decrement($validated['detail'], abs($amountDifference));
                }
            }

            // Update the penalty record
            $depositPenalty->update($validated);

            return back()->with("success", "Denda deposit berhasil diperbarui");
        } catch (\Exception $err) {
            return back()->with("error", "Denda deposit gagal diperbarui: " . $err->getMessage());
        }
    }

    public function destroy(Deposit $deposit, DepositPenalty $depositPenalty)
    {
        try {
            // Decrement the deposit amount for the specific penalty type
            $deposit->decrement($depositPenalty->detail, $depositPenalty->amount);

            // Delete the penalty record
            $depositPenalty->delete();

            return back()->with("success", "Denda deposit berhasil dihapus");
        } catch (\Exception $err) {
            return back()->with("error", "Denda deposit gagal dihapus: " . $err->getMessage());
        }
    }
}
