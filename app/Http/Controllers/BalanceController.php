<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\Fund;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class BalanceController extends Controller
{
    public function index(Request $request)
    {
        $selectedMonth = $request->input('month', date('n'));
        $selectedYear = $request->input('year', date('Y'));

        // Get all funds for filter dropdown
        $funds = Fund::all();

        // Create date range for the selected month and year
        $startDate = Carbon::create($selectedYear, $selectedMonth, 1)->startOfMonth();
        $endDate = Carbon::create($selectedYear, $selectedMonth, 1)->endOfMonth();

        // Build the query
        $transactionsQuery = Transaction::with('fund')
            ->whereBetween('date', [$startDate, $endDate]);

        $transactions = $transactionsQuery->orderBy('date', 'desc')->get();

        // Calculate totals
        $totalIncome = $transactions->where('type', 'income')->sum('amount');
        $totalExpense = $transactions->where('type', 'expense')->sum('amount');
        $balance = $totalIncome - $totalExpense;
        $totalTransactions = $transactions->count();

        // Get recent transactions (limit to 10) - ensure we have valid data
        $recentTransactions = $transactions->filter(function($transaction) {
            return $transaction && $transaction->fund && $transaction->date;
        })->take(10);

        // Get fund balances - show all funds
        $fundBalances = $funds->map(function ($fund) use ($transactions) {
            $fundTransactions = $transactions->where('fund_id', $fund->id);
            $income = $fundTransactions->where('type', 'income')->sum('amount');
            $expense = $fundTransactions->where('type', 'expense')->sum('amount');
            
            return [
                'id' => $fund->id,
                'name' => $fund->name,
                'income' => $income,
                'expense' => $expense,
                'balance' => $income - $expense
            ];
        });

        // Calculate totals for fund table
        $totalFundIncome = $fundBalances->sum('income');
        $totalFundExpense = $fundBalances->sum('expense');
        $totalFundBalance = $totalFundIncome - $totalFundExpense;

        return view('pages.balance.index', compact(
            'funds',
            'selectedMonth', 
            'selectedYear',
            'totalIncome',
            'totalExpense',
            'balance',
            'totalTransactions',
            'fundBalances',
            'totalFundIncome',
            'totalFundExpense', 
            'totalFundBalance',
            'recentTransactions'
        ));
    }
}
