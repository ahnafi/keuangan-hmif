@extends('layouts.app')

@section('title', 'Riwayat Pengurangan Deposit')

@section('content')

<!-- Flash Messages -->
@if(session('success'))
    <div class="max-w-[85rem] px-4 mx-auto">
        <div class="bg-green-50 border border-green-200 rounded-lg p-4 mb-4" role="alert">
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
    </div>
@endif

@if(session('error'))
    <div class="max-w-[85rem] px-4 mx-auto">
        <div class="bg-red-50 border border-red-200 rounded-lg p-4 mb-4" role="alert">
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
    </div>
@endif

@if($errors->any())
    <div class="max-w-[85rem] px-4 mx-auto">
        <div class="bg-red-50 border border-red-200 rounded-lg p-4 mb-4" role="alert">
            <div class="flex">
                <div class="flex-shrink-0">
                    <svg class="h-4 w-4 text-red-400 mt-0.5" xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                        fill="currentColor" viewBox="0 0 16 16">
                        <path
                            d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM5.354 4.646a.5.5 0 1 0-.708.708L7.293 8l-2.647 2.646a.5.5 0 0 0 .708.708L8 8.707l2.646 2.647a.5.5 0 0 0 .708-.708L8.707 8l2.647-2.646a.5.5 0 0 0-.708-.708L8 7.293 5.354 4.646z" />
                    </svg>
                </div>
                <div class="ms-3">
                    <div class="text-sm text-red-800">
                        <p class="font-medium">Terjadi kesalahan dalam validasi:</p>
                        <ul class="mt-1 list-disc list-inside space-y-1">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif

<!-- Administrator Info Header -->
<div class="max-w-[85rem] px-4 py-4 mx-auto">
    <div class="bg-white border border-gray-200 rounded-xl shadow-2xs p-6 dark:bg-neutral-800 dark:border-neutral-700">
        <div class="flex items-center justify-between">
            <div class="flex items-center gap-x-4">
                <div class="flex-shrink-0">
                    <div
                        class="inline-flex items-center justify-center size-12 bg-blue-100 rounded-lg dark:bg-blue-800/30">
                        <svg class="size-6 text-blue-600 dark:text-blue-400" xmlns="http://www.w3.org/2000/svg"
                            width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2" />
                            <circle cx="9" cy="7" r="4" />
                            <path d="m22 21-3-3m0 0a2 2 0 0 0 0-4 2 2 0 0 0 0 4z" />
                        </svg>
                    </div>
                </div>
                <div>
                    <h1 class="text-xl font-semibold text-gray-800 dark:text-neutral-200">
                        {{ $deposit->administrator->name }}
                    </h1>
                    <p class="text-sm text-gray-600 dark:text-neutral-400">
                        {{ $deposit->administrator->division->name }}
                    </p>
                </div>
            </div>
            <div class="text-right">
                <p class="text-sm font-medium text-gray-600 dark:text-neutral-400">
                    Total Pembayaran Deposit
                </p>
                <p class="text-2xl font-bold text-green-600 dark:text-green-400">
                    Rp {{ number_format($depositFunds->sum('pivot.amount'), 0, ',', '.') }}
                </p>
            </div>
        </div>
    </div>
</div>

