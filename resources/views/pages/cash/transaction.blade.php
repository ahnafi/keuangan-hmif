@extends('layouts.app')

@section('title', 'Transaksi Kas')

@section('content')
    <!-- Table Section -->
    <div class="max-w-[85rem] px-4 py-10 sm:px-6 lg:px-8 lg:py-14 mx-auto">
        <!-- Card -->
        <div class="flex flex-col">
            <div class="-m-1.5 overflow-x-auto">
                <div class="p-1.5 min-w-full inline-block align-middle">
                    <div
                        class="bg-white border border-gray-200 rounded-xl shadow-2xs overflow-hidden dark:bg-neutral-800 dark:border-neutral-700">
                        <!-- Header -->
                        <div
                            class="px-6 py-4 grid gap-3 md:flex md:justify-between md:items-center border-b border-gray-200 dark:border-neutral-700">
                            <div>
                                <h2 class="text-xl font-semibold text-gray-800 dark:text-neutral-200">
                                    Transaksi Kas
                                </h2>
                                <p class="text-sm text-gray-600 dark:text-neutral-400">
                                    Semua transaksi pembayaran kas pengurus.
                                </p>
                            </div>

                            <div>
                                <div class="inline-flex gap-x-2">
                                    <a class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-300 bg-white text-gray-700 hover:bg-gray-50 focus:outline-hidden focus:bg-gray-50 dark:bg-neutral-800 dark:border-neutral-700 dark:text-neutral-300 dark:hover:bg-neutral-700"
                                        href="{{ route('home') }}">
                                        <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24"
                                            height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M19 12H6m0 0l4 4m-4-4l4-4" />
                                        </svg>
                                        Kembali
                                    </a>
                                </div>
                            </div>
                        </div>
                        <!-- End Header -->

                        <!-- Table -->
                        <table class="min-w-full divide-y divide-gray-200 dark:divide-neutral-700">
                            <thead class="bg-gray-50 dark:bg-neutral-800">
                                <tr>
                                    <th scope="col" class="ps-6 py-3 text-start">
                                        <div class="flex items-center gap-x-2">
                                            <span
                                                class="text-xs font-semibold uppercase text-gray-800 dark:text-neutral-200">
                                                Tanggal
                                            </span>
                                        </div>
                                    </th>

                                    <th scope="col" class="px-6 py-3 text-start">
                                        <div class="flex items-center gap-x-2">
                                            <span
                                                class="text-xs font-semibold uppercase text-gray-800 dark:text-neutral-200">
                                                Pengurus
                                            </span>
                                        </div>
                                    </th>

                                    <th scope="col" class="px-6 py-3 text-start">
                                        <div class="flex items-center gap-x-2">
                                            <span
                                                class="text-xs font-semibold uppercase text-gray-800 dark:text-neutral-200">
                                                Divisi
                                            </span>
                                        </div>
                                    </th>

                                    <th scope="col" class="px-6 py-3 text-start">
                                        <div class="flex items-center gap-x-2">
                                            <span
                                                class="text-xs font-semibold uppercase text-gray-800 dark:text-neutral-200">
                                                Dana
                                            </span>
                                        </div>
                                    </th>

                                    <th scope="col" class="px-6 py-3 text-start">
                                        <div class="flex items-center gap-x-2">
                                            <span
                                                class="text-xs font-semibold uppercase text-gray-800 dark:text-neutral-200">
                                                Bulan
                                            </span>
                                        </div>
                                    </th>

                                    <th scope="col" class="px-6 py-3 text-start">
                                        <div class="flex items-center gap-x-2">
                                            <span
                                                class="text-xs font-semibold uppercase text-gray-800 dark:text-neutral-200">
                                                Kas
                                            </span>
                                        </div>
                                    </th>

                                    <th scope="col" class="px-6 py-3 text-start">
                                        <div class="flex items-center gap-x-2">
                                            <span
                                                class="text-xs font-semibold uppercase text-gray-800 dark:text-neutral-200">
                                                Denda
                                            </span>
                                        </div>
                                    </th>

                                    <th scope="col" class="px-6 py-3 text-end">
                                        <span class="text-xs font-semibold uppercase text-gray-800 dark:text-neutral-200">
                                            Total
                                        </span>
                                    </th>
                                </tr>
                            </thead>

                            <tbody class="divide-y divide-gray-200 dark:divide-neutral-700">
                                @php
                                    $pageTotal = [
                                        'cash' => 0,
                                        'penalty' => 0,
                                        'amount' => 0
                                    ];
                                @endphp

                                @forelse($transactions as $transaction)
                                    @php
                                        $pageTotal['cash'] += $transaction->pivot->cash;
                                        $pageTotal['penalty'] += $transaction->pivot->penalty;
                                        $pageTotal['amount'] += $transaction->pivot->amount;
                                    @endphp
                                    <tr>
                                        <td class="size-px whitespace-nowrap">
                                            <div class="ps-6 py-3">
                                                <span class="text-sm text-gray-800 dark:text-neutral-200">
                                                    {{ \Carbon\Carbon::parse($transaction->pivot->date)->format('d M Y') }}
                                                </span>
                                            </div>
                                        </td>
                                        <td class="h-px w-72 whitespace-nowrap">
                                            <div class="px-6 py-3">
                                                <span class="block text-sm font-semibold text-gray-800 dark:text-neutral-200">
                                                    {{ $transaction->administrator->name }}
                                                </span>
                                            </div>
                                        </td>
                                        <td class="size-px whitespace-nowrap">
                                            <div class="px-6 py-3">
                                                <span class="block text-sm text-gray-800 dark:text-neutral-200">
                                                    {{ $transaction->administrator->division->name ?? 'N/A' }}
                                                </span>
                                            </div>
                                        </td>
                                        <td class="size-px whitespace-nowrap">
                                            <div class="px-6 py-3">
                                                <span class="text-sm text-gray-800 dark:text-neutral-200">
                                                    {{ $transaction->fund_name }}
                                                </span>
                                            </div>
                                        </td>
                                        <td class="size-px whitespace-nowrap">
                                            <div class="px-6 py-3">
                                                <span
                                                    class="inline-flex items-center gap-x-1.5 py-1.5 px-3 rounded-full text-xs font-medium bg-blue-100 text-blue-800 dark:bg-blue-800/30 dark:text-blue-500">
                                                    {{ ucfirst($transaction->pivot->month) }}
                                                </span>
                                            </div>
                                        </td>
                                        <td class="size-px whitespace-nowrap">
                                            <div class="px-6 py-3">
                                                <span class="text-sm text-green-600 dark:text-green-400">
                                                    Rp {{ number_format($transaction->pivot->cash, 0, ',', '.') }}
                                                </span>
                                            </div>
                                        </td>
                                        <td class="size-px whitespace-nowrap">
                                            <div class="px-6 py-3">
                                                <span class="text-sm text-red-600 dark:text-red-400">
                                                    Rp {{ number_format($transaction->pivot->penalty, 0, ',', '.') }}
                                                </span>
                                            </div>
                                        </td>
                                        <td class="size-px whitespace-nowrap">
                                            <div class="px-6 py-3 text-end">
                                                <span class="text-sm font-semibold text-gray-800 dark:text-neutral-200">
                                                    Rp {{ number_format($transaction->pivot->amount, 0, ',', '.') }}
                                                </span>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8" class="px-6 py-12 text-center">
                                            <p class="text-gray-500 dark:text-neutral-500">Tidak ada transaksi kas ditemukan.</p>
                                        </td>
                                    </tr>
                                @endforelse

                                <!-- Page Total Row -->
                                @if($transactions->count() > 0)
                                    <tr class="bg-gray-50 dark:bg-neutral-800 border-t-2 border-gray-300 dark:border-neutral-600">
                                        <td class="size-px whitespace-nowrap">
                                            <div class="ps-6 py-3">
                                                <span class="text-sm font-bold text-gray-800 dark:text-neutral-200">
                                                    TOTAL HALAMAN
                                                </span>
                                            </div>
                                        </td>
                                        <td colspan="4" class="px-6 py-3">
                                            <span class="text-sm font-bold text-gray-800 dark:text-neutral-200">
                                                {{ $transactions->count() }} Transaksi
                                            </span>
                                        </td>
                                        <td class="size-px whitespace-nowrap">
                                            <div class="px-6 py-3">
                                                <span class="text-sm font-bold text-green-600 dark:text-green-400">
                                                    Rp {{ number_format($pageTotal['cash'], 0, ',', '.') }}
                                                </span>
                                            </div>
                                        </td>
                                        <td class="size-px whitespace-nowrap">
                                            <div class="px-6 py-3">
                                                <span class="text-sm font-bold text-red-600 dark:text-red-400">
                                                    Rp {{ number_format($pageTotal['penalty'], 0, ',', '.') }}
                                                </span>
                                            </div>
                                        </td>
                                        <td class="size-px whitespace-nowrap">
                                            <div class="px-6 py-3 text-end">
                                                <span class="text-sm font-bold text-blue-600 dark:text-blue-400">
                                                    Rp {{ number_format($pageTotal['amount'], 0, ',', '.') }}
                                                </span>
                                            </div>
                                        </td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                        <!-- End Table -->

                        <!-- Footer with Pagination -->
                        @if($transactions->hasPages())
                        <div
                            class="px-6 py-4 grid gap-3 md:flex md:justify-between md:items-center border-t border-gray-200 dark:border-neutral-700">
                            <div>
                                {{-- <p class="text-sm text-gray-600 dark:text-neutral-400">
                                    <span class="font-semibold text-gray-800 dark:text-neutral-200">{{ $transactions->total() }}</span> total transaksi
                                </p> --}}
                            </div>

                            <div>
                                {{ $transactions->links() }}
                            </div>
                        </div>
                        @endif
                        <!-- End Footer -->

                        <!-- Grand Total Section -->
                        <div class="px-6 py-4 bg-blue-50 dark:bg-blue-900/20 border-t border-gray-200 dark:border-neutral-700">
                            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                                <div class="text-center">
                                    <div class="text-2xl font-bold text-blue-600 dark:text-blue-400">
                                        {{ number_format($transactions->total(), 0, ',', '.') }}
                                    </div>
                                    <div class="text-sm text-gray-600 dark:text-neutral-400">
                                        Total Transaksi
                                    </div>
                                </div>
                                <div class="text-center">
                                    <div class="text-2xl font-bold text-green-600 dark:text-green-400">
                                        Rp {{ number_format($totals['cash'], 0, ',', '.') }}
                                    </div>
                                    <div class="text-sm text-gray-600 dark:text-neutral-400">
                                        Total Kas
                                    </div>
                                </div>
                                <div class="text-center">
                                    <div class="text-2xl font-bold text-red-600 dark:text-red-400">
                                        Rp {{ number_format($totals['penalty'], 0, ',', '.') }}
                                    </div>
                                    <div class="text-sm text-gray-600 dark:text-neutral-400">
                                        Total Denda
                                    </div>
                                </div>
                                <div class="text-center">
                                    <div class="text-2xl font-bold text-blue-600 dark:text-blue-400">
                                        Rp {{ number_format($totals['amount'], 0, ',', '.') }}
                                    </div>
                                    <div class="text-sm text-gray-600 dark:text-neutral-400">
                                        Grand Total
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End Grand Total Section -->
                    </div>
                </div>
            </div>
        </div>
        <!-- End Card -->
    </div>
    <!-- End Table Section -->
@endsection