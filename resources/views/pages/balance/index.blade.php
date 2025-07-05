@extends('layouts.app')

@section('title', 'Saldo & Ringkasan Keuangan')

@section('content')
<div class="max-w-[85rem] px-4 py-10 sm:px-6 lg:px-8 mx-auto">
    <!-- Page Header -->
    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-2xl font-semibold text-gray-900 dark:text-white">Saldo & Ringkasan Keuangan</h1>
            <p class="text-sm text-gray-600 dark:text-gray-400">Monitor aktivitas keuangan HMIF secara real-time</p>
        </div>
        
        <!-- Filter Form -->
        <div class="flex items-center gap-3">
            <form method="GET" action="{{ route('balance.index') }}" class="flex items-center gap-2">
                <select name="month" class="py-2 px-3 pr-9 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-neutral-800 dark:border-neutral-700 dark:text-neutral-400">
                    @for($i = 1; $i <= 12; $i++)
                        <option value="{{ $i }}" {{ request('month', date('n')) == $i ? 'selected' : '' }}>
                            {{ \Carbon\Carbon::create()->month($i)->format('F') }}
                        </option>
                    @endfor
                </select>
                
                <select name="year" class="py-2 px-3 pr-9 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-neutral-800 dark:border-neutral-700 dark:text-neutral-400">
                    @for($year = date('Y') - 2; $year <= date('Y') + 1; $year++)
                        <option value="{{ $year }}" {{ request('year', date('Y')) == $year ? 'selected' : '' }}>
                            {{ $year }}
                        </option>
                    @endfor
                </select>
                
                <button type="submit" class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 focus:outline-none focus:bg-blue-700">
                    <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="11" cy="11" r="8"/>
                        <path d="m21 21-4.35-4.35"/>
                    </svg>
                    Filter
                </button>
            </form>
        </div>
    </div>

    <!-- Summary Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
        <!-- Total Pemasukan -->
        <div class="bg-white border border-gray-200 rounded-xl shadow-sm p-4 md:p-5 dark:bg-neutral-800 dark:border-neutral-700">
            <div class="flex items-center">
                <div class="shrink-0">
                    <div class="size-12 bg-green-100 rounded-lg flex items-center justify-center dark:bg-green-800/30">
                        <svg class="shrink-0 size-6 text-green-600 dark:text-green-400" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M12 1v6m0 0 4-4m-4 4L8 3"/>
                            <path d="M12 13v6m0 0 4-4m-4 4-4-4"/>
                        </svg>
                    </div>
                </div>
                <div class="ms-3">
                    <p class="text-xs uppercase tracking-wide text-gray-500 dark:text-neutral-400">
                        Total Pemasukan
                    </p>
                    <p class="text-xl font-semibold text-gray-800 dark:text-neutral-200">
                        Rp {{ number_format($totalIncome ?? 0, 0, ',', '.') }}
                    </p>
                    <p class="text-xs text-gray-500 dark:text-neutral-400">
                        {{ \Carbon\Carbon::create(request('year', date('Y')), request('month', date('n')))->format('F Y') }}
                    </p>
                </div>
            </div>
        </div>

        <!-- Total Pengeluaran -->
        <div class="bg-white border border-gray-200 rounded-xl shadow-sm p-4 md:p-5 dark:bg-neutral-800 dark:border-neutral-700">
            <div class="flex items-center">
                <div class="shrink-0">
                    <div class="size-12 bg-red-100 rounded-lg flex items-center justify-center dark:bg-red-800/30">
                        <svg class="shrink-0 size-6 text-red-600 dark:text-red-400" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M12 5v14m0 0 4-4m-4 4-4-4"/>
                        </svg>
                    </div>
                </div>
                <div class="ms-3">
                    <p class="text-xs uppercase tracking-wide text-gray-500 dark:text-neutral-400">
                        Total Pengeluaran
                    </p>
                    <p class="text-xl font-semibold text-gray-800 dark:text-neutral-200">
                        Rp {{ number_format($totalExpense ?? 0, 0, ',', '.') }}
                    </p>
                    <p class="text-xs text-gray-500 dark:text-neutral-400">
                        {{ \Carbon\Carbon::create(request('year', date('Y')), request('month', date('n')))->format('F Y') }}
                    </p>
                </div>
            </div>
        </div>

        <!-- Saldo Bersih -->
        <div class="bg-white border border-gray-200 rounded-xl shadow-sm p-4 md:p-5 dark:bg-neutral-800 dark:border-neutral-700">
            <div class="flex items-center">
                <div class="shrink-0">
                    <div class="size-12 bg-blue-100 rounded-lg flex items-center justify-center dark:bg-blue-800/30">
                        <svg class="shrink-0 size-6 text-blue-600 dark:text-blue-400" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <line x1="12" y1="1" x2="12" y2="23"/>
                            <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/>
                        </svg>
                    </div>
                </div>
                <div class="ms-3">
                    <p class="text-xs uppercase tracking-wide text-gray-500 dark:text-neutral-400">
                        Saldo Bersih
                    </p>
                    <p class="text-xl font-semibold {{ ($totalIncome - $totalExpense) >= 0 ? 'text-green-600' : 'text-red-600' }}">
                        Rp {{ number_format(($totalIncome ?? 0) - ($totalExpense ?? 0), 0, ',', '.') }}
                    </p>
                    <p class="text-xs text-gray-500 dark:text-neutral-400">
                        {{ \Carbon\Carbon::create(request('year', date('Y')), request('month', date('n')))->format('F Y') }}
                    </p>
                </div>
            </div>
        </div>

        <!-- Total Transaksi -->
        <div class="bg-white border border-gray-200 rounded-xl shadow-sm p-4 md:p-5 dark:bg-neutral-800 dark:border-neutral-700">
            <div class="flex items-center">
                <div class="shrink-0">
                    <div class="size-12 bg-gray-100 rounded-lg flex items-center justify-center dark:bg-gray-800/30">
                        <svg class="shrink-0 size-6 text-gray-600 dark:text-gray-400" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/>
                            <polyline points="14 2 14 8 20 8"/>
                            <line x1="16" y1="13" x2="8" y2="13"/>
                            <line x1="16" y1="17" x2="8" y2="17"/>
                            <polyline points="10 9 9 9 8 9"/>
                        </svg>
                    </div>
                </div>
                <div class="ms-3">
                    <p class="text-xs uppercase tracking-wide text-gray-500 dark:text-neutral-400">
                        Total Transaksi
                    </p>
                    <p class="text-xl font-semibold text-gray-800 dark:text-neutral-200">
                        {{ $totalTransactions ?? 0 }}
                    </p>
                    <p class="text-xs text-gray-500 dark:text-neutral-400">
                        {{ \Carbon\Carbon::create(request('year', date('Y')), request('month', date('n')))->format('F Y') }}
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts and Tables -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
        <!-- Chart Card -->
        <div class="bg-white border border-gray-200 rounded-xl shadow-sm dark:bg-neutral-800 dark:border-neutral-700">
            <div class="px-6 py-4 border-b border-gray-200 dark:border-neutral-700">
                <h3 class="text-lg font-semibold text-gray-800 dark:text-neutral-200">
                    Grafik Keuangan
                </h3>
                <p class="text-sm text-gray-600 dark:text-neutral-400">
                    Perbandingan pemasukan dan pengeluaran
                </p>
            </div>
            <div class="p-6">
                <canvas id="balanceChart" width="400" height="200"></canvas>
            </div>
        </div>

        <!-- Fund Summary -->
        <div class="bg-white border border-gray-200 rounded-xl shadow-sm dark:bg-neutral-800 dark:border-neutral-700">
            <div class="px-6 py-4 border-b border-gray-200 dark:border-neutral-700">
                <h3 class="text-lg font-semibold text-gray-800 dark:text-neutral-200">
                    Ringkasan per Dana
                </h3>
                <p class="text-sm text-gray-600 dark:text-neutral-400">
                    Saldo untuk setiap sumber dana
                </p>
            </div>
            <div class="p-6">
                @if($fundBalances && count($fundBalances) > 0)
                    <div class="space-y-3">
                        @foreach($fundBalances as $fundBalance)
                        <div class="flex justify-between items-center p-3 bg-gray-50 rounded-lg dark:bg-neutral-700">
                            <span class="text-sm font-medium text-gray-800 dark:text-neutral-200">
                                {{ $fundBalance['name'] }}
                            </span>
                            <span class="text-sm font-semibold {{ $fundBalance['balance'] >= 0 ? 'text-green-600' : 'text-red-600' }}">
                                Rp {{ number_format($fundBalance['balance'], 0, ',', '.') }}
                            </span>
                        </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-8">
                        <svg class="w-12 h-12 text-gray-300 dark:text-neutral-600 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                        </svg>
                        <p class="text-gray-500 dark:text-neutral-400">Tidak ada data dana tersedia</p>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Recent Transactions -->
    <div class="bg-white border border-gray-200 rounded-xl shadow-sm dark:bg-neutral-800 dark:border-neutral-700">
        <div class="px-6 py-4 border-b border-gray-200 dark:border-neutral-700">
            <div class="flex justify-between items-center">
                <div>
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-neutral-200">
                        Transaksi Terbaru
                    </h3>
                    <p class="text-sm text-gray-600 dark:text-neutral-400">
                        10 transaksi terakhir pada periode terpilih
                    </p>
                </div>
                <a href="{{ route('transaction.index') }}" class="text-sm text-blue-600 hover:text-blue-700 font-medium">
                    Lihat Semua
                </a>
            </div>
        </div>
        
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200 dark:divide-neutral-700">
                <thead class="bg-gray-50 dark:bg-neutral-800">
                    <tr>
                        <th class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase dark:text-neutral-400">Tanggal</th>
                        <th class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase dark:text-neutral-400">Dana</th>
                        <th class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase dark:text-neutral-400">Detail</th>
                        <th class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase dark:text-neutral-400">Jenis</th>
                        <th class="px-6 py-3 text-end text-xs font-medium text-gray-500 uppercase dark:text-neutral-400">Jumlah</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 dark:divide-neutral-700">
                    @forelse($recentTransactions ?? [] as $transaction)
                    <tr class="hover:bg-gray-50 dark:hover:bg-neutral-700">
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-neutral-200">
                            {{ $transaction->date->format('d M Y') }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-neutral-200">
                            {{ $transaction->fund->name }}
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-800 dark:text-neutral-200">
                            {{ \Illuminate\Support\Str::limit($transaction->detail, 50) }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if($transaction->type === 'income')
                                <span class="inline-flex items-center gap-x-1.5 py-1.5 px-3 rounded-full text-xs font-medium bg-teal-100 text-teal-800 dark:bg-teal-800/30 dark:text-teal-500">
                                    Pemasukan
                                </span>
                            @else
                                <span class="inline-flex items-center gap-x-1.5 py-1.5 px-3 rounded-full text-xs font-medium bg-red-100 text-red-800 dark:bg-red-800/30 dark:text-red-500">
                                    Pengeluaran
                                </span>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-end text-sm font-medium {{ $transaction->type === 'income' ? 'text-green-600' : 'text-red-600' }}">
                            {{ $transaction->type === 'income' ? '+' : '-' }}Rp {{ number_format($transaction->amount, 0, ',', '.') }}
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-6 py-12 text-center">
                            <div class="flex flex-col items-center justify-center">
                                <svg class="w-12 h-12 text-gray-300 dark:text-neutral-600 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                                <p class="text-gray-500 dark:text-neutral-400 mb-2">Tidak ada transaksi</p>
                                <p class="text-sm text-gray-400 dark:text-neutral-500">Belum ada transaksi pada periode ini</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
// Balance Chart
const ctx = document.getElementById('balanceChart').getContext('2d');
const balanceChart = new Chart(ctx, {
    type: 'doughnut',
    data: {
        labels: ['Pemasukan', 'Pengeluaran'],
        datasets: [{
            data: [{{ $totalIncome ?? 0 }}, {{ $totalExpense ?? 0 }}],
            backgroundColor: [
                '#10b981', // green-500
                '#ef4444'  // red-500
            ],
            borderWidth: 0
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: {
                position: 'bottom',
            }
        }
    }
});
</script>
@endpush
@endsection
