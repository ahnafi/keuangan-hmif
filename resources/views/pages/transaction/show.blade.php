@extends('layouts.app')

@section('title', 'Detail Transaksi')

@section('content')
<div class="max-w-4xl mx-auto px-4 py-10 sm:px-6 lg:px-8">
    <div class="bg-white border border-gray-200 rounded-xl shadow-sm dark:bg-neutral-800 dark:border-neutral-700">
        <!-- Header -->
        <div class="px-6 py-4 border-b border-gray-200 dark:border-neutral-700">
            <h2 class="text-xl font-semibold text-gray-800 dark:text-neutral-200">
                Detail Transaksi
            </h2>
        </div>

        <!-- Content -->
        <div class="px-6 py-4">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Left Column -->
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-neutral-300 mb-1">
                            ID Transaksi
                        </label>
                        <p class="text-sm text-gray-900 dark:text-neutral-100 bg-gray-50 dark:bg-neutral-700 px-3 py-2 rounded-lg">
                            {{ $transaction->id }}
                        </p>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-neutral-300 mb-1">
                            Dana
                        </label>
                        <p class="text-sm text-gray-900 dark:text-neutral-100 bg-gray-50 dark:bg-neutral-700 px-3 py-2 rounded-lg">
                            {{ $transaction->fund->name }}
                        </p>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-neutral-300 mb-1">
                            Tanggal
                        </label>
                        <p class="text-sm text-gray-900 dark:text-neutral-100 bg-gray-50 dark:bg-neutral-700 px-3 py-2 rounded-lg">
                            {{ $transaction->date->format('d M Y') }}
                        </p>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-neutral-300 mb-1">
                            Jenis
                        </label>
                        <div class="flex items-center">
                            @if($transaction->type === 'income')
                                <span class="inline-flex items-center gap-x-1.5 py-1.5 px-3 rounded-full text-xs font-medium bg-teal-100 text-teal-800 dark:bg-teal-800/30 dark:text-teal-500">
                                    <span class="size-1.5 inline-block rounded-full bg-teal-800 dark:bg-teal-500"></span>
                                    Pemasukan
                                </span>
                            @else
                                <span class="inline-flex items-center gap-x-1.5 py-1.5 px-3 rounded-full text-xs font-medium bg-red-100 text-red-800 dark:bg-red-800/30 dark:text-red-500">
                                    <span class="size-1.5 inline-block rounded-full bg-red-800 dark:bg-red-500"></span>
                                    Pengeluaran
                                </span>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Right Column -->
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-neutral-300 mb-1">
                            Jumlah
                        </label>
                        <p class="text-lg font-semibold {{ $transaction->type === 'income' ? 'text-green-600' : 'text-red-600' }} bg-gray-50 dark:bg-neutral-700 px-3 py-2 rounded-lg">
                            {{ $transaction->type === 'income' ? '+' : '-' }}Rp {{ number_format($transaction->amount, 0, ',', '.') }}
                        </p>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-neutral-300 mb-1">
                            Dibuat pada
                        </label>
                        <p class="text-sm text-gray-900 dark:text-neutral-100 bg-gray-50 dark:bg-neutral-700 px-3 py-2 rounded-lg">
                            {{ $transaction->created_at->format('d M Y, H:i') }}
                        </p>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-neutral-300 mb-1">
                            Diperbarui pada
                        </label>
                        <p class="text-sm text-gray-900 dark:text-neutral-100 bg-gray-50 dark:bg-neutral-700 px-3 py-2 rounded-lg">
                            {{ $transaction->updated_at->format('d M Y, H:i') }}
                        </p>
                    </div>
                </div>
            </div>

            <div class="mt-6">
                <label class="block text-sm font-medium text-gray-700 dark:text-neutral-300 mb-1">
                    Detail
                </label>
                <p class="text-sm text-gray-900 dark:text-neutral-100 bg-gray-50 dark:bg-neutral-700 px-3 py-2 rounded-lg min-h-[80px]">
                    {{ $transaction->detail }}
                </p>
            </div>

            <!-- Actions -->
            <div class="flex gap-x-3 mt-6">
                <a href="{{ route('transaction.edit', $transaction) }}" 
                   class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 focus:outline-none focus:bg-blue-700">
                    <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M17 3a2.85 2.83 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5Z"/>
                        <path d="m15 5 4 4"/>
                    </svg>
                    Edit
                </a>
                <a href="{{ route('transaction.index') }}" 
                   class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 focus:outline-none focus:bg-gray-50 dark:bg-transparent dark:border-neutral-700 dark:text-neutral-300 dark:hover:bg-neutral-800">
                    <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="m12 19-7-7 7-7"/>
                        <path d="M19 12H5"/>
                    </svg>
                    Kembali ke Daftar
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
