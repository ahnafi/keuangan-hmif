@extends('layouts.app')

@section('title', "Edit Data Kas")

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
                                    Histori Pembayaran Kas
                                </h2>
                                <p class="text-sm text-gray-600 dark:text-neutral-400">
                                    Pengurus: <span class="font-medium">{{ $cash->administrator->name }}</span> -
                                    Divisi: <span
                                        class="font-medium">{{ $cash->administrator->division->name ?? 'N/A' }}</span>
                                </p>
                            </div>

                            <div>
                                <div class="inline-flex gap-x-2">
                                    <button type="button" class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 focus:outline-hidden focus:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none"
                                        data-hs-overlay="#add-cash-modal">
                                        <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24"
                                            height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M5 12h14" />
                                            <path d="M12 5v14" />
                                        </svg>
                                        Bayar kas
                                    </button>
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

                        @if(session('success'))
                            <div class="px-6 py-4">
                                <div
                                    class="bg-green-50 border border-green-200 text-green-800 rounded-lg p-4 dark:bg-green-800/10 dark:border-green-900 dark:text-green-500">
                                    {{ session('success') }}
                                </div>
                            </div>
                        @endif

                        @if(session('error'))
                            <div class="px-6 py-4">
                                <div
                                    class="bg-red-50 border border-red-200 text-red-800 rounded-lg p-4 dark:bg-red-800/10 dark:border-red-900 dark:text-red-500">
                                    {{ session('error') }}
                                </div>
                            </div>
                        @endif

                        @if($errors->any())
                            <div class="px-6 py-4">
                                <div
                                    class="bg-red-50 border border-red-200 text-red-800 rounded-lg p-4 dark:bg-red-800/10 dark:border-red-900 dark:text-red-500">
                                    <h4 class="font-semibold mb-2">Terdapat kesalahan pada formulir:</h4>
                                    <ul class="list-disc list-inside space-y-1">
                                        @foreach($errors->all() as $error)
                                            <li class="text-sm">{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        @endif

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

                                    <th scope="col" class="px-6 py-3 text-start">
                                        <div class="flex items-center gap-x-2">
                                            <span
                                                class="text-xs font-semibold uppercase text-gray-800 dark:text-neutral-200">
                                                Total Bayar
                                            </span>
                                        </div>
                                    </th>

                                    <th scope="col" class="px-6 py-3 text-end">Aksi</th>
                                </tr>
                            </thead>

                            <tbody class="divide-y divide-gray-200 dark:divide-neutral-700">
                                @php
                                    $totalKas = 0;
                                    $totalDenda = 0;
                                    $totalBayar = 0;
                                @endphp

                                @forelse($cashHistory as $history)
                                    @php
                                        $totalKas += $history->pivot->cash;
                                        $totalDenda += $history->pivot->penalty;
                                        $totalBayar += $history->pivot->amount;
                                    @endphp
                                    <tr>
                                        <td class="size-px whitespace-nowrap">
                                            <div class="ps-6 py-3">
                                                <span class="text-sm text-gray-800 dark:text-neutral-200">
                                                    {{ \Carbon\Carbon::parse($history->pivot->date)->format('d M Y') }}
                                                </span>
                                            </div>
                                        </td>
                                        <td class="h-px w-72 whitespace-nowrap">
                                            <div class="px-6 py-3">
                                                <span class="block text-sm font-semibold text-gray-800 dark:text-neutral-200">
                                                    {{ $history->name }}
                                                </span>
                                            </div>
                                        </td>
                                        <td class="size-px whitespace-nowrap">
                                            <div class="px-6 py-3">
                                                <span
                                                    class="inline-flex items-center gap-x-1.5 py-1.5 px-3 rounded-full text-xs font-medium bg-blue-100 text-blue-800 dark:bg-blue-800/30 dark:text-blue-500">
                                                    {{ ucfirst($history->pivot->month) }}
                                                </span>
                                            </div>
                                        </td>
                                        <td class="size-px whitespace-nowrap">
                                            <div class="px-6 py-3">
                                                <span class="text-sm text-gray-800 dark:text-neutral-200">
                                                    Rp {{ number_format($history->pivot->cash, 0, ',', '.') }}
                                                </span>
                                            </div>
                                        </td>
                                        <td class="size-px whitespace-nowrap">
                                            <div class="px-6 py-3">
                                                <span class="text-sm text-red-600 dark:text-red-400">
                                                    Rp {{ number_format($history->pivot->penalty, 0, ',', '.') }}
                                                </span>
                                            </div>
                                        </td>
                                        <td class="size-px whitespace-nowrap">
                                            <div class="px-6 py-3">
                                                <span class="text-sm font-semibold text-gray-800 dark:text-neutral-200">
                                                    Rp {{ number_format($history->pivot->amount, 0, ',', '.') }}
                                                </span>
                                            </div>
                                        </td>
                                        <td class="size-px whitespace-nowrap">
                                            <div class="px-6 py-1.5 flex gap-x-2">
                                                <a class="inline-flex items-center gap-x-1 text-sm text-green-600 decoration-2 hover:underline focus:outline-hidden focus:underline font-medium dark:text-green-500"
                                                    href="#"
                                                    onclick="openEditModal({{ $history->pivot->id }}, '{{ $history->pivot->date }}', '{{ $history->pivot->month }}', {{ $history->pivot->penalty }}, {{ $history->pivot->cash }}, {{ $history->id }}, '{{ $history->name }}'); return false;"
                                                    data-hs-overlay="#edit-history-modal">
                                                    Edit
                                                </a>
                                                <form method="POST"
                                                    action="{{ route('cash.history.destroy', [$cash, $history->pivot->id]) }}"
                                                    class="inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        onclick="return confirm('Apakah Anda yakin ingin menghapus histori ini?')"
                                                        class="inline-flex items-center gap-x-1 text-sm text-red-600 decoration-2 hover:underline focus:outline-hidden focus:underline font-medium dark:text-red-500">
                                                        Hapus
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="px-6 py-12 text-center">
                                            <p class="text-gray-500 dark:text-neutral-500">Belum ada histori pembayaran kas.</p>
                                        </td>
                                    </tr>
                                @endforelse

                                <!-- Total Row -->
                                @if($cashHistory->count() > 0)
                                    <tr
                                        class="bg-gray-50 dark:bg-neutral-800 border-t-2 border-gray-300 dark:border-neutral-600">
                                        <td class="size-px whitespace-nowrap">
                                            <div class="ps-6 py-3">
                                                <span class="text-sm font-bold text-gray-800 dark:text-neutral-200">
                                                    TOTAL
                                                </span>
                                            </div>
                                        </td>
                                        <td class="h-px w-72 whitespace-nowrap">
                                            <div class="px-6 py-3">
                                                <span class="block text-sm font-bold text-gray-800 dark:text-neutral-200">
                                                    {{ $cashHistory->count() }} Transaksi
                                                </span>
                                            </div>
                                        </td>
                                        <td class="size-px whitespace-nowrap">
                                            <div class="px-6 py-3">
                                                <span class="text-sm font-bold text-gray-800 dark:text-neutral-200">

                                                </span>
                                            </div>
                                        </td>
                                        <td class="size-px whitespace-nowrap">
                                            <div class="px-6 py-3">
                                                <span class="text-sm font-bold text-green-600 dark:text-green-400">
                                                    Rp {{ number_format($totalKas, 0, ',', '.') }}
                                                </span>
                                            </div>
                                        </td>
                                        <td class="size-px whitespace-nowrap">
                                            <div class="px-6 py-3">
                                                <span class="text-sm font-bold text-red-600 dark:text-red-400">
                                                    Rp {{ number_format($totalDenda, 0, ',', '.') }}
                                                </span>
                                            </div>
                                        </td>
                                        <td class="size-px whitespace-nowrap">
                                            <div class="px-6 py-3">
                                                <span class="text-sm font-bold text-blue-600 dark:text-blue-400">
                                                    Rp {{ number_format($totalBayar, 0, ',', '.') }}
                                                </span>
                                            </div>
                                        </td>
                                        <td class="size-px whitespace-nowrap">
                                            <div class="px-6 py-3">
                                                <span class="text-sm font-bold text-gray-800 dark:text-neutral-200">

                                                </span>
                                            </div>
                                        </td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                        <!-- End Table -->
                    </div>
                </div>
            </div>
        </div>
        <!-- End Card -->
    </div>
    <!-- End Table Section -->

    <!-- Edit Modal using HS Overlay Template -->
    <div id="edit-history-modal" class="hs-overlay hidden size-full fixed top-0 start-0 z-80 overflow-x-hidden overflow-y-auto pointer-events-none" role="dialog" tabindex="-1" aria-labelledby="edit-history-modal-label">
        <div class="hs-overlay-open:mt-7 hs-overlay-open:opacity-100 hs-overlay-open:duration-500 mt-0 opacity-0 ease-out transition-all sm:max-w-lg sm:w-full m-3 sm:mx-auto min-h-[calc(100%-56px)] flex items-center">
            <div class="w-full flex flex-col bg-white border border-gray-200 shadow-2xs rounded-xl pointer-events-auto dark:bg-neutral-800 dark:border-neutral-700 dark:shadow-neutral-700/70">
                <!-- Modal Header -->
                <div class="flex justify-between items-center py-3 px-4 border-b border-gray-200 dark:border-neutral-700">
                    <h3 id="edit-history-modal-label" class="font-bold text-gray-800 dark:text-white">
                        Edit Histori Pembayaran Kas
                    </h3>
                    <button type="button" class="size-8 inline-flex justify-center items-center gap-x-2 rounded-full border border-transparent bg-gray-100 text-gray-800 hover:bg-gray-200 focus:outline-hidden focus:bg-gray-200 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-700 dark:hover:bg-neutral-600 dark:text-neutral-400 dark:focus:bg-neutral-600" aria-label="Close" data-hs-overlay="#edit-history-modal">
                        <span class="sr-only">Close</span>
                        <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M18 6 6 18"></path>
                            <path d="m6 6 12 12"></path>
                        </svg>
                    </button>
                </div>
                
                <!-- Modal Body -->
                <div class="p-4 overflow-y-auto">
                    <form id="editForm" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <div class="space-y-4">
                            <!-- Fund Selection -->
                            <div>
                                <label for="edit_fund_id" class="block text-sm font-medium text-gray-700 dark:text-neutral-300 mb-2">
                                    Dana <span class="text-red-500">*</span>
                                </label>
                                <select name="fund_id" id="edit_fund_id" required
                                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-neutral-700 dark:border-neutral-600 dark:text-neutral-200">
                                    <option value="">Pilih Dana</option>
                                    @foreach(\App\Models\Fund::all() as $fund)
                                        <option value="{{ $fund->id }}">{{ $fund->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Month Selection -->
                            <div>
                                <label for="edit_month" class="block text-sm font-medium text-gray-700 dark:text-neutral-300 mb-2">
                                    Bulan <span class="text-red-500">*</span>
                                </label>
                                <select name="month" id="edit_month" required
                                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-neutral-700 dark:border-neutral-600 dark:text-neutral-200">
                                    <option value="">Pilih Bulan</option>
                                    <option value="april">April</option>
                                    <option value="may">Mei</option>
                                    <option value="june">Juni</option>
                                    <option value="july">Juli</option>
                                    <option value="august">Agustus</option>
                                    <option value="september">September</option>
                                    <option value="october">Oktober</option>
                                    <option value="november">November</option>
                                </select>
                            </div>

                            <!-- Date -->
                            <div>
                                <label for="edit_date" class="block text-sm font-medium text-gray-700 dark:text-neutral-300 mb-2">
                                    Tanggal <span class="text-red-500">*</span>
                                </label>
                                <input type="date" 
                                       name="date" 
                                       id="edit_date" 
                                       required
                                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-neutral-700 dark:border-neutral-600 dark:text-neutral-200">
                            </div>

                            <!-- Cash Amount -->
                            <div>
                                <label for="edit_cash_amount" class="block text-sm font-medium text-gray-700 dark:text-neutral-300 mb-2">
                                    Jumlah Kas <span class="text-red-500">*</span>
                                </label>
                                <div class="relative">
                                    <span class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-500 text-sm">Rp</span>
                                    <input type="number" 
                                           name="cash_amount" 
                                           id="edit_cash_amount" 
                                           min="0"
                                           required
                                           class="w-full pl-8 pr-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-neutral-700 dark:border-neutral-600 dark:text-neutral-200"
                                           placeholder="0">
                                </div>
                            </div>

                            <!-- Penalty Amount -->
                            <div>
                                <label for="edit_penalty" class="block text-sm font-medium text-gray-700 dark:text-neutral-300 mb-2">
                                    Jumlah Denda <span class="text-red-500">*</span>
                                </label>
                                <div class="relative">
                                    <span class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-500 text-sm">Rp</span>
                                    <input type="number" 
                                           name="penalty" 
                                           id="edit_penalty" 
                                           min="0"
                                           required
                                           class="w-full pl-8 pr-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-neutral-700 dark:border-neutral-600 dark:text-neutral-200"
                                           placeholder="0">
                                </div>
                            </div>

                            <!-- Total Preview -->
                            <div class="bg-blue-50 dark:bg-blue-900/20 p-3 rounded-lg">
                                <div class="flex items-center justify-between">
                                    <span class="text-sm font-medium text-blue-800 dark:text-blue-200">
                                        Total yang akan dibayar:
                                    </span>
                                    <span class="text-lg font-bold text-blue-800 dark:text-blue-200" id="editTotalPreview">
                                        Rp 0
                                    </span>
                                </div>
                                <div class="mt-1 text-xs text-blue-600 dark:text-blue-300">
                                    <span id="editCashPreview">Kas: Rp 0</span> + <span id="editPenaltyPreview">Denda: Rp 0</span>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                
                <!-- Modal Footer -->
                <div class="flex justify-end items-center gap-x-2 py-3 px-4 border-t border-gray-200 dark:border-neutral-700">
                    <button type="button" class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-2xs hover:bg-gray-50 focus:outline-hidden focus:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:text-white dark:hover:bg-neutral-700 dark:focus:bg-neutral-700" data-hs-overlay="#edit-history-modal">
                        Batal
                    </button>
                    <button type="button" onclick="submitEditForm()" class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 focus:outline-hidden focus:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                        Simpan Perubahan
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Cash Modal using HS Overlay Template -->
    <div id="add-cash-modal" class="hs-overlay hidden size-full fixed top-0 start-0 z-80 overflow-x-hidden overflow-y-auto pointer-events-none" role="dialog" tabindex="-1" aria-labelledby="add-cash-modal-label">
        <div class="hs-overlay-open:mt-7 hs-overlay-open:opacity-100 hs-overlay-open:duration-500 mt-0 opacity-0 ease-out transition-all sm:max-w-lg sm:w-full m-3 sm:mx-auto min-h-[calc(100%-56px)] flex items-center">
            <div class="w-full flex flex-col bg-white border border-gray-200 shadow-2xs rounded-xl pointer-events-auto dark:bg-neutral-800 dark:border-neutral-700 dark:shadow-neutral-700/70">
                <!-- Modal Header -->
                <div class="flex justify-between items-center py-3 px-4 border-b border-gray-200 dark:border-neutral-700">
                    <h3 id="add-cash-modal-label" class="font-bold text-gray-800 dark:text-white">
                        Tambah Pembayaran Kas
                    </h3>
                    <button type="button" class="size-8 inline-flex justify-center items-center gap-x-2 rounded-full border border-transparent bg-gray-100 text-gray-800 hover:bg-gray-200 focus:outline-hidden focus:bg-gray-200 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-700 dark:hover:bg-neutral-600 dark:text-neutral-400 dark:focus:bg-neutral-600" aria-label="Close" data-hs-overlay="#add-cash-modal">
                        <span class="sr-only">Close</span>
                        <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M18 6 6 18"></path>
                            <path d="m6 6 12 12"></path>
                        </svg>
                    </button>
                </div>
                
                <!-- Modal Body -->
                <div class="p-4 overflow-y-auto">
                    <form id="addForm" method="POST" action="{{ route('cash.store') }}">
                        @csrf
                        <input type="hidden" name="administrator_id" value="{{ $cash->administrator_id }}">
                        
                        <div class="space-y-4">
                            <!-- Administrator Info (Display Only) -->
                            <div class="bg-gray-50 dark:bg-neutral-700 p-3 rounded-lg">
                                <div class="flex items-center ">
                                    <span class="text-sm pe-1 font-medium text-gray-700 dark:text-neutral-300">
                                        Pengurus : 
                                    </span>
                                    <span class="text-sm font-semibold text-gray-800 dark:text-neutral-200">
                                        {{ $cash->administrator->name }} - {{ $cash->administrator->division->name }}
                                    </span>
                                </div>
                            </div>

                            <!-- Fund Selection -->
                            <div>
                                <label for="add_fund_id" class="block text-sm font-medium text-gray-700 dark:text-neutral-300 mb-2">
                                    Dana <span class="text-red-500">*</span>
                                </label>
                                <select name="fund_id" id="add_fund_id" required
                                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-neutral-700 dark:border-neutral-600 dark:text-neutral-200">
                                    <option value="">Pilih Dana</option>
                                    @foreach(\App\Models\Fund::all() as $fund)
                                        <option value="{{ $fund->id }}">{{ $fund->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Month Selection -->
                            <div>
                                <label for="add_month" class="block text-sm font-medium text-gray-700 dark:text-neutral-300 mb-2">
                                    Bulan <span class="text-red-500">*</span>
                                </label>
                                <select name="month" id="add_month" required
                                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-neutral-700 dark:border-neutral-600 dark:text-neutral-200">
                                    <option value="">Pilih Bulan</option>
                                    <option value="april">April</option>
                                    <option value="may">Mei</option>
                                    <option value="june">Juni</option>
                                    <option value="july">Juli</option>
                                    <option value="august">Agustus</option>
                                    <option value="september">September</option>
                                    <option value="october">Oktober</option>
                                    <option value="november">November</option>
                                </select>
                            </div>

                            <!-- Date -->
                            <div>
                                <label for="add_date" class="block text-sm font-medium text-gray-700 dark:text-neutral-300 mb-2">
                                    Tanggal <span class="text-red-500">*</span>
                                </label>
                                <input type="date" 
                                       name="date" 
                                       id="add_date" 
                                       required
                                       value="{{ date('Y-m-d') }}"
                                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-neutral-700 dark:border-neutral-600 dark:text-neutral-200">
                            </div>

                            <!-- Cash Amount -->
                            <div>
                                <label for="add_cash_amount" class="block text-sm font-medium text-gray-700 dark:text-neutral-300 mb-2">
                                    Jumlah Kas <span class="text-red-500">*</span>
                                </label>
                                <div class="relative">
                                    <span class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-500 text-sm">Rp</span>
                                    <input type="number" 
                                           name="cash_amount" 
                                           id="add_cash_amount" 
                                           min="0"
                                           value="0"
                                           required
                                           class="w-full pl-8 pr-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-neutral-700 dark:border-neutral-600 dark:text-neutral-200"
                                           placeholder="0">
                                </div>
                            </div>

                            <!-- Penalty Amount -->
                            <div>
                                <label for="add_penalty" class="block text-sm font-medium text-gray-700 dark:text-neutral-300 mb-2">
                                    Jumlah Denda <span class="text-red-500">*</span>
                                </label>
                                <div class="relative">
                                    <span class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-500 text-sm">Rp</span>
                                    <input type="number" 
                                           name="penalty" 
                                           id="add_penalty" 
                                           min="0"
                                           value="0"
                                           required
                                           class="w-full pl-8 pr-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-neutral-700 dark:border-neutral-600 dark:text-neutral-200"
                                           placeholder="0">
                                </div>
                            </div>

                            <!-- Total Preview -->
                            <div class="bg-blue-50 dark:bg-blue-900/20 p-3 rounded-lg">
                                <div class="flex items-center justify-between">
                                    <span class="text-sm font-medium text-blue-800 dark:text-blue-200">
                                        Total yang akan ditambahkan:
                                    </span>
                                    <span class="text-lg font-bold text-blue-800 dark:text-blue-200" id="addTotalPreview">
                                        Rp 0
                                    </span>
                                </div>
                                <div class="mt-1 text-xs text-blue-600 dark:text-blue-300">
                                    <span id="addCashPreview">Kas: Rp 0</span> + <span id="addPenaltyPreview">Denda: Rp 0</span>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                
                <!-- Modal Footer -->
                <div class="flex justify-end items-center gap-x-2 py-3 px-4 border-t border-gray-200 dark:border-neutral-700">
                    <button type="button" class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-2xs hover:bg-gray-50 focus:outline-hidden focus:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:text-white dark:hover:bg-neutral-700 dark:focus:bg-neutral-700" data-hs-overlay="#add-cash-modal">
                        Batal
                    </button>
                    <button type="button" onclick="submitAddForm()" class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 focus:outline-hidden focus:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                        Simpan Pembayaran
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        function openEditModal(id, date, month, penalty, cash, fundId, fundName) {
            // Set form action to update route
            const form = document.getElementById('editForm');
            form.action = `{{ route('cash.history.update', [$cash, '__PIVOT_ID__']) }}`.replace('__PIVOT_ID__', id);
            
            // Populate form fields
            document.getElementById('edit_fund_id').value = fundId;
            document.getElementById('edit_month').value = month;
            document.getElementById('edit_date').value = date;
            document.getElementById('edit_cash_amount').value = cash;
            document.getElementById('edit_penalty').value = penalty;
            
            // Update total preview
            updateEditTotal();
        }

        function submitEditForm() {
            document.getElementById('editForm').submit();
        }

        function updateEditTotal() {
            const cashAmount = parseInt(document.getElementById('edit_cash_amount').value) || 0;
            const penaltyAmount = parseInt(document.getElementById('edit_penalty').value) || 0;
            const total = cashAmount + penaltyAmount;
            
            document.getElementById('editTotalPreview').textContent = 'Rp ' + total.toLocaleString('id-ID');
            document.getElementById('editCashPreview').textContent = 'Kas: Rp ' + cashAmount.toLocaleString('id-ID');
            document.getElementById('editPenaltyPreview').textContent = 'Denda: Rp ' + penaltyAmount.toLocaleString('id-ID');
        }

        // Submit add form function
        function submitAddForm() {
            document.getElementById('addForm').submit();
        }

        // Update total calculation for add modal
        function updateAddTotal() {
            const cashAmount = parseInt(document.getElementById('add_cash_amount').value) || 0;
            const penaltyAmount = parseInt(document.getElementById('add_penalty').value) || 0;
            const total = cashAmount + penaltyAmount;
            
            document.getElementById('addTotalPreview').textContent = 'Rp ' + total.toLocaleString('id-ID');
            document.getElementById('addCashPreview').textContent = 'Kas: Rp ' + cashAmount.toLocaleString('id-ID');
            document.getElementById('addPenaltyPreview').textContent = 'Denda: Rp ' + penaltyAmount.toLocaleString('id-ID');
        }

        // Live calculation for both modals
        document.addEventListener('DOMContentLoaded', function() {
            // Edit modal
            const editCashInput = document.getElementById('edit_cash_amount');
            const editPenaltyInput = document.getElementById('edit_penalty');
            
            if (editCashInput && editPenaltyInput) {
                editCashInput.addEventListener('input', updateEditTotal);
                editPenaltyInput.addEventListener('input', updateEditTotal);
            }

            // Add modal
            const addCashInput = document.getElementById('add_cash_amount');
            const addPenaltyInput = document.getElementById('add_penalty');
            
            if (addCashInput && addPenaltyInput) {
                addCashInput.addEventListener('input', updateAddTotal);
                addPenaltyInput.addEventListener('input', updateAddTotal);
                
                // Initialize calculation on page load
                updateAddTotal();
            }
        });
    </script>
@endsection