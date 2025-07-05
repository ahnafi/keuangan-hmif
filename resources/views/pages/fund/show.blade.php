@extends('layouts.app')

@section('title', 'Detail Dana')

@section('content')
    <div class="max-w-2xl mx-auto px-4 py-10 sm:px-6 lg:px-8">
        <div class="bg-white border border-gray-200 rounded-xl shadow-2xs dark:bg-neutral-800 dark:border-neutral-700">
            <!-- Header -->
            <div class="px-6 py-4 border-b border-gray-200 dark:border-neutral-700">
                <h2 class="text-xl font-semibold text-gray-800 dark:text-neutral-200">
                    Detail Dana
                </h2>
                <p class="text-sm text-gray-600 dark:text-neutral-400">
                    Lihat informasi dana dan transaksi terkait.
                </p>
            </div>

            <!-- Details -->
            <div class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-neutral-300 mb-2">
                            ID Dana
                        </label>
                        <p class="text-sm text-gray-800 dark:text-neutral-200">{{ $fund->id }}</p>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-neutral-300 mb-2">
                            Nama Dana
                        </label>
                        <p class="text-sm text-gray-800 dark:text-neutral-200">{{ $fund->name }}</p>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-neutral-300 mb-2">
                            Dibuat Pada
                        </label>
                        <p class="text-sm text-gray-800 dark:text-neutral-200">{{ $fund->created_at->format('d M Y, H:i') }}</p>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-neutral-300 mb-2">
                            Diperbarui Pada
                        </label>
                        <p class="text-sm text-gray-800 dark:text-neutral-200">{{ $fund->updated_at->format('d M Y, H:i') }}</p>
                    </div>
                </div>

                <div class="mt-6 flex gap-x-3">
                    <a href="{{ route('fund.edit', $fund) }}" 
                       class="py-2 px-4 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 focus:outline-hidden focus:bg-blue-700">
                        Edit Dana
                    </a>
                    <a href="{{ route('fund.index') }}" 
                       class="py-2 px-4 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-2xs hover:bg-gray-50 focus:outline-hidden focus:bg-gray-50 dark:bg-transparent dark:border-neutral-700 dark:text-neutral-300 dark:hover:bg-neutral-800">
                        Kembali ke Daftar
                    </a>
                </div>
            </div>
        </div>

        <!-- Related Transactions -->
        @if($fund->transactions->count() > 0)
        <div class="mt-8 bg-white border border-gray-200 rounded-xl shadow-2xs dark:bg-neutral-800 dark:border-neutral-700">
            <div class="px-6 py-4 border-b border-gray-200 dark:border-neutral-700">
                <h3 class="text-lg font-semibold text-gray-800 dark:text-neutral-200">
                    Transaksi Terkait
                </h3>
            </div>
            <div class="p-6">
                <div class="space-y-3">
                    @foreach($fund->transactions->take(5) as $transaction)
                    <div class="flex justify-between items-center p-3 border border-gray-200 rounded-lg dark:border-neutral-700">
                        <div>
                            <p class="text-sm font-medium text-gray-800 dark:text-neutral-200">{{ $transaction->detail }}</p>
                            <p class="text-xs text-gray-500 dark:text-neutral-500">{{ $transaction->date->format('d M Y') }}</p>
                        </div>
                        <div class="text-right">
                            <p class="text-sm font-medium {{ $transaction->type === 'income' ? 'text-green-600' : 'text-red-600' }}">
                                {{ $transaction->type === 'income' ? '+' : '-' }}Rp {{ number_format($transaction->amount, 0, ',', '.') }}
                            </p>
                            <p class="text-xs text-gray-500 dark:text-neutral-500 capitalize">{{ $transaction->type === 'income' ? 'Pemasukan' : 'Pengeluaran' }}</p>
                        </div>
                    </div>
                    @endforeach
                </div>
                @if($fund->transactions->count() > 5)
                <div class="mt-4 text-center">
                    <a href="{{ route('transaction.index', ['fund_id' => $fund->id]) }}" 
                       class="text-sm text-blue-600 hover:underline dark:text-blue-500">
                        Lihat semua {{ $fund->transactions->count() }} transaksi
                    </a>
                </div>
                @endif
            </div>
        </div>
        @endif
    </div>
@endsection
