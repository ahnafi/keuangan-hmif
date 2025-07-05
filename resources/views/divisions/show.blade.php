@extends('layouts.app')

@section('title', 'Detail Divisi')

@section('content')
<div class="max-w-4xl mx-auto">
    <!-- Page Header -->
    <div class="mb-8">
        <div class="flex items-center gap-x-3">
            <a href="{{ route('division.index') }}" 
               class="flex items-center gap-x-2 text-sm text-gray-600 decoration-2 hover:underline focus:outline-none focus:underline dark:text-neutral-400">
                <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="m15 18-6-6 6-6"/>
                </svg>
                Kembali ke Daftar Divisi
            </a>
        </div>
        <div class="mt-2">
            <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Detail Divisi</h1>
            <p class="text-sm text-gray-600 dark:text-gray-400">Informasi lengkap divisi</p>
        </div>
    </div>

    <!-- Detail Card -->
    <div class="bg-white border border-gray-200 rounded-lg shadow-sm dark:bg-neutral-800 dark:border-neutral-700">
        <!-- Card Header -->
        <div class="px-6 py-4 border-b border-gray-200 dark:border-neutral-700">
            <div class="flex justify-between items-center">
                <div>
                    <h2 class="text-lg font-semibold text-gray-800 dark:text-neutral-200">
                        {{ $division->name }}
                    </h2>
                    <p class="text-sm text-gray-600 dark:text-neutral-400">
                        Dibuat pada {{ $division->created_at->format('d F Y') }}
                    </p>
                </div>
                <div class="flex gap-x-2">
                    <a href="{{ route('division.edit', $division) }}" 
                       class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 focus:outline-none focus:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:text-white dark:hover:bg-neutral-700 dark:focus:bg-neutral-700">
                        <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/>
                            <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/>
                        </svg>
                        Edit
                    </a>
                    <form action="{{ route('division.destroy', $division) }}" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus divisi ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" 
                                class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-red-600 text-white hover:bg-red-700 focus:outline-none focus:bg-red-700 disabled:opacity-50 disabled:pointer-events-none">
                            <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M3 6h18"/>
                                <path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"/>
                                <path d="M8 6V4c0-1 1-2 2-2h4c-1 0 2 1 2 2v2"/>
                            </svg>
                            Hapus
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Card Body -->
        <div class="p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Basic Information -->
                <div>
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-neutral-200 mb-4">
                        Informasi Dasar
                    </h3>
                    <dl class="space-y-3">
                        <div>
                            <dt class="text-sm font-medium text-gray-500 dark:text-neutral-400">Nama Divisi</dt>
                            <dd class="text-sm text-gray-900 dark:text-neutral-200">{{ $division->name }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500 dark:text-neutral-400">Dibuat pada</dt>
                            <dd class="text-sm text-gray-900 dark:text-neutral-200">{{ $division->created_at->format('d F Y H:i') }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500 dark:text-neutral-400">Terakhir diperbarui</dt>
                            <dd class="text-sm text-gray-900 dark:text-neutral-200">{{ $division->updated_at->format('d F Y H:i') }}</dd>
                        </div>
                    </dl>
                </div>

                <!-- Statistics -->
                <div>
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-neutral-200 mb-4">
                        Statistik
                    </h3>
                    <dl class="space-y-3">
                        <div>
                            <dt class="text-sm font-medium text-gray-500 dark:text-neutral-400">Jumlah Pengurus</dt>
                            <dd class="text-sm text-gray-900 dark:text-neutral-200">
                                <span class="inline-flex items-center gap-x-1.5 py-1.5 px-3 rounded-full text-xs font-medium bg-blue-100 text-blue-800 dark:bg-blue-800/30 dark:text-blue-500">
                                    {{ $division->administrators->count() }} orang
                                </span>
                            </dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500 dark:text-neutral-400">Akses Kas Divisi</dt>
                            <dd class="text-sm text-gray-900 dark:text-neutral-200">
                                <span class="inline-flex items-center gap-x-1.5 py-1.5 px-3 rounded-full text-xs font-medium bg-green-100 text-green-800 dark:bg-green-800/30 dark:text-green-500">
                                    {{ $division->divisionCashAccesses->count() }} akses
                                </span>
                            </dd>
                        </div>
                    </dl>
                </div>
            </div>
        </div>
    </div>

    <!-- Related Data -->
    @if($division->administrators->count() > 0)
    <div class="mt-8 bg-white border border-gray-200 rounded-lg shadow-sm dark:bg-neutral-800 dark:border-neutral-700">
        <div class="px-6 py-4 border-b border-gray-200 dark:border-neutral-700">
            <h3 class="text-lg font-semibold text-gray-800 dark:text-neutral-200">
                Pengurus Divisi
            </h3>
        </div>
        <div class="p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                @foreach($division->administrators as $administrator)
                <div class="p-4 border border-gray-200 rounded-lg dark:border-neutral-700">
                    <div class="flex items-center gap-x-3">
                        <div class="shrink-0">
                            <span class="inline-flex items-center justify-center size-10 rounded-full bg-gray-100 text-gray-800 dark:bg-neutral-700 dark:text-neutral-200">
                                {{ substr($administrator->name, 0, 1) }}
                            </span>
                        </div>
                        <div class="grow">
                            <h4 class="text-sm font-semibold text-gray-800 dark:text-neutral-200">
                                {{ $administrator->name }}
                            </h4>
                            <p class="text-xs text-gray-500 dark:text-neutral-400">
                                Pengurus {{ $division->name }}
                            </p>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    @endif
</div>
@endsection
