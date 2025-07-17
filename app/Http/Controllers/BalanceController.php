<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\Fund;
use App\Models\Cash;
use App\Models\Deposit;
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

        // Get deposit transactions from deposit_fund pivot table
        $depositTransactions = DB::table('deposit_fund')
            ->join('funds', 'deposit_fund.fund_id', '=', 'funds.id')
            ->join('deposits', 'deposit_fund.deposit_id', '=', 'deposits.id')
            ->join('administrators', 'deposits.administrator_id', '=', 'administrators.id')
            ->whereBetween('deposit_fund.date', [$startDate, $endDate])
            ->select(
                'deposit_fund.*',
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

        // Add deposit transactions as income
        $totalDepositIncome = $depositTransactions->sum('amount');
        $totalIncome += $totalDepositIncome;

        $balance = $totalIncome - $totalExpense;
        $totalTransactions = $transactions->count() + $cashTransactions->count() + $depositTransactions->count();

        // Get recent transactions (combine regular, cash, and deposit transactions)
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

        $recentDepositTransactions = $depositTransactions->map(function($depositTransaction) {
            return [
                'date' => $depositTransaction->date,
                'fund_name' => $depositTransaction->fund_name,
                'description' => 'Setoran deposit - ' . $depositTransaction->administrator_name,
                'type' => 'income',
                'amount' => $depositTransaction->amount,
                'source' => 'deposit'
            ];
        });

        // Combine and sort recent transactions
        $allRecentTransactions = $recentRegularTransactions->concat($recentCashTransactions)
            ->concat($recentDepositTransactions)
            ->sortByDesc('date')
            ->take(10);

        // Get fund balances - show all funds including cash and deposit transactions
        $fundBalances = $funds->map(function ($fund) use ($transactions, $cashTransactions, $depositTransactions) {
            $fundTransactions = $transactions->where('fund_id', $fund->id);
            $fundCashTransactions = $cashTransactions->where('fund_id', $fund->id);
            $fundDepositTransactions = $depositTransactions->where('fund_id', $fund->id);
            
            $income = $fundTransactions->where('type', 'income')->sum('amount');
            $expense = $fundTransactions->where('type', 'expense')->sum('amount');
            $cashIncome = $fundCashTransactions->sum('amount');
            $depositIncome = $fundDepositTransactions->sum('amount');
            
            $totalIncome = $income + $cashIncome + $depositIncome;
            
            return [
                'id' => $fund->id,
                'name' => $fund->name,
                'income' => $income,
                'cash_income' => $cashIncome,
                'deposit_income' => $depositIncome,
                'total_income' => $totalIncome,
                'expense' => $expense,
                'balance' => $totalIncome - $expense
            ];
        });

        // Calculate totals for fund table
        $totalFundIncome = $fundBalances->sum('income');
        $totalFundCashIncome = $fundBalances->sum('cash_income');
        $totalFundDepositIncome = $fundBalances->sum('deposit_income');
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
            'totalFundDepositIncome',
            'totalFundTotalIncome',
            'totalFundExpense', 
            'totalFundBalance',
            'allRecentTransactions',
            'totalCashIncome',
            'totalDepositIncome'
        ));
    }
}
