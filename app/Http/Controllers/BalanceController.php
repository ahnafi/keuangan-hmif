<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\Fund;
use App\Models\Cash;
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

        // Build the query for regular transactions
        $transactionsQuery = Transaction::with('fund')
            ->whereBetween('date', [$startDate, $endDate]);

        $transactions = $transactionsQuery->orderBy('date', 'desc')->get();

        // Get cash transactions from cash_fund pivot table
        $cashTransactions = DB::table('cash_fund')
            ->join('funds', 'cash_fund.fund_id', '=', 'funds.id')
            ->join('cashes', 'cash_fund.cash_id', '=', 'cashes.id')
            ->join('administrators', 'cashes.administrator_id', '=', 'administrators.id')
            ->whereBetween('cash_fund.date', [$startDate, $endDate])
            ->select(
                'cash_fund.*',
                'funds.name as fund_name',
                'administrators.name as administrator_name',
                'funds.id as fund_id'
            )
            ->get();

        // Calculate totals from regular transactions
        $totalIncome = $transactions->where('type', 'income')->sum('amount');
        $totalExpense = $transactions->where('type', 'expense')->sum('amount');
        
        // Add cash transactions as income
        $totalCashIncome = $cashTransactions->sum('amount');
        $totalIncome += $totalCashIncome;

        $balance = $totalIncome - $totalExpense;
        $totalTransactions = $transactions->count() + $cashTransactions->count();

        // Get recent transactions (combine regular and cash transactions)
        $recentRegularTransactions = $transactions->filter(function($transaction) {
            return $transaction && $transaction->fund && $transaction->date;
        })->map(function($transaction) {
            return [
                'date' => $transaction->date,
                'fund_name' => $transaction->fund->name,
                'description' => $transaction->description,
                'type' => $transaction->type,
                'amount' => $transaction->amount,
                'source' => 'transaction'
            ];
        });

        $recentCashTransactions = $cashTransactions->map(function($cashTransaction) {
            return [
                'date' => $cashTransaction->date,
                'fund_name' => $cashTransaction->fund_name,
                'description' => 'Pembayaran kas - ' . $cashTransaction->administrator_name . ' (' . ucfirst($cashTransaction->month) . ')',
                'type' => 'income',
                'amount' => $cashTransaction->amount,
                'source' => 'cash'
            ];
        });

        // Combine and sort recent transactions
        $allRecentTransactions = $recentRegularTransactions->concat($recentCashTransactions)
            ->sortByDesc('date')
            ->take(10);

        // Get fund balances - show all funds including cash transactions
        $fundBalances = $funds->map(function ($fund) use ($transactions, $cashTransactions) {
            $fundTransactions = $transactions->where('fund_id', $fund->id);
            $fundCashTransactions = $cashTransactions->where('fund_id', $fund->id);
            
            $income = $fundTransactions->where('type', 'income')->sum('amount');
            $expense = $fundTransactions->where('type', 'expense')->sum('amount');
            $cashIncome = $fundCashTransactions->sum('amount');
            
            $totalIncome = $income + $cashIncome;
            
            return [
                'id' => $fund->id,
                'name' => $fund->name,
                'income' => $income,
                'cash_income' => $cashIncome,
                'total_income' => $totalIncome,
                'expense' => $expense,
                'balance' => $totalIncome - $expense
            ];
        });

        // Calculate totals for fund table
        $totalFundIncome = $fundBalances->sum('income');
        $totalFundCashIncome = $fundBalances->sum('cash_income');
        $totalFundTotalIncome = $fundBalances->sum('total_income');
        $totalFundExpense = $fundBalances->sum('expense');
        $totalFundBalance = $totalFundTotalIncome - $totalFundExpense;

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
            'totalFundCashIncome',
            'totalFundTotalIncome',
            'totalFundExpense', 
            'totalFundBalance',
            'allRecentTransactions',
            'totalCashIncome'
        ));
    }
}
