@extends('layouts.app')

@section('title', 'Manajemen Divisi')

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
                                Manajemen Divisi
                            </h2>
                            <p class="text-sm text-gray-600 dark:text-neutral-400">
                                Kelola data divisi organisasi.
                            </p>
                        </div>

                        <div>
                            <div class="inline-flex gap-x-2">
                                <a class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 focus:outline-hidden focus:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none"
                                    href="{{ route('division.create') }}">
                                    <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24"
                                        height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M5 12h14" />
                                        <path d="M12 5v14" />
                                    </svg>
                                    Tambah Divisi
                                </a>
                            </div>
                        </div>
                    </div>
                    <!-- End Header -->

                    <!-- Alert Messages -->
                    @if(session('success'))
                        <div class="px-6 py-4">
                            <div class="bg-green-50 border border-green-200 text-green-800 rounded-lg p-4 dark:bg-green-800/10 dark:border-green-900 dark:text-green-500">
                                {{ session('success') }}
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
                                            ID
                                        </span>
                                    </div>
                                </th>

                                <th scope="col" class="px-6 py-3 text-start">
                                    <div class="flex items-center gap-x-2">
                                        <span
                                            class="text-xs font-semibold uppercase text-gray-800 dark:text-neutral-200">
                                            Nama Divisi
                                        </span>
                                    </div>
                                </th>

                                <th scope="col" class="px-6 py-3 text-start">
                                    <div class="flex items-center gap-x-2">
                                        <span
                                            class="text-xs font-semibold uppercase text-gray-800 dark:text-neutral-200">
                                            Dibuat
                                        </span>
                                    </div>
                                </th>

                                <th scope="col" class="px-6 py-3 text-end">Aksi</th>
                            </tr>
                        </thead>

                        <tbody class="divide-y divide-gray-200 dark:divide-neutral-700">
                            @forelse($divisions as $division)
                                <tr>
                                    <td class="size-px whitespace-nowrap">
                                        <div class="ps-6 py-3">
                                            <span class="text-sm text-gray-800 dark:text-neutral-200">{{ $division->id }}</span>
                                        </div>
                                    </td>
                                    <td class="h-px w-72 whitespace-nowrap">
                                        <div class="px-6 py-3">
                                            <span class="block text-sm font-semibold text-gray-800 dark:text-neutral-200">{{ $division->name }}</span>
                                        </div>
                                    </td>
                                    <td class="size-px whitespace-nowrap">
                                        <div class="px-6 py-3">
                                            <span class="text-sm text-gray-500 dark:text-neutral-500">{{ $division->created_at->format('d M Y, H:i') }}</span>
                                        </div>
                                    </td>
                                    <td class="size-px whitespace-nowrap">
                                        <div class="px-6 py-1.5 flex gap-x-2">
                                            <a class="inline-flex items-center gap-x-1 text-sm text-blue-600 decoration-2 hover:underline focus:outline-hidden focus:underline font-medium dark:text-blue-500"
                                                href="{{ route('division.show', $division) }}">
                                                Lihat
                                            </a>
                                            <a class="inline-flex items-center gap-x-1 text-sm text-green-600 decoration-2 hover:underline focus:outline-hidden focus:underline font-medium dark:text-green-500"
                                                href="{{ route('division.edit', $division) }}">
                                                Edit
                                            </a>
                                            <form method="POST" action="{{ route('division.destroy', $division) }}" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" 
                                                    onclick="return confirm('Apakah Anda yakin ingin menghapus divisi ini?')"
                                                    class="inline-flex items-center gap-x-1 text-sm text-red-600 decoration-2 hover:underline focus:outline-hidden focus:underline font-medium dark:text-red-500">
                                                    Hapus
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-6 py-12 text-center">
                                        <p class="text-gray-500 dark:text-neutral-500">Tidak ada divisi ditemukan.</p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    <!-- End Table -->

                    <!-- Footer -->
                    @if($divisions->hasPages())
                    <div
                        class="px-6 py-4 grid gap-3 md:flex md:justify-between md:items-center border-t border-gray-200 dark:border-neutral-700">
                        <div>
                            <p class="text-sm text-gray-600 dark:text-neutral-400">
                                <span class="font-semibold text-gray-800 dark:text-neutral-200">{{ $divisions->total() }}</span> hasil
                            </p>
                        </div>

                        <div>
                            {{ $divisions->links() }}
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
@endsection