<!-- Table Section penalties -->
<div class="max-w-[85rem] px-4 py-4 sm:px-6 lg:px-8 lg:py-4 mx-auto">
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
                                Histori denda
                            </h2>
                            <p class="text-sm text-gray-600 dark:text-neutral-400">
                                Semua histori denda pengurus.
                            </p>
                        </div>

                        <div>
                            <div class="inline-flex gap-x-2">
                                @role("bendahara")
                                <button
                                    class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-red-600 text-white hover:bg-red-700 focus:outline-hidden focus:bg-red-700 disabled:opacity-50 disabled:pointer-events-none"
                                    data-hs-overlay="#penalty-deposit-modal">
                                    <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24"
                                        height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path
                                            d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z" />
                                    </svg>
                                    Denda
                                </button>
                                @endrole
                                {{-- <a class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-300 bg-white text-gray-700 hover:bg-gray-50 focus:outline-hidden focus:bg-gray-50 dark:bg-neutral-800 dark:border-neutral-700 dark:text-neutral-300 dark:hover:bg-neutral-700"
                                    href="{{ route('deposit.index') }}">
                                    <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24"
                                        height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M19 12H6m0 0l4 4m-4-4l4-4" />
                                    </svg>
                                    Kembali
                                </a> --}}
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
                                            Denda
                                        </span>
                                    </div>
                                </th>

                                <th scope="col" class="px-6 py-3 text-start">
                                    <div class="flex items-center gap-x-2">
                                        <span
                                            class="text-xs font-semibold uppercase text-gray-800 dark:text-neutral-200">
                                            Keterangan
                                        </span>
                                    </div>
                                </th>

                                <th scope="col" class="px-6 py-3 text-start">
                                    <div class="flex items-center gap-x-2">
                                        <span
                                            class="text-xs font-semibold uppercase text-gray-800 dark:text-neutral-200">
                                            Aksi
                                        </span>
                                    </div>
                                </th>

                            </tr>
                        </thead>

                        <tbody class="divide-y divide-gray-200 dark:divide-neutral-700">

                            @forelse($penalties as $penalty)
                                <tr>
                                    <td class="size-px whitespace-nowrap">
                                        <div class="ps-6 py-3">
                                            <span class="text-sm text-gray-800 dark:text-neutral-200">
                                                {{ \Carbon\Carbon::parse($penalty->date)->format('d M Y') }}
                                            </span>
                                        </div>
                                    </td>
                                    <td class="h-px w-72 whitespace-nowrap">
                                        <div class="px-6 py-3">
                                            <span class="block text-sm font-normal text-red-600 dark:text-red-400">
                                                Rp {{ number_format($penalty->amount ?? 0, 0, ',', '.') }}
                                            </span>
                                        </div>
                                    </td>
                                    <td class="h-px w-72 whitespace-nowrap">
                                        <div class="px-6 py-3">
                                            <span class="block text-sm font-normal text-gray-800 dark:text-neutral-200">
                                                {{ $penalty->detail_description }}
                                            </span>
                                        </div>
                                    </td>
                                    <td class="h-px w-72 whitespace-nowrap">
                                        <div class="px-6 py-3 flex gap-x-2">
                                            <button type="button"
                                                onclick="editPenalty({{ $penalty->deposit->id }}, {{ $penalty->id }}, '{{ $penalty->detail }}', '{{ $penalty->date }}', {{ $penalty->amount }})"
                                                class="inline-flex items-center gap-x-1 text-sm text-blue-600 decoration-2 hover:underline focus:outline-hidden focus:underline font-medium dark:text-blue-500">
                                                Edit
                                            </button>
                                            <form
                                                action="{{ route("deposit.penalty.destroy", [$penalty->deposit->id, $penalty->id]) }}"
                                                method="post" class="inline">
                                                @csrf
                                                @method("delete")
                                                <button type="submit"
                                                    onclick="return confirm('Yakin menghapus histori ini?')"
                                                    class="inline-flex items-center gap-x-1 text-sm text-red-600 decoration-2 hover:underline focus:outline-hidden focus:underline font-medium dark:text-red-500">
                                                    Hapus
                                                </button>
                                            </form>
                                        </div>
                                    </td>

                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-12 text-center">
                                        <p class="text-gray-500 dark:text-neutral-500">Tidak ada histori denda ditemukan.
                                        </p>
                                    </td>
                                </tr>
                            @endforelse

                        </tbody>
                        <tfoot class="bg-gray-50 dark:bg-neutral-800">
                            <tr>
                                <td colspan="1" class="ps-6 py-3 text-start">
                                    <span class="text-sm font-semibold text-gray-800 dark:text-neutral-200">
                                        Total Denda:
                                    </span>
                                </td>
                                <td class="px-6 py-3">
                                    <span class="text-sm font-bold text-red-600 dark:text-red-400">
                                        Rp {{ number_format($penalties->sum('amount'), 0, ',', '.') }}
                                    </span>
                                </td>
                                <td colspan="2" class="px-6 py-3"></td>
                            </tr>
                        </tfoot>
                    </table>
                    <!-- End Table -->

                    <!-- Footer with Pagination -->
                    @if($penalties->hasPages())
                        <div
                            class="px-6 py-4 grid gap-3 md:flex md:justify-between md:items-center border-t border-gray-200 dark:border-neutral-700">
                            <div>
                                {{-- <p class="text-sm text-gray-600 dark:text-neutral-400">
                                    <span class="font-semibold text-gray-800 dark:text-neutral-200">{{
                                        $penalties->total() }}</span> total transaksi
                                </p> --}}
                            </div>

                            <div>
                                {{ $penalties->links() }}
                            </div>
                        </div>
                    @endif
                    <!-- End Footer -->
                </div>
            </div>
        </div>
    </div>
    <!-- End Card -->
