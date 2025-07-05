@extends('layouts.app')

@section('title', 'Tambah Divisi')

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
            <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Tambah Divisi Baru</h1>
            <p class="text-sm text-gray-600 dark:text-gray-400">Tambahkan divisi baru ke dalam sistem</p>
        </div>
    </div>

    <!-- Form Card -->
    <div class="bg-white border border-gray-200 rounded-lg shadow-sm dark:bg-neutral-800 dark:border-neutral-700">
        <!-- Card Header -->
        <div class="px-6 py-4 border-b border-gray-200 dark:border-neutral-700">
            <h2 class="text-lg font-semibold text-gray-800 dark:text-neutral-200">
                Informasi Divisi
            </h2>
            <p class="text-sm text-gray-600 dark:text-neutral-400">
                Masukkan detail divisi yang akan ditambahkan
            </p>
        </div>

        <!-- Card Body -->
        <div class="p-6">
            <form action="{{ route('division.store') }}" method="POST">
                @csrf
                
                <!-- Name Field -->
                <div class="mb-6">
                    <label for="name" class="block text-sm font-medium mb-2 dark:text-white">
                        Nama Divisi <span class="text-red-500">*</span>
                    </label>
                    <input type="text" 
                           id="name" 
                           name="name" 
                           value="{{ old('name') }}"
                           class="py-3 px-4 block w-full rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600 {{ $errors->has('name') ? 'border-red-500' : 'border-gray-200' }}" 
                           placeholder="Masukkan nama divisi"
                           required>
                    @error('name')
                    <p class="text-sm text-red-600 mt-2">{{ $message }}</p>
                    @enderror
                    <p class="text-sm text-gray-600 mt-2">Contoh: Divisi Humas, Divisi IT, Divisi Acara</p>
                </div>

                <!-- Form Actions -->
                <div class="flex gap-x-2">
                    <button type="submit" 
                            class="py-3 px-4 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 focus:outline-none focus:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none">
                        <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/>
                            <polyline points="17 21 17 13 7 13 7 21"/>
                            <polyline points="7 3 7 8 15 8"/>
                        </svg>
                        Simpan Divisi
                    </button>
                    <a href="{{ route('division.index') }}" 
                       class="py-3 px-4 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 focus:outline-none focus:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:text-white dark:hover:bg-neutral-700 dark:focus:bg-neutral-700">
                        <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M18 6 6 18"/>
                            <path d="M6 6l12 12"/>
                        </svg>
                        Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
