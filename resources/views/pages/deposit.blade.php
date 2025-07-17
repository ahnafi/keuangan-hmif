@extends('layouts.app')

@section('title', 'Manajemen Deposit')

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
                                    Manajemen Deposit
                                </h2>
                                <p class="text-sm text-gray-600 dark:text-neutral-400">
                                    Kelola deposit anggota, pembayaran dan denda.
                                </p>
                            </div>

                            <div>
                                <div class="inline-flex gap-x-2">
                                    @role("bendahara")
                                    <button
                                        class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 focus:outline-hidden focus:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none"
                                        data-hs-overlay="#add-depsoit-modal">
                                        <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24"
                                            height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M5 12h14" />
                                            <path d="M12 5v14" />
                                        </svg>
                                        Bayar Deposit
                                    </button>
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
                                    <a class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-300 bg-white text-gray-700 hover:bg-gray-50 focus:outline-hidden focus:bg-gray-50 dark:bg-neutral-800 dark:border-neutral-700 dark:text-neutral-300 dark:hover:bg-neutral-700"
                                        href="{{ route("deposit.history") }}">
                                        <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24"
                                            height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M3 3v5h5" />
                                            <path d="M3.05 13A9 9 0 1 0 6 5.3L3 8" />
                                        </svg>
                                        Riwayat Deposit
                                    </a>
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
                                                Anggota
                                            </span>
                                        </div>
                                    </th>

                                    <th scope="col" class="px-6 py-3 text-start">
                                        <div class="flex items-center gap-x-2">
                                            <span
                                                class="text-xs font-semibold uppercase text-gray-800 dark:text-neutral-200">
                                                Raplen
                                            </span>
                                        </div>
                                    </th>

                                    <th scope="col" class="px-6 py-3 text-start">
                                        <div class="flex items-center gap-x-2">
                                            <span
                                                class="text-xs font-semibold uppercase text-gray-800 dark:text-neutral-200">
                                                JahimDay
                                            </span>
                                        </div>
                                    </th>

                                    <th scope="col" class="px-6 py-3 text-start">
                                        <div class="flex items-center gap-x-2">
                                            <span
                                                class="text-xs font-semibold uppercase text-gray-800 dark:text-neutral-200">
                                                Wisuda
                                            </span>
                                        </div>
                                    </th>

                                    <th scope="col" class="px-6 py-3 text-start">
                                        <div class="flex items-center gap-x-2">
                                            <span
                                                class="text-xs font-semibold uppercase text-gray-800 dark:text-neutral-200">
                                                Pesek
                                            </span>
                                        </div>
                                    </th>

                                    <th scope="col" class="px-6 py-3 text-start">
                                        <div class="flex items-center gap-x-2">
                                            <span
                                                class="text-xs font-semibold uppercase text-gray-800 dark:text-neutral-200">
                                                Proker
                                            </span>
                                        </div>
                                    </th>

                                    <th scope="col" class="px-6 py-3 text-start">
                                        <div class="flex items-center gap-x-2">
                                            <span
                                                class="text-xs font-semibold uppercase text-gray-800 dark:text-neutral-200">
                                                Lainnya
                                            </span>
                                        </div>
                                    </th>

                                    <th scope="col" class="px-6 py-3 text-start">
                                        <div class="flex items-center gap-x-2">
                                            <span
                                                class="text-xs font-semibold uppercase text-gray-800 dark:text-neutral-200">
                                                Total
                                            </span>
                                        </div>
                                    </th>

                                    <th scope="col" class="px-6 py-3 text-start">
                                        <div class="flex items-center gap-x-2">
                                            <span
                                                class="text-xs font-semibold uppercase text-gray-800 dark:text-neutral-200">
                                                Deposit
                                            </span>
                                        </div>
                                    </th>

                                    @role("bendahara")
                                    <th scope="col" class="px-6 py-3 text-start">
                                        <div class="flex items-center gap-x-2">
                                            <span
                                                class="text-xs font-semibold uppercase text-gray-800 dark:text-neutral-200">
                                                Aksi
                                            </span>
                                        </div>
                                    </th>
                                    @endrole
                                </tr>
                            </thead>

                            <tbody class="divide-y divide-gray-200 dark:divide-neutral-700">
                                @foreach ($deposits as $deposit)
                                <tr class="hover:bg-gray-50 dark:hover:bg-neutral-700">
                                    <td class="size-px whitespace-nowrap">
                                        <div class="ps-6 py-3">
                                            <div class="flex items-center gap-x-3">
                                                <div class="grow">
                                                    <span class="block text-sm font-semibold text-gray-800 dark:text-neutral-200">{{ $deposit->administrator->name }}</span>
                                                    <span class="block text-sm text-gray-500 dark:text-neutral-500">{{ \Illuminate\Support\Str::limit($deposit->administrator->division->name, 20) }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="size-px whitespace-nowrap">
                                        <div class="px-6 py-3">
                                            <span class="text-sm text-gray-500 dark:text-neutral-500">Rp {{ number_format($deposit->plenary_meeting ?? 0, 0, ',', '.') }}</span>
                                        </div>
                                    </td>
                                    <td class="size-px whitespace-nowrap">
                                        <div class="px-6 py-3">
                                            <span class="text-sm text-gray-500 dark:text-neutral-500">Rp {{ number_format($deposit->jacket_day ?? 0, 0, ',', '.') }}</span>
                                        </div>
                                    </td>
                                    <td class="size-px whitespace-nowrap">
                                        <div class="px-6 py-3">
                                            <span class="text-sm text-gray-500 dark:text-neutral-500">Rp {{ number_format($deposit->graduation_ceremony ?? 0, 0, ',', '.') }}</span>                            
                                        </div>
                                    </td>
                                    <td class="size-px whitespace-nowrap">
                                        <div class="px-6 py-3">
                                            <span class="text-sm text-gray-500 dark:text-neutral-500">Rp {{ number_format($deposit->secretariat_maintenance ?? 0, 0, ',', '.') }}</span>
                                        </div>
                                    </td>
                                    <td class="size-px whitespace-nowrap">
                                        <div class="px-6 py-3">
                                            <span class="text-sm text-gray-500 dark:text-neutral-500">Rp {{ number_format($deposit->work_program ?? 0, 0, ',', '.') }}</span>
                                        </div>
                                    </td>
                                    <td class="size-px whitespace-nowrap">
                                        <div class="px-6 py-3">
                                            <span class="text-sm text-gray-500 dark:text-neutral-500">Rp {{ number_format($deposit->other ?? 0, 0, ',', '.') }}</span>
                                        </div>
                                    </td>
                                    <td class="size-px whitespace-nowrap">
                                        <div class="px-6 py-3">
                                            <span class="text-sm text-gray-500 dark:text-neutral-500">Rp {{ number_format($deposit->total_penalty_amount,0,',','.') }}</span>
                                        </div>
                                    </td>
                                    <td class="size-px whitespace-nowrap">
                                        <div class="px-6 py-3">
                                            <span class="text-sm text-gray-500 dark:text-neutral-500">Rp {{ number_format($deposit->total_amount - $deposit->total_penalty_amount ?? 0, 0, ',', '.') }}</span>
                                        </div>
                                    </td>
                                    @role("bendahara")
                                    <td class="size-px whitespace-nowrap">
                                        <div class="px-6 py-1.5">
                                            <div class="flex items-center gap-x-2">
                                                <a class="inline-flex items-center gap-x-1 text-sm text-blue-600 decoration-2 hover:underline focus:outline-hidden focus:underline font-medium dark:text-blue-500" href="{{ route('deposit.manage', $deposit) }}" title="Kelola Deposit">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                    </svg>
                                                    Kelola
                                                </a>
                                            </div>
                                        </div>
                                    </td>
                                    @endrole
                                </tr>
                                @endforeach

                                <!-- Total Row -->
                                <tr
                                    class="bg-gray-50 dark:bg-neutral-700 font-semibold border-t-2 border-gray-300 dark:border-neutral-600">
                                    <td class="size-px whitespace-nowrap">
                                        <div class="ps-6 py-3">
                                            <span class="text-sm font-bold text-gray-800 dark:text-neutral-200">
                                                Total
                                            </span>
                                        </div>
                                    </td>
                                    <td class="size-px whitespace-nowrap">
                                        <div class="px-6 py-3">
                                            <span class="text-sm font-bold text-gray-800 dark:text-neutral-200">
                                                Rp {{ number_format($deposits->sum('plenary_meeting') ?? 0, 0, ',', '.') }}
                                            </span>
                                        </div>
                                    </td>
                                    <td class="size-px whitespace-nowrap">
                                        <div class="px-6 py-3">
                                            <span class="text-sm font-bold text-gray-800 dark:text-neutral-200">
                                                Rp {{ number_format($deposits->sum('jacket_day') ?? 0, 0, ',', '.') }}
                                            </span>
                                        </div>
                                    </td>
                                    <td class="size-px whitespace-nowrap">
                                        <div class="px-6 py-3">
                                            <span class="text-sm font-bold text-gray-800 dark:text-neutral-200">
                                                Rp
                                                {{ number_format($deposits->sum('graduation_ceremony') ?? 0, 0, ',', '.') }}
                                            </span>
                                        </div>
                                    </td>
                                    <td class="size-px whitespace-nowrap">
                                        <div class="px-6 py-3">
                                            <span class="text-sm font-bold text-gray-800 dark:text-neutral-200">
                                                Rp
                                                {{ number_format($deposits->sum('secretariat_maintenance') ?? 0, 0, ',', '.') }}
                                            </span>
                                        </div>
                                    </td>
                                    <td class="size-px whitespace-nowrap">
                                        <div class="px-6 py-3">
                                            <span class="text-sm font-bold text-gray-800 dark:text-neutral-200">
                                                Rp {{ number_format($deposits->sum('work_program') ?? 0, 0, ',', '.') }}
                                            </span>
                                        </div>
                                    </td>
                                    <td class="size-px whitespace-nowrap">
                                        <div class="px-6 py-3">
                                            <span class="text-sm font-bold text-gray-800 dark:text-neutral-200">
                                                Rp {{ number_format($deposits->sum('other') ?? 0, 0, ',', '.') }}
                                            </span>
                                        </div>
                                    </td>
                                    <td class="size-px whitespace-nowrap">
                                        <div class="px-6 py-3">
                                        </div>
                                    </td>
                                    <td class="size-px whitespace-nowrap">
                                        <div class="px-6 py-3">
                                        </div>
                                    </td>
                                    <td class="size-px whitespace-nowrap">
                                        <div class="px-6 py-3">
                                        </div>
                                    </td>
                                </tr>

                                {{-- <!-- Grand Total Row -->
                                <tr
                                    class="bg-blue-50 dark:bg-blue-900/20 font-bold border-t border-blue-200 dark:border-blue-700">
                                    <td class="size-px whitespace-nowrap" colspan="8">
                                        <div class="ps-6 py-3">
                                            <span class="text-sm font-bold text-blue-800 dark:text-blue-200">
                                                Grand Total
                                            </span>
                                        </div>
                                    </td>
                                    <td class="size-px whitespace-nowrap">
                                        <div class="px-6 py-3">
                                            <span class="text-sm font-bold text-blue-800 dark:text-blue-200">
                                                Rp
                                                {{ number_format($deposits->sum('plenary_meeting') +
                                                $deposits->sum('jacket_day') + $deposits->sum('graduation_ceremony') +
                                                $deposits->sum('secretariat_maintenance') + $deposits->sum('work_program') +
                                                $deposits->sum('other'), 0, ',', '.') }}
                                            </span>
                                        </div>
                                    </td>
                                    @role("bendahara")
                                    <td class="size-px whitespace-nowrap">
                                        <div class="px-6 py-3">
                                        </div>
                                    </td>
                                    <td class="size-px whitespace-nowrap">
                                        <div class="px-6 py-3">
                                        </div>
                                    </td>
                                    <td class="size-px whitespace-nowrap">
                                        <div class="px-6 py-3">
                                        </div>
                                    </td>
                                    @endrole
                                </tr> --}}
                            </tbody>
                        </table>
                        <!-- End Table -->

                        <!-- Footer -->
                        {{-- <div
                            class="px-6 py-4 grid gap-3 md:flex md:justify-between md:items-center border-t border-gray-200 dark:border-neutral-700">
                            <div>
                                <p class="text-sm text-gray-600 dark:text-neutral-400">
                                    <span
                                        class="font-semibold text-gray-800 dark:text-neutral-200">{{ $deposits->count() }}</span>
                                    anggota
                                </p>
                            </div>
                        </div> --}}
                        <!-- End Footer -->
                    </div>
                </div>
            </div>
        </div>
        <!-- End Card -->
    </div>
    <!-- End Table Section -->

    <!-- Add Cash Modal using HS Overlay Template -->
    <div id="add-depsoit-modal"
        class="hs-overlay hidden size-full fixed top-0 start-0 z-80 overflow-x-hidden overflow-y-auto pointer-events-none"
        role="dialog" tabindex="-1" aria-labelledby="add-depsoit-modal-label">
        <div
            class="hs-overlay-open:mt-7 hs-overlay-open:opacity-100 hs-overlay-open:duration-500 mt-0 opacity-0 ease-out transition-all sm:max-w-lg sm:w-full m-3 sm:mx-auto min-h-[calc(100%-56px)] flex items-center">
            <div
                class="w-full flex flex-col bg-white border border-gray-200 shadow-2xs rounded-xl pointer-events-auto dark:bg-neutral-800 dark:border-neutral-700 dark:shadow-neutral-700/70">
                <!-- Modal Header -->
                <div class="flex justify-between items-center py-3 px-4 border-b border-gray-200 dark:border-neutral-700">
                    <h3 id="add-depsoit-modal-label" class="font-bold text-gray-800 dark:text-white">
                        Bayar Deposit
                    </h3>
                    <button type="button"
                        class="size-8 inline-flex justify-center items-center gap-x-2 rounded-full border border-transparent bg-gray-100 text-gray-800 hover:bg-gray-200 focus:outline-hidden focus:bg-gray-200 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-700 dark:hover:bg-neutral-600 dark:text-neutral-400 dark:focus:bg-neutral-600"
                        aria-label="Close" data-hs-overlay="#add-depsoit-modal">
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
                    <form id="addForm" method="POST" action="{{ route('deposit.store') }}">
                        @csrf

                        <div class="space-y-4">
                            <!-- Administrator Selection -->
                            <div>
                                <label for="administrator_id_label"
                                    class="block text-sm font-medium text-gray-700 dark:text-neutral-300 mb-2">
                                    Pengurus <span class="text-red-500">*</span>
                                </label>
                                <select name="administrator_id" id="administrator_id_label" required
                                    class="w-full px-3 py-2 border @error('administrator_id') border-red-500 @else border-gray-300 @enderror rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-neutral-700 dark:border-neutral-600 dark:text-neutral-200">
                                    <option value="">Pilih Pengurus</option>
                                    @foreach($administrators as $admin)
                                        <option value="{{ $admin->id }}" {{ old('administrator_id') == $admin->id ? 'selected' : '' }}>{{ $admin->name }}</option>
                                    @endforeach
                                </select>
                                @error('administrator_id')
                                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>
                            <!-- Fund Selection -->
                            <div>
                                <label for="add_fund_id"
                                    class="block text-sm font-medium text-gray-700 dark:text-neutral-300 mb-2">
                                    Dana <span class="text-red-500">*</span>
                                </label>
                                <select name="fund_id" id="add_fund_id" required
                                    class="w-full px-3 py-2 border @error('fund_id') border-red-500 @else border-gray-300 @enderror rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-neutral-700 dark:border-neutral-600 dark:text-neutral-200">
                                    <option value="">Pilih Dana</option>
                                    @foreach($funds as $fund)
                                        <option value="{{ $fund->id }}" {{ old('fund_id') == $fund->id ? 'selected' : '' }}>{{ $fund->name }}</option>
                                    @endforeach
                                </select>
                                @error('fund_id')
                                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Date -->
                            <div>
                                <label for="add_date"
                                    class="block text-sm font-medium text-gray-700 dark:text-neutral-300 mb-2">
                                    Tanggal <span class="text-red-500">*</span>
                                </label>
                                <input type="date" name="date" id="add_date" required value="{{ old('date', date('Y-m-d')) }}"
                                    class="w-full px-3 py-2 border @error('date') border-red-500 @else border-gray-300 @enderror rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-neutral-700 dark:border-neutral-600 dark:text-neutral-200">
                                @error('date')
                                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Cash Amount -->
                            <div>
                                <label for="add_deposit_amount"
                                    class="block text-sm font-medium text-gray-700 dark:text-neutral-300 mb-2">
                                    Jumlah Deposit <span class="text-red-500">*</span>
                                </label>
                                <div class="relative">
                                    <span
                                        class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-500 text-sm">Rp</span>
                                    <input type="number" name="amount" id="add_deposit_amount" min="0" value="{{ old('amount', 0) }}" required
                                        class="w-full pl-8 pr-3 py-2 border @error('amount') border-red-500 @else border-gray-300 @enderror rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-neutral-700 dark:border-neutral-600 dark:text-neutral-200"
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
                        data-hs-overlay="#add-depsoit-modal">
                        Batal
                    </button>
                    <button type="button" onclick="addDeposit()"
                        class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 focus:outline-hidden focus:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        Simpan Pembayaran
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
                            <div>
                                <label for="penalty_administrator_id"
                                    class="block text-sm font-medium text-gray-700 dark:text-neutral-300 mb-2">
                                    Pengurus <span class="text-red-500">*</span>
                                </label>
                                <select name="administrator_id" id="penalty_administrator_id" required
                                    class="w-full px-3 py-2 border @error('administrator_id') border-red-500 @else border-gray-300 @enderror rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-neutral-700 dark:border-neutral-600 dark:text-neutral-200">
                                    <option value="">Pilih Pengurus</option>
                                    @foreach($administrators as $admin)
                                        <option value="{{ $admin->id }}" {{ old('administrator_id') == $admin->id ? 'selected' : '' }}>{{ $admin->name }}</option>
                                    @endforeach
                                </select>
                                @error('administrator_id')
                                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>
                            <!-- Fund Selection -->
                            <div>
                                <label for="penalty_type"
                                    class="block text-sm font-medium text-gray-700 dark:text-neutral-300 mb-2">
                                    Jenis denda <span class="text-red-500">*</span>
                                </label>
                                <select name="detail" id="penalty_type" required
                                    class="w-full px-3 py-2 border @error('penalty') border-red-500 @else border-gray-300 @enderror rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-neutral-700 dark:border-neutral-600 dark:text-neutral-200">
                                    <option value="">Pilih Jenis Denda</option>
                                    <option value="plenary_meeting" {{ old('penalty') == 'plenary_meeting' ? 'selected' : '' }}>Terlambat atauTidak mengikuti rapat pleno</option>
                                    <option value="jacket_day" {{ old('penalty') == 'jacket_day' ? 'selected' : '' }}>Tidak menggunakan jahim ketika jahim day</option>
                                    <option value="graduation_ceremony" {{ old('penalty') == 'graduation_ceremony' ? 'selected' : '' }}>Tidak mengikuti wisuda offline</option>
                                    <option value="secretariat_maintenance" {{ old('penalty') == 'secretariat_maintenance' ? 'selected' : '' }}>Tidak mengikuti piket pesek</option>
                                    <option value="work_program" {{ old('penalty') == 'work_program' ? 'selected' : '' }}>Tidak bertanggung jawab dalam menjalankan proker</option>
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
                                <input type="date" name="date" id="penalty_date" required value="{{ old('date', date('Y-m-d')) }}"
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
                                    <input type="number" name="amount" id="penalty_amount" min="0" value="{{ old('amount', 0) }}" required
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
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z" />
                        </svg>
                        Simpan Denda
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        function addDeposit(){
            document.getElementById("addForm").submit()
        }

        function addPenalty(){
            document.getElementById("penaltyForm").submit()
        }
    </script>

@endsection