@extends('layouts.app')

@section('title', 'Tambah Transaksi Kas')

@section('content')
<div class="max-w-[85rem] px-4 py-10 sm:px-6 lg:px-8 lg:py-14 mx-auto">
  <!-- Card -->
  <div class="bg-white border border-gray-200 rounded-xl shadow-2xs overflow-hidden dark:bg-neutral-800 dark:border-neutral-700">
    <!-- Header -->
    <div class="px-6 py-4 border-b border-gray-200 dark:border-neutral-700">
      <div class="flex items-center justify-between">
        <div>
          <h2 class="text-xl font-semibold text-gray-800 dark:text-neutral-200">
            Tambah Transaksi Kas
          </h2>
          <p class="text-sm text-gray-600 dark:text-neutral-400">
            Buat relasi dana dengan administrator dan perbarui kas bulan yang dipilih
          </p>
        </div>
        <a href="{{ route('home') }}" 
           class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-2xs hover:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none focus:outline-hidden focus:bg-gray-50 dark:bg-transparent dark:border-neutral-700 dark:text-neutral-300 dark:hover:bg-neutral-800 dark:focus:bg-neutral-800">
          <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
          </svg>
          Kembali
        </a>
      </div>
    </div>

    <!-- Form -->
    <div class="p-6">
      @if(session('success'))
        <div class="bg-green-50 border border-green-200 rounded-lg p-4 mb-6" role="alert">
          <div class="flex">
            <div class="flex-shrink-0">
              <svg class="h-4 w-4 text-green-400 mt-0.5" xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                   fill="currentColor" viewBox="0 0 16 16">
                <path
                  d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.061L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z" />
              </svg>
            </div>
            <div class="ms-3">
              <p class="text-sm text-green-800">
                {{ session('success') }}
              </p>
            </div>
          </div>
        </div>
      @endif

      @if(session('error'))
        <div class="bg-red-50 border border-red-200 rounded-lg p-4 mb-6" role="alert">
          <div class="flex">
            <div class="flex-shrink-0">
              <svg class="h-4 w-4 text-red-400 mt-0.5" xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                   fill="currentColor" viewBox="0 0 16 16">
                <path
                  d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM5.354 4.646a.5.5 0 1 0-.708.708L7.293 8l-2.647 2.646a.5.5 0 0 0 .708.708L8 8.707l2.646 2.647a.5.5 0 0 0 .708-.708L8.707 8l2.647-2.646a.5.5 0 0 0-.708-.708L8 7.293 5.354 4.646z" />
              </svg>
            </div>
            <div class="ms-3">
              <p class="text-sm text-red-800">
                {{ session('error') }}
              </p>
            </div>
          </div>
        </div>
      @endif
      <form action="{{ route('cash.store') }}" method="POST" class="space-y-6">
        @csrf

        <!-- Administrator Selection -->
        <div>
          <label for="administrator_id" class="block text-sm font-medium text-gray-700 dark:text-neutral-300 mb-2">
            Pengurus <span class="text-red-500">*</span>
          </label>
          <select name="administrator_id" id="administrator_id" required
                  class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-neutral-800 dark:border-neutral-600 dark:text-neutral-200">
            <option value="">Pilih Pengurus</option>
            @foreach($administrators as $admin)
              <option value="{{ $admin->id }}" {{ old('administrator_id') == $admin->id ? 'selected' : '' }}>
                {{ $admin->name }} - {{ $admin->division->name }}
              </option>
            @endforeach
          </select>
          @error('administrator_id')
            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
          @enderror
        </div>

        <!-- Fund Selection -->
        <div>
          <label for="fund_id" class="block text-sm font-medium text-gray-700 dark:text-neutral-300 mb-2">
            Dana <span class="text-red-500">*</span>
          </label>
          <select name="fund_id" id="fund_id" required
                  class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-neutral-800 dark:border-neutral-600 dark:text-neutral-200">
            <option value="">Pilih Dana</option>
            @foreach($funds as $fund)
              <option value="{{ $fund->id }}" {{ old('fund_id') == $fund->id ? 'selected' : '' }}>
                {{ $fund->name }}
              </option>
            @endforeach
          </select>
          @error('fund_id')
            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
          @enderror
        </div>

        <!-- Month Selection -->
        <div>
          <label for="month" class="block text-sm font-medium text-gray-700 dark:text-neutral-300 mb-2">
            Bulan <span class="text-red-500">*</span>
          </label>
          <select name="month" id="month" required
                  class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-neutral-800 dark:border-neutral-600 dark:text-neutral-200">
            <option value="">Pilih Bulan</option>
            @php
              $months = [
                'april' => 'April',
                'may' => 'Mei', 
                'june' => 'Juni',
                'july' => 'Juli',
                'august' => 'Agustus',
                'september' => 'September',
                'october' => 'Oktober',
                'november' => 'November'
              ]
            @endphp
            @foreach($months as $key => $label)
              <option value="{{ $key }}" {{ old('month') == $key ? 'selected' : '' }}>
                {{ $label }}
              </option>
            @endforeach
          </select>
          @error('month')
            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
          @enderror
        </div>

        <!-- Date -->
        <div>
          <label for="date" class="block text-sm font-medium text-gray-700 dark:text-neutral-300 mb-2">
            Tanggal <span class="text-red-500">*</span>
          </label>
          <input type="date" 
                 name="date" 
                 id="date" 
                 value="{{ old('date') }}"
                 required
                 class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-neutral-800 dark:border-neutral-600 dark:text-neutral-200">
          @error('date')
            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
          @enderror
        </div>

        <!-- Cash Amount -->
        <div>
          <label for="cash_amount" class="block text-sm font-medium text-gray-700 dark:text-neutral-300 mb-2">
            Jumlah Kas <span class="text-red-500">*</span>
          </label>
          <div class="relative">
            <span class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-500 text-sm">Rp</span>
            <input type="number" 
                   name="cash_amount" 
                   id="cash_amount" 
                   value="{{ old('cash_amount', 0) }}"
                   min="0"
                   required
                   class="w-full pl-8 pr-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-neutral-800 dark:border-neutral-600 dark:text-neutral-200"
                   placeholder="0">
          </div>
          @error('cash_amount')
            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
          @enderror
          <p class="mt-1 text-xs text-gray-500 dark:text-neutral-400">
            Jumlah kas yang akan ditambahkan ke bulan yang dipilih
          </p>
        </div>

        <!-- Penalty Amount -->
        <div>
          <label for="penalty" class="block text-sm font-medium text-gray-700 dark:text-neutral-300 mb-2">
            Jumlah Denda <span class="text-red-500">*</span>
          </label>
          <div class="relative">
            <span class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-500 text-sm">Rp</span>
            <input type="number" 
                   name="penalty" 
                   id="penalty" 
                   value="{{ old('penalty', 0) }}"
                   min="0"
                   required
                   class="w-full pl-8 pr-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-neutral-800 dark:border-neutral-600 dark:text-neutral-200"
                   placeholder="0">
          </div>
          @error('penalty')
            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
          @enderror
          <p class="mt-1 text-xs text-gray-500 dark:text-neutral-400">
            Denda yang akan ditambahkan ke jumlah kas
          </p>
        </div>

        <!-- Total Preview -->
        <div class="bg-blue-50 dark:bg-blue-900/20 p-4 rounded-lg">
          <div class="flex items-center justify-between">
            <span class="text-sm font-medium text-blue-800 dark:text-blue-200">
              Total yang akan ditambahkan ke kas:
            </span>
            <span class="text-lg font-bold text-blue-800 dark:text-blue-200" id="totalPreview">
              Rp 0
            </span>
          </div>
          <div class="mt-2 text-xs text-blue-600 dark:text-blue-300">
            <span id="cashPreview">Kas: Rp 0</span> + <span id="penaltyPreview">Denda: Rp 0</span>
          </div>
        </div>

        <!-- Action Buttons -->
        <div class="flex items-center justify-end gap-x-3 pt-6 border-t border-gray-200 dark:border-neutral-700">
          <a href="{{ route('home') }}" 
             class="py-2 px-4 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-2xs hover:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none focus:outline-hidden focus:bg-gray-50 dark:bg-transparent dark:border-neutral-700 dark:text-neutral-300 dark:hover:bg-neutral-800 dark:focus:bg-neutral-800">
            Batal
          </a>
          <button type="submit" 
                  class="py-2 px-4 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 focus:outline-hidden focus:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
            </svg>
            Simpan Transaksi Kas
          </button>
        </div>
      </form>
    </div>
  </div>
</div>

<script>
// Live calculation of total cash + penalty
document.addEventListener('DOMContentLoaded', function() {
    const cashInput = document.getElementById('cash_amount');
    const penaltyInput = document.getElementById('penalty');
    const totalPreview = document.getElementById('totalPreview');
    const cashPreview = document.getElementById('cashPreview');
    const penaltyPreview = document.getElementById('penaltyPreview');
    
    function updateTotal() {
        const cashAmount = parseInt(cashInput.value) || 0;
        const penaltyAmount = parseInt(penaltyInput.value) || 0;
        const total = cashAmount + penaltyAmount;
        
        totalPreview.textContent = 'Rp ' + total.toLocaleString('id-ID');
        cashPreview.textContent = 'Kas: Rp ' + cashAmount.toLocaleString('id-ID');
        penaltyPreview.textContent = 'Denda: Rp ' + penaltyAmount.toLocaleString('id-ID');
    }
    
    cashInput.addEventListener('input', updateTotal);
    penaltyInput.addEventListener('input', updateTotal);
    
    // Initial calculation
    updateTotal();
});
</script>
@endsection
