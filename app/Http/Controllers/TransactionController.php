<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\Fund;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function index(){
        $transactions = Transaction::with('fund')->orderBy('date', 'desc')->paginate(10);
        return view("pages.transaction.index", compact('transactions'));
    }

    public function create()
    {
        $funds = Fund::all();
        return view("pages.transaction.create", compact('funds'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'fund_id' => 'required|exists:funds,id',
            'date' => 'required|date',
            'type' => 'required|in:income,expense',
            'detail' => 'required|string|max:255',
            'amount' => 'required|integer|min:1',
        ]);

        Transaction::create($request->only(['fund_id', 'date', 'type', 'detail', 'amount']));

        return redirect()->route('transaction.index')->with('success', 'Transaction created successfully.');
    }

    public function show(Transaction $transaction)
    {
        $transaction->load('fund');
        return view("pages.transaction.show", compact('transaction'));
    }

    public function edit(Transaction $transaction)
    {
        $funds = Fund::all();
        return view("pages.transaction.edit", compact('transaction', 'funds'));
    }

    public function update(Request $request, Transaction $transaction)
    {
        $request->validate([
            'fund_id' => 'required|exists:funds,id',
            'date' => 'required|date',
            'type' => 'required|in:income,expense',
            'detail' => 'required|string|max:255',
            'amount' => 'required|integer|min:1',
        ]);

        $transaction->update($request->only(['fund_id', 'date', 'type', 'detail', 'amount']));

        return redirect()->route('transaction.index')->with('success', 'Transaction updated successfully.');
    }

    public function destroy(Transaction $transaction)
    {
        $transaction->delete();
        return redirect()->route('transaction.index')->with('success', 'Transaction deleted successfully.');
    }
}
