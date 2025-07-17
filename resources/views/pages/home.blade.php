@extends('layouts.app')

@section('title', 'Manajemen Kas')

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
          Manajemen Kas
          </h2>
          <p class="text-sm text-gray-600 dark:text-neutral-400">
          Tambah kas, edit dan lainya.
          </p>
        </div>
        <div>
          <div class="inline-flex gap-x-2">
          @role("bendahara")
          <a class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 focus:outline-hidden focus:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none"
            href="{{ route('cash.create') }}">
            <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
            stroke-linejoin="round">
            <path d="M5 12h14" />
            <path d="M12 5v14" />
            </svg>
            Bayar Kas
          </a>
          <a class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-300 bg-white text-gray-700 hover:bg-gray-50 focus:outline-hidden focus:bg-gray-50 dark:bg-neutral-800 dark:border-neutral-700 dark:text-neutral-300 dark:hover:bg-neutral-700"
            href="{{ route('cash.transaction.history') }}">
            <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
            stroke-linejoin="round">
            <circle cx="12" cy="12" r="10" />
            <polyline points="12,6 12,12 16,14" />
            </svg>
            Riwayat
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
            <span class="text-xs font-semibold uppercase text-gray-800 dark:text-neutral-200">
              Nama
            </span>
            </div>
          </th>
          <th scope="col" class="px-6 py-3 text-start">
            <div class="flex items-center gap-x-2">
            <span class="text-xs font-semibold uppercase text-gray-800 dark:text-neutral-200">
              April
            </span>
            </div>
          </th>
          <th scope="col" class="px-6 py-3 text-start">
            <div class="flex items-center gap-x-2">
            <span class="text-xs font-semibold uppercase text-gray-800 dark:text-neutral-200">
              Mei
            </span>
            </div>
          </th>
          <th scope="col" class="px-6 py-3 text-start">
            <div class="flex items-center gap-x-2">
            <span class="text-xs font-semibold uppercase text-gray-800 dark:text-neutral-200">
              Juni
            </span>
            </div>
          </th>
          <th scope="col" class="px-6 py-3 text-start">
            <div class="flex items-center gap-x-2">
            <span class="text-xs font-semibold uppercase text-gray-800 dark:text-neutral-200">
              Juli
            </span>
            </div>
          </th>
          <th scope="col" class="px-6 py-3 text-start">
            <div class="flex items-center gap-x-2">
            <span class="text-xs font-semibold uppercase text-gray-800 dark:text-neutral-200">
              Agustus
            </span>
            </div>
          </th>
          <th scope="col" class="px-6 py-3 text-start">
            <div class="flex items-center gap-x-2">
            <span class="text-xs font-semibold uppercase text-gray-800 dark:text-neutral-200">
              September
            </span>
            </div>
          </th>
          <th scope="col" class="px-6 py-3 text-start">
            <div class="flex items-center gap-x-2">
            <span class="text-xs font-semibold uppercase text-gray-800 dark:text-neutral-200">
              Oktober
            </span>
            </div>
          </th>
          <th scope="col" class="px-6 py-3 text-start">
            <div class="flex items-center gap-x-2">
            <span class="text-xs font-semibold uppercase text-gray-800 dark:text-neutral-200">
              November
            </span>
            </div>
          </th>
          @role("bendahara")
          <th scope="col" class="px-6 py-3 text-start">
            <span class="text-xs font-semibold uppercase text-gray-800 dark:text-neutral-200">
            Aksi
            </span>
          </th>
          @endrole
          </tr>
        </thead>
        <tbody class="divide-y divide-gray-200 dark:divide-neutral-700">
          @foreach ($cashs as $cash)
        <tr class="hover:bg-gray-50 dark:hover:bg-neutral-700">
        <td class="size-px whitespace-nowrap">
        <div class="ps-6 py-3">
        <div class="flex items-center gap-x-3">
          <div class="grow">
          <span class="block text-sm font-semibold text-gray-800 dark:text-neutral-200">
          {{ $cash->administrator->name }}
          </span>
          <span class="block text-sm text-gray-500 dark:text-neutral-500">
          {{ \Illuminate\Support\Str::limit($cash->administrator->division->name, 20) }}
          </span>
          </div>
        </div>
        </div>
        </td>
        <td class="size-px whitespace-nowrap">
        <div class="px-6 py-3">
        <span class="text-sm text-gray-500 dark:text-neutral-500">
          Rp {{ number_format($cash->april ?? 0, 0, ',', '.') }}
        </span>
        </div>
        </td>
        <td class="size-px whitespace-nowrap">
        <div class="px-6 py-3">
        <span class="text-sm text-gray-500 dark:text-neutral-500">
          Rp {{ number_format($cash->may ?? 0, 0, ',', '.') }}
        </span>
        </div>
        </td>
        <td class="size-px whitespace-nowrap">
        <div class="px-6 py-3">
        <span class="text-sm text-gray-500 dark:text-neutral-500">
          Rp {{ number_format($cash->june ?? 0, 0, ',', '.') }}
        </span>
        </div>
        </td>
        <td class="size-px whitespace-nowrap">
        <div class="px-6 py-3">
        <span class="text-sm text-gray-500 dark:text-neutral-500">
          Rp {{ number_format($cash->july ?? 0, 0, ',', '.') }}
        </span>
        </div>
        </td>
        <td class="size-px whitespace-nowrap">
        <div class="px-6 py-3">
        <span class="text-sm text-gray-500 dark:text-neutral-500">
          Rp {{ number_format($cash->august ?? 0, 0, ',', '.') }}
        </span>
        </div>
        </td>
        <td class="size-px whitespace-nowrap">
        <div class="px-6 py-3">
        <span class="text-sm text-gray-500 dark:text-neutral-500">
          Rp {{ number_format($cash->september ?? 0, 0, ',', '.') }}
        </span>
        </div>
        </td>
        <td class="size-px whitespace-nowrap">
        <div class="px-6 py-3">
        <span class="text-sm text-gray-500 dark:text-neutral-500">
          Rp {{ number_format($cash->october ?? 0, 0, ',', '.') }}
        </span>
        </div>
        </td>
        <td class="size-px whitespace-nowrap">
        <div class="px-6 py-3">
        <span class="text-sm text-gray-500 dark:text-neutral-500">
          Rp {{ number_format($cash->november ?? 0, 0, ',', '.') }}
        </span>
        </div>
        </td>
        @role("bendahara")
        <td class="size-px whitespace-nowrap">
        <div class="px-6 py-1.5">
        <div class="flex items-center gap-x-2">
          <a class="inline-flex items-center gap-x-1 text-sm text-blue-600 decoration-2 hover:underline focus:outline-hidden focus:underline font-medium dark:text-blue-500"
          href="{{ route('cash.history', $cash) }}" title="Edit kas">
          <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
          d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
          </svg>
          Edit
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
            <div class="flex items-center gap-x-3">
              <div class="grow">
              <span class="block text-sm font-bold text-gray-800 dark:text-neutral-200">
                TOTAL
              </span>
              <span class="block text-sm text-gray-600 dark:text-neutral-400">
                Semua Divisi
              </span>
              </div>
            </div>
            </div>
          </td>
          <td class="size-px whitespace-nowrap">
            <div class="px-6 py-3">
            <span class="text-sm font-bold text-gray-800 dark:text-neutral-200">
              Rp {{ number_format($totals['april'] ?? 0, 0, ',', '.') }}
            </span>
            </div>
          </td>
          <td class="size-px whitespace-nowrap">
            <div class="px-6 py-3">
            <span class="text-sm font-bold text-gray-800 dark:text-neutral-200">
              Rp {{ number_format($totals['may'] ?? 0, 0, ',', '.') }}
            </span>
            </div>
          </td>
          <td class="size-px whitespace-nowrap">
            <div class="px-6 py-3">
            <span class="text-sm font-bold text-gray-800 dark:text-neutral-200">
              Rp {{ number_format($totals['june'] ?? 0, 0, ',', '.') }}
            </span>
            </div>
          </td>
          <td class="size-px whitespace-nowrap">
            <div class="px-6 py-3">
            <span class="text-sm font-bold text-gray-800 dark:text-neutral-200">
              Rp {{ number_format($totals['july'] ?? 0, 0, ',', '.') }}
            </span>
            </div>
          </td>
          <td class="size-px whitespace-nowrap">
            <div class="px-6 py-3">
            <span class="text-sm font-bold text-gray-800 dark:text-neutral-200">
              Rp {{ number_format($totals['august'] ?? 0, 0, ',', '.') }}
            </span>
            </div>
          </td>
          <td class="size-px whitespace-nowrap">
            <div class="px-6 py-3">
            <span class="text-sm font-bold text-gray-800 dark:text-neutral-200">
              Rp {{ number_format($totals['september'] ?? 0, 0, ',', '.') }}
            </span>
            </div>
          </td>
          <td class="size-px whitespace-nowrap">
            <div class="px-6 py-3">
            <span class="text-sm font-bold text-gray-800 dark:text-neutral-200">
              Rp {{ number_format($totals['october'] ?? 0, 0, ',', '.') }}
            </span>
            </div>
          </td>
          <td class="size-px whitespace-nowrap">
            <div class="px-6 py-3">
            <span class="text-sm font-bold text-gray-800 dark:text-neutral-200">
              Rp {{ number_format($totals['november'] ?? 0, 0, ',', '.') }}
            </span>
            </div>
          </td>
          @role("bendahara")
          <td class="size-px whitespace-nowrap">
            <div class="px-6 py-1.5">
            <span class="text-xs text-gray-500 dark:text-neutral-400"></span>
            </div>
          </td>
          @endrole
          </tr>

          <!-- Grand Total Row -->
          <tr class="bg-blue-50 dark:bg-blue-900/20 font-bold border-t border-blue-200 dark:border-blue-700">
          <td class="size-px whitespace-nowrap" colspan="9">
            <div class="px-6 py-4">
            <div class="flex items-center justify-between">
              <span class="text-lg font-bold text-blue-800 dark:text-blue-200">
              TOTAL KESELURUHAN
              </span>
              <span class="text-lg font-bold text-blue-800 dark:text-blue-200">
              Rp {{ number_format($grandTotal ?? 0, 0, ',', '.') }}
              </span>
            </div>
            </div>
          </td>
          @role("bendahara")
          <td class="size-px whitespace-nowrap">
            <div class="px-6 py-1.5">
            <span class="text-xs text-gray-500 dark:text-neutral-400"></span>
            </div>
          </td>
          @endrole
          </tr>

          <tr>
          {{-- jumlah tiap bulan dan total semua nya --}}
          </tr>
        </tbody>
        </table>
        <!-- End Table -->

        <!-- Footer -->
        <div
        class="px-6 py-4 grid gap-3 md:flex md:justify-between md:items-center border-t border-gray-200 dark:border-neutral-700">
        <div>
          <p class="text-sm text-gray-600 dark:text-neutral-400">
          <span class="font-semibold text-gray-800 dark:text-neutral-200">{{ $cashs->count() }}</span>
          Pengurus
          • Total Kas: <span class="font-semibold text-blue-600 dark:text-blue-400">Rp
            {{ number_format($grandTotal ?? 0, 0, ',', '.') }}</span>
          </p>
        </div>
        </div>
        <!-- End Footer -->
      </div>
      </div>
    </div>
    </div>
    <!-- End Card -->
  </div>
  <!-- End Table Section -->
@endsection