</div>
<!-- End Table Section -->

<!-- Table Section deposit -->
<div class="max-w-[85rem] px-4 py-4 sm:px-6 lg:px-8 lg:py-4 mx-auto">
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
                                Histori Pembayaran Deposit
                            </h2>
                            <p class="text-sm text-gray-600 dark:text-neutral-400">
                                Semua histori pembayaran deposit pengurus.
                            </p>
                        </div>

                        <div>
                            <div class="inline-flex gap-x-2">
                                @role("bendahara")
                                <button
                                    class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 focus:outline-hidden focus:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none"
                                    data-hs-overlay="#deposit-payment-modal">
                                    <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24"
                                        height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M12 2v20M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6" />
                                    </svg>
                                    Bayar Deposit
                                </button>
                                @endrole
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
                                            Dana
                                        </span>
                                    </div>
                                </th>

                                <th scope="col" class="px-6 py-3 text-start">
                                    <div class="flex items-center gap-x-2">
                                        <span
                                            class="text-xs font-semibold uppercase text-gray-800 dark:text-neutral-200">
                                            Jumlah
                                        </span>
                                    </div>
                                </th>

                                <th scope="col" class="px-6 py-3 text-start">
                                    <div class="flex items-center gap-x-2">
                                        <span
                                            class="text-xs font-semibold uppercase text-gray-800 dark:text-neutral-200">
                                            Aksi
                                        </span>
                                    </div>
                                </th>

                            </tr>
                        </thead>

                        <tbody class="divide-y divide-gray-200 dark:divide-neutral-700">

                            @forelse($depositFunds as $depositFund)
                                <tr>
                                    <td class="size-px whitespace-nowrap">
                                        <div class="ps-6 py-3">
                                            <span class="text-sm text-gray-800 dark:text-neutral-200">
                                                {{ \Carbon\Carbon::parse($depositFund->pivot->date)->format('d M Y') }}
                                            </span>
                                        </div>
                                    </td>
                                    <td class="h-px w-72 whitespace-nowrap">
                                        <div class="px-6 py-3">
                                            <span class="block text-sm font-semibold text-gray-800 dark:text-neutral-200">
                                                {{ $depositFund->name }}
                                            </span>
                                        </div>
                                    </td>
                                    <td class="h-px w-72 whitespace-nowrap">
                                        <div class="px-6 py-3">
                                            <span class="block text-sm font-normal text-green-600 dark:text-green-400">
                                                Rp {{ number_format($depositFund->pivot->amount ?? 0, 0, ',', '.') }}
                                            </span>
                                        </div>
                                    </td>
                                    <td class="h-px w-72 whitespace-nowrap">
                                        <div class="px-6 py-3 flex gap-x-2">
                                            @role("bendahara")
                                            <button type="button"
                                                onclick="editDepositPayment({{ $deposit->id }}, {{ $depositFund->id }}, '{{ $depositFund->pivot->date }}', {{ $depositFund->pivot->amount }}, '{{ $depositFund->name }}')"
                                                class="inline-flex items-center gap-x-1 text-sm text-blue-600 decoration-2 hover:underline focus:outline-hidden focus:underline font-medium dark:text-blue-500">
                                                Edit
                                            </button>
                                            <form
                                                action="{{ route("deposit.destroy", [$deposit->id, $depositFund->id]) }}"
                                                method="post" class="inline">
                                                @csrf
                                                @method("delete")
                                                <button type="submit"
                                                    onclick="return confirm('Yakin menghapus pembayaran deposit ini?')"
                                                    class="inline-flex items-center gap-x-1 text-sm text-red-600 decoration-2 hover:underline focus:outline-hidden focus:underline font-medium dark:text-red-500">
                                                    Hapus
                                                </button>
                                            </form>
                                            @endrole
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-6 py-12 text-center">
                                        <p class="text-gray-500 dark:text-neutral-500">Tidak ada pembayaran deposit ditemukan.</p>
                                    </td>
                                </tr>
                            @endforelse

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

