@extends('layouts.app')

@section('title', 'Edit Transaksi')

@section('content')
<div class="max-w-2xl mx-auto px-4 py-10 sm:px-6 lg:px-8">
    <div class="bg-white border border-gray-200 rounded-xl shadow-sm dark:bg-neutral-800 dark:border-neutral-700">
        <!-- Header -->
        <div class="px-6 py-4 border-b border-gray-200 dark:border-neutral-700">
            <h2 class="text-xl font-semibold text-gray-800 dark:text-neutral-200">
                Edit Transaksi
            </h2>
            <p class="text-sm text-gray-600 dark:text-neutral-400">
                Perbarui data transaksi ini.
            </p>
        </div>

        <!-- Form -->
        <form method="POST" action="{{ route('transaction.update', $transaction) }}" class="p-6">
            @csrf
            @method('PUT')
            
            <div class="mb-4">
                <label for="fund_id" class="block text-sm font-medium text-gray-700 dark:text-neutral-300 mb-2">
                    Dana <span class="text-red-500">*</span>
                </label>
                <select id="fund_id" 
                        name="fund_id" 
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-300"
                        required>
                    <option value="">Pilih Dana</option>
                    @foreach($funds as $fund)
                        <option value="{{ $fund->id }}" {{ old('fund_id', $transaction->fund_id) == $fund->id ? 'selected' : '' }}>
                            {{ $fund->name }}
                        </option>
                    @endforeach
                </select>
                @error('fund_id')
                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                @enderror
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                <div>
                    <label for="date" class="block text-sm font-medium text-gray-700 dark:text-neutral-300 mb-2">
                        Tanggal <span class="text-red-500">*</span>
                    </label>
                    <input type="date" 
                           id="date" 
                           name="date" 
                           value="{{ old('date', $transaction->date->format('Y-m-d')) }}"
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-300"
                           required>
                    @error('date')
                        <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="type" class="block text-sm font-medium text-gray-700 dark:text-neutral-300 mb-2">
                        Jenis <span class="text-red-500">*</span>
                    </label>
                    <select id="type" 
                            name="type" 
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-300"
                            required>
                        <option value="">Pilih Jenis</option>
                        <option value="income" {{ old('type', $transaction->type) == 'income' ? 'selected' : '' }}>Pemasukan</option>
                        <option value="expense" {{ old('type', $transaction->type) == 'expense' ? 'selected' : '' }}>Pengeluaran</option>
                    </select>
                    @error('type')
                        <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="mb-4">
                <label for="detail" class="block text-sm font-medium text-gray-700 dark:text-neutral-300 mb-2">
                    Detail <span class="text-red-500">*</span>
                </label>
                <textarea id="detail" 
                          name="detail" 
                          rows="3"
                          class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-300"
                          placeholder="Masukkan detail transaksi"
                          required>{{ old('detail', $transaction->detail) }}</textarea>
                @error('detail')
                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="amount" class="block text-sm font-medium text-gray-700 dark:text-neutral-300 mb-2">
                    Jumlah (Rp) <span class="text-red-500">*</span>
                </label>
                <input type="number" 
                       id="amount" 
                       name="amount" 
                       value="{{ old('amount', $transaction->amount) }}"
                       min="1"
                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-300"
                       placeholder="Masukkan jumlah"
                       required>
                @error('amount')
                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex gap-x-3">
                <button type="submit" 
                        class="py-2 px-4 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 focus:outline-none focus:bg-blue-700">
                    <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/>
                        <polyline points="17 21 17 13 7 13 7 21"/>
                        <polyline points="7 3 7 8 15 8"/>
                    </svg>
                    Perbarui
                </button>
                <a href="{{ route('transaction.index') }}" 
                   class="py-2 px-4 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 focus:outline-none focus:bg-gray-50 dark:bg-transparent dark:border-neutral-700 dark:text-neutral-300 dark:hover:bg-neutral-800">
                    <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M18 6 6 18"/>
                        <path d="m6 6 12 12"/>
                    </svg>
                    Batal
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
