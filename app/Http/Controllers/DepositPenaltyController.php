<?php

namespace App\Http\Controllers;

use App\Models\Deposit;
use App\Models\DepositPenalty;
use Illuminate\Http\Request;

class DepositPenaltyController extends Controller
{
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

    public function update()
    {

    }

    public function destroy()
    {

    }
}