<!-- Deposit Payment Modal -->
<div id="deposit-payment-modal"
    class="hs-overlay hidden size-full fixed top-0 start-0 z-80 overflow-x-hidden overflow-y-auto pointer-events-none"
    role="dialog" tabindex="-1" aria-labelledby="deposit-payment-modal-label">
    <div
        class="hs-overlay-open:mt-7 hs-overlay-open:opacity-100 hs-overlay-open:duration-500 mt-0 opacity-0 ease-out transition-all sm:max-w-lg sm:w-full m-3 sm:mx-auto min-h-[calc(100%-56px)] flex items-center">
        <div
            class="w-full flex flex-col bg-white border border-gray-200 shadow-2xs rounded-xl pointer-events-auto dark:bg-neutral-800 dark:border-neutral-700 dark:shadow-neutral-700/70">
            <!-- Modal Header -->
            <div class="flex justify-between items-center py-3 px-4 border-b border-gray-200 dark:border-neutral-700">
                <h3 id="deposit-payment-modal-label" class="font-bold text-gray-800 dark:text-white">
                    Bayar Deposit
                </h3>
                <button type="button"
                    class="size-8 inline-flex justify-center items-center gap-x-2 rounded-full border border-transparent bg-gray-100 text-gray-800 hover:bg-gray-200 focus:outline-hidden focus:bg-gray-200 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-700 dark:hover:bg-neutral-600 dark:text-neutral-400 dark:focus:bg-neutral-600"
                    aria-label="Close" data-hs-overlay="#deposit-payment-modal">
                    <span class="sr-only">Close</span>
                    <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round">
                        <path d="M18 6 6 18"></path>
                        <path d="m6 6 12 12"></path>
                    </svg>
                </button>
            </div>

            <!-- Modal Body -->
            <div class="p-4 overflow-y-auto">
                <form id="depositPaymentForm" method="POST" action="{{ route('deposit.store') }}">
                    @csrf

                    <div class="space-y-4">
                        <!-- Administrator Selection -->
                        <input type="hidden" name="administrator_id" value="{{ $deposit->administrator_id }}">

                        <!-- Fund Selection -->
                        <div>
                            <label for="fund_id"
                                class="block text-sm font-medium text-gray-700 dark:text-neutral-300 mb-2">
                                Dana <span class="text-red-500">*</span>
                            </label>
                            <select name="fund_id" id="fund_id" required
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-neutral-700 dark:border-neutral-600 dark:text-neutral-200">
                                <option value="">Pilih Dana</option>
                                @foreach($funds ?? [] as $fund)
                                    <option value="{{ $fund->id }}">{{ $fund->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Date -->
                        <div>
                            <label for="deposit_date"
                                class="block text-sm font-medium text-gray-700 dark:text-neutral-300 mb-2">
                                Tanggal <span class="text-red-500">*</span>
                            </label>
                            <input type="date" name="date" id="deposit_date" required
                                value="{{ old('date', date('Y-m-d')) }}"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-neutral-700 dark:border-neutral-600 dark:text-neutral-200">
                        </div>

                        <!-- Amount -->
                        <div>
                            <label for="deposit_amount"
                                class="block text-sm font-medium text-gray-700 dark:text-neutral-300 mb-2">
                                Jumlah Deposit <span class="text-red-500">*</span>
                            </label>
                            <div class="relative">
                                <span
                                    class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-500 text-sm">Rp</span>
                                <input type="number" name="amount" id="deposit_amount" min="1" required
                                    class="w-full pl-8 pr-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-neutral-700 dark:border-neutral-600 dark:text-neutral-200"
                                    placeholder="0">
                            </div>
                        </div>
                    </div>
                </form>
            </div>

            <!-- Modal Footer -->
            <div
                class="flex justify-end items-center gap-x-2 py-3 px-4 border-t border-gray-200 dark:border-neutral-700">
                <button type="button"
                    class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-2xs hover:bg-gray-50 focus:outline-hidden focus:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:text-white dark:hover:bg-neutral-700 dark:focus:bg-neutral-700"
                    data-hs-overlay="#deposit-payment-modal">
                    Batal
                </button>
                <button type="button" onclick="submitDepositPayment()"
                    class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 focus:outline-hidden focus:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 2v20M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6" />
                    </svg>
                    Bayar Deposit
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Edit Deposit Payment Modal -->
<div id="edit-deposit-payment-modal"
    class="hs-overlay hidden size-full fixed top-0 start-0 z-80 overflow-x-hidden overflow-y-auto pointer-events-none"
    role="dialog" tabindex="-1" aria-labelledby="edit-deposit-payment-modal-label">
    <div
        class="hs-overlay-open:mt-7 hs-overlay-open:opacity-100 hs-overlay-open:duration-500 mt-0 opacity-0 ease-out transition-all sm:max-w-lg sm:w-full m-3 sm:mx-auto min-h-[calc(100%-56px)] flex items-center">
        <div
            class="w-full flex flex-col bg-white border border-gray-200 shadow-2xs rounded-xl pointer-events-auto dark:bg-neutral-800 dark:border-neutral-700 dark:shadow-neutral-700/70">
            <!-- Modal Header -->
            <div class="flex justify-between items-center py-3 px-4 border-b border-gray-200 dark:border-neutral-700">
                <h3 id="edit-deposit-payment-modal-label" class="font-bold text-gray-800 dark:text-white">
                    Edit Pembayaran Deposit
                </h3>
                <button type="button"
                    class="size-8 inline-flex justify-center items-center gap-x-2 rounded-full border border-transparent bg-gray-100 text-gray-800 hover:bg-gray-200 focus:outline-hidden focus:bg-gray-200 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-700 dark:hover:bg-neutral-600 dark:text-neutral-400 dark:focus:bg-neutral-600"
                    aria-label="Close" data-hs-overlay="#edit-deposit-payment-modal">
                    <span class="sr-only">Close</span>
                    <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round">
                        <path d="M18 6 6 18"></path>
                        <path d="m6 6 12 12"></path>
                    </svg>
                </button>
            </div>

            <!-- Modal Body -->
            <div class="p-4 overflow-y-auto">
                <form id="editDepositPaymentForm" method="POST" action="">
                    @csrf
                    @method('PUT')

                    <div class="space-y-4">
                        <!-- Fund Display -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-neutral-300 mb-2">
                                Dana
                            </label>
                            <div class="px-3 py-2 bg-gray-50 border border-gray-200 rounded-lg dark:bg-neutral-700 dark:border-neutral-600">
                                <span id="edit_fund_name" class="text-sm text-gray-800 dark:text-neutral-200"></span>
                            </div>
                        </div>

                        <!-- Date -->
                        <div>
                            <label for="edit_deposit_date"
                                class="block text-sm font-medium text-gray-700 dark:text-neutral-300 mb-2">
                                Tanggal <span class="text-red-500">*</span>
                            </label>
                            <input type="date" name="date" id="edit_deposit_date" required
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-neutral-700 dark:border-neutral-600 dark:text-neutral-200">
                        </div>

                        <!-- Amount -->
                        <div>
                            <label for="edit_deposit_amount"
                                class="block text-sm font-medium text-gray-700 dark:text-neutral-300 mb-2">
                                Jumlah Deposit <span class="text-red-500">*</span>
                            </label>
                            <div class="relative">
                                <span
                                    class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-500 text-sm">Rp</span>
                                <input type="number" name="amount" id="edit_deposit_amount" min="1" required
                                    class="w-full pl-8 pr-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-neutral-700 dark:border-neutral-600 dark:text-neutral-200"
                                    placeholder="0">
                            </div>
                        </div>
                    </div>
                </form>
            </div>

            <!-- Modal Footer -->
            <div
                class="flex justify-end items-center gap-x-2 py-3 px-4 border-t border-gray-200 dark:border-neutral-700">
                <button type="button"
                    class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-2xs hover:bg-gray-50 focus:outline-hidden focus:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:text-white dark:hover:bg-neutral-700 dark:focus:bg-neutral-700"
                    data-hs-overlay="#edit-deposit-payment-modal">
                    Batal
                </button>
                <button type="button" onclick="updateDepositPayment()"
                    class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 focus:outline-hidden focus:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                    Update Deposit
                </button>
            </div>
        </div>
    </div>
</div>

<div id="penalty-deposit-modal"
    class="hs-overlay hidden size-full fixed top-0 start-0 z-80 overflow-x-hidden overflow-y-auto pointer-events-none"
    role="dialog" tabindex="-1" aria-labelledby="penalty-deposit-modal-label">
    <div
        class="hs-overlay-open:mt-7 hs-overlay-open:opacity-100 hs-overlay-open:duration-500 mt-0 opacity-0 ease-out transition-all sm:max-w-lg sm:w-full m-3 sm:mx-auto min-h-[calc(100%-56px)] flex items-center">
        <div
            class="w-full flex flex-col bg-white border border-gray-200 shadow-2xs rounded-xl pointer-events-auto dark:bg-neutral-800 dark:border-neutral-700 dark:shadow-neutral-700/70">
            <!-- Modal Header -->
            <div class="flex justify-between items-center py-3 px-4 border-b border-gray-200 dark:border-neutral-700">
                <h3 id="penalty-deposit-modal-label" class="font-bold text-gray-800 dark:text-white">
                    Tambah Denda Deposit
                </h3>
                <button type="button"
                    class="size-8 inline-flex justify-center items-center gap-x-2 rounded-full border border-transparent bg-gray-100 text-gray-800 hover:bg-gray-200 focus:outline-hidden focus:bg-gray-200 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-700 dark:hover:bg-neutral-600 dark:text-neutral-400 dark:focus:bg-neutral-600"
                    aria-label="Close" data-hs-overlay="#penalty-deposit-modal">
                    <span class="sr-only">Close</span>
                    <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round">
                        <path d="M18 6 6 18"></path>
                        <path d="m6 6 12 12"></path>
                    </svg>
                </button>
            </div>

            <!-- Modal Body -->
            <div class="p-4 overflow-y-auto">
                <form id="penaltyForm" method="POST" action="{{ route('deposit.penalty.store') }}">
                    @csrf

                    <div class="space-y-4">
                        <!-- Administrator Selection -->
                        <input type="hidden" name="administrator_id" value="{{ $deposit->administrator_id }}">

                        <!-- Fund Selection -->
                        <div>
                            <label for="penalty_type"
                                class="block text-sm font-medium text-gray-700 dark:text-neutral-300 mb-2">
                                Jenis denda <span class="text-red-500">*</span>
                            </label>
                            <select name="detail" id="penalty_type" required
                                class="w-full px-3 py-2 border @error('penalty') border-red-500 @else border-gray-300 @enderror rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-neutral-700 dark:border-neutral-600 dark:text-neutral-200">
                                <option value="">Pilih Jenis Denda</option>
                                <option value="plenary_meeting" {{ old('penalty') == 'plenary_meeting' ? 'selected' : '' }}>Terlambat atau Tidak mengikuti rapat pleno</option>
                                <option value="jacket_day" {{ old('penalty') == 'jacket_day' ? 'selected' : '' }}>Tidak
                                    menggunakan jahim ketika jahim day</option>
                                <option value="graduation_ceremony" {{ old('penalty') == 'graduation_ceremony' ? 'selected' : '' }}>Tidak mengikuti wisuda offline</option>
                                <option value="secretariat_maintenance" {{ old('penalty') == 'secretariat_maintenance' ? 'selected' : '' }}>Tidak mengikuti piket pesek</option>
                                <option value="work_program" {{ old('penalty') == 'work_program' ? 'selected' : '' }}>
                                    Tidak bertanggung jawab dalam menjalankan proker</option>
                                <option value="other" {{ old('penalty') == 'other' ? 'selected' : '' }}>Lainnya</option>
                            </select>
                            @error('penalty')
                                <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>


                        <!-- Date -->
                        <div>
                            <label for="penalty_date"
                                class="block text-sm font-medium text-gray-700 dark:text-neutral-300 mb-2">
                                Tanggal <span class="text-red-500">*</span>
                            </label>
                            <input type="date" name="date" id="penalty_date" required
                                value="{{ old('date', date('Y-m-d')) }}"
                                class="w-full px-3 py-2 border @error('date') border-red-500 @else border-gray-300 @enderror rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-neutral-700 dark:border-neutral-600 dark:text-neutral-200">
                            @error('date')
                                <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Cash Amount -->
                        <div>
                            <label for="penalty_amount"
                                class="block text-sm font-medium text-gray-700 dark:text-neutral-300 mb-2">
                                Jumlah Denda <span class="text-red-500">*</span>
                            </label>
                            <div class="relative">
                                <span
                                    class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-500 text-sm">Rp</span>
                                <input type="number" name="amount" id="penalty_amount" min="0"
                                    value="{{ old('amount', 0) }}" required
                                    class="w-full pl-8 pr-3 py-2 border @error('amount') border-red-500 @else border-gray-300 @enderror rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-neutral-700 dark:border-neutral-600 dark:text-neutral-200"
                                    placeholder="0">
                            </div>
                            @error('amount')
                                <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Hidden deposit_id field (will be populated via JavaScript) -->
                        <input type="hidden" name="deposit_id" id="penalty_deposit_id">
                    </div>
                </form>
            </div>

            <!-- Modal Footer -->
            <div
                class="flex justify-end items-center gap-x-2 py-3 px-4 border-t border-gray-200 dark:border-neutral-700">
                <button type="button"
                    class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-2xs hover:bg-gray-50 focus:outline-hidden focus:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:text-white dark:hover:bg-neutral-700 dark:focus:bg-neutral-700"
                    data-hs-overlay="#penalty-deposit-modal">
                    Batal
                </button>
                <button type="button" onclick="addPenalty()"
                    class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-red-600 text-white hover:bg-red-700 focus:outline-hidden focus:bg-red-700 disabled:opacity-50 disabled:pointer-events-none">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z" />
                    </svg>
                    Simpan Denda
                </button>
            </div>
        </div>
    </div>
</div>

{{-- Edit Penalty Modal --}}
<div id="penalty-edit-modal-update"
    class="hs-overlay hidden size-full fixed top-0 start-0 z-80 overflow-x-hidden overflow-y-auto pointer-events-none"
    role="dialog" tabindex="-1" aria-labelledby="penalty-edit-modal-update-label">
    <div
        class="hs-overlay-open:mt-7 hs-overlay-open:opacity-100 hs-overlay-open:duration-500 mt-0 opacity-0 ease-out transition-all sm:max-w-lg sm:w-full m-3 sm:mx-auto min-h-[calc(100%-56px)] flex items-center">
        <div
            class="w-full flex flex-col bg-white border border-gray-200 shadow-2xs rounded-xl pointer-events-auto dark:bg-neutral-800 dark:border-neutral-700 dark:shadow-neutral-700/70">
            <!-- Modal Header -->
            <div class="flex justify-between items-center py-3 px-4 border-b border-gray-200 dark:border-neutral-700">
                <h3 id="penalty-edit-modal-update-label" class="font-bold text-gray-800 dark:text-white">
                    Edit Denda Deposit
                </h3>
                <button type="button"
                    class="size-8 inline-flex justify-center items-center gap-x-2 rounded-full border border-transparent bg-gray-100 text-gray-800 hover:bg-gray-200 focus:outline-hidden focus:bg-gray-200 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-700 dark:hover:bg-neutral-600 dark:text-neutral-400 dark:focus:bg-neutral-600"
                    aria-label="Close" data-hs-overlay="#penalty-edit-modal-update">
                    <span class="sr-only">Close</span>
                    <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round">
                        <path d="M18 6 6 18"></path>
                        <path d="m6 6 12 12"></path>
                    </svg>
                </button>
            </div>

            <!-- Modal Body -->
            <div class="p-4 overflow-y-auto">
                <form id="penaltyEditForm" method="POST" action="">
                    @csrf
                    @method('PUT')

                    <div class="space-y-4">
                        <!-- Jenis Denda -->
                        <div>
                            <label for="edit_penalty_type"
                                class="block text-sm font-medium text-gray-700 dark:text-neutral-300 mb-2">
                                Jenis denda <span class="text-red-500">*</span>
                            </label>
                            <select name="detail" id="edit_penalty_type" required
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-neutral-700 dark:border-neutral-600 dark:text-neutral-200">
                                <option value="">Pilih Jenis Denda</option>
                                <option value="plenary_meeting">Terlambat atau Tidak mengikuti rapat pleno</option>
                                <option value="jacket_day">Tidak menggunakan jahim ketika jahim day</option>
                                <option value="graduation_ceremony">Tidak mengikuti wisuda offline</option>
                                <option value="secretariat_maintenance">Tidak mengikuti piket pesek</option>
                                <option value="work_program">Tidak bertanggung jawab dalam menjalankan proker</option>
                                <option value="other">Lainnya</option>
                            </select>
                            @error('detail')
                                <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Date -->
                        <div>
                            <label for="edit_penalty_date"
                                class="block text-sm font-medium text-gray-700 dark:text-neutral-300 mb-2">
                                Tanggal <span class="text-red-500">*</span>
                            </label>
                            <input type="date" name="date" id="edit_penalty_date" required
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-neutral-700 dark:border-neutral-600 dark:text-neutral-200">
                            @error('date')
                                <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Amount -->
                        <div>
                            <label for="edit_penalty_amount"
                                class="block text-sm font-medium text-gray-700 dark:text-neutral-300 mb-2">
                                Jumlah Denda <span class="text-red-500">*</span>
                            </label>
                            <div class="relative">
                                <span
                                    class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-500 text-sm">Rp</span>
                                <input type="number" name="amount" id="edit_penalty_amount" min="0" required
                                    class="w-full pl-8 pr-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-neutral-700 dark:border-neutral-600 dark:text-neutral-200"
                                    placeholder="0">
                            </div>
                            @error('amount')
                                <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </form>
            </div>

            <!-- Modal Footer -->
            <div
                class="flex justify-end items-center gap-x-2 py-3 px-4 border-t border-gray-200 dark:border-neutral-700">
                <button type="button"
                    class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-2xs hover:bg-gray-50 focus:outline-hidden focus:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:text-white dark:hover:bg-neutral-700 dark:focus:bg-neutral-700"
                    data-hs-overlay="#penalty-edit-modal-update">
                    Batal
                </button>
                <button type="button" onclick="updatePenalty()"
                    class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 focus:outline-hidden focus:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                    Update Denda
                </button>
            </div>
        </div>
    </div>
</div>

<script>
    function submitDepositPayment() {
        document.getElementById("depositPaymentForm").submit();
    }

    function editDepositPayment(depositId, fundId, date, amount, fundName) {
        // Set form action with route parameters
        const form = document.getElementById('editDepositPaymentForm');
        form.action = `/deposit/${depositId}/fund/${fundId}`;

        // Populate form fields
        document.getElementById('edit_fund_name').textContent = fundName;
        document.getElementById('edit_deposit_date').value = date;
        document.getElementById('edit_deposit_amount').value = amount;

        // Show modal
        HSOverlay.open('#edit-deposit-payment-modal');
    }

    function updateDepositPayment() {
        document.getElementById("editDepositPaymentForm").submit();
    }

    function addPenalty() {
        document.getElementById("penalty_deposit_id").value = {{ $deposit->id }};
        document.getElementById("penaltyForm").submit();
    }

    function editPenalty(depositId, penaltyId, detail, date, amount) {
        // Set form action with route parameters
        const form = document.getElementById('penaltyEditForm');
        form.action = `/deposit/${depositId}/penalty/${penaltyId}`;

        // Populate form fields
        document.getElementById('edit_penalty_type').value = detail;
        document.getElementById('edit_penalty_date').value = date;
        document.getElementById('edit_penalty_amount').value = amount;

        // Show modal
        HSOverlay.open('#penalty-edit-modal-update');
    }

    function updatePenalty() {
        document.getElementById("penaltyEditForm").submit();
    }
</script>

@endsection