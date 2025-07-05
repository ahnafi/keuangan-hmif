@extends('layouts.app')

@section('title', 'Tambah Dana')

@section('content')
    <div class="max-w-2xl mx-auto px-4 py-10 sm:px-6 lg:px-8">
        <div class="bg-white border border-gray-200 rounded-xl shadow-2xs dark:bg-neutral-800 dark:border-neutral-700">
            <!-- Header -->
            <div class="px-6 py-4 border-b border-gray-200 dark:border-neutral-700">
                <h2 class="text-xl font-semibold text-gray-800 dark:text-neutral-200">
                    Tambah Dana Baru
                </h2>
                <p class="text-sm text-gray-600 dark:text-neutral-400">
                    Tambahkan dana baru ke sistem.
                </p>
            </div>

            <!-- Form -->
            <form method="POST" action="{{ route('fund.store') }}" class="p-6">
                @csrf
                
                <div class="mb-4">
                    <label for="name" class="block text-sm font-medium text-gray-700 dark:text-neutral-300 mb-2">
                        Nama Dana <span class="text-red-500">*</span>
                    </label>
                    <input type="text" 
                           id="name" 
                           name="name" 
                           value="{{ old('name') }}"
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-hidden focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-300"
                           placeholder="Masukkan nama dana"
                           required>
                    @error('name')
                        <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex gap-x-3">
                    <button type="submit" 
                            class="py-2 px-4 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 focus:outline-hidden focus:bg-blue-700">
                        Buat Dana
                    </button>
                    <a href="{{ route('fund.index') }}" 
                       class="py-2 px-4 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-2xs hover:bg-gray-50 focus:outline-hidden focus:bg-gray-50 dark:bg-transparent dark:border-neutral-700 dark:text-neutral-300 dark:hover:bg-neutral-800">
                        Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
@endsection
