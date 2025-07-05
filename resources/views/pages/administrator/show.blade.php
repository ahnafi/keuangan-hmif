@extends('layouts.app')

@section('title', 'Detail Administrator')

@section('content')
<div class="max-w-6xl mx-auto px-4 py-10 sm:px-6 lg:px-8">
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Main Content -->
        <div class="lg:col-span-2">
            <div class="bg-white border border-gray-200 rounded-xl shadow-sm dark:bg-neutral-800 dark:border-neutral-700">
                <!-- Header -->
                <div class="px-6 py-4 border-b border-gray-200 dark:border-neutral-700">
                    <h2 class="text-xl font-semibold text-gray-800 dark:text-neutral-200">
                        Detail Administrator
                    </h2>
                </div>

                <!-- Content -->
                <div class="px-6 py-4">
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-neutral-300 mb-1">
                                ID
                            </label>
                            <p class="text-sm text-gray-900 dark:text-neutral-100 bg-gray-50 dark:bg-neutral-700 px-3 py-2 rounded-lg">
                                {{ $administrator->id }}
                            </p>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-neutral-300 mb-1">
                                Nama
                            </label>
                            <p class="text-sm text-gray-900 dark:text-neutral-100 bg-gray-50 dark:bg-neutral-700 px-3 py-2 rounded-lg">
                                {{ $administrator->name }}
                            </p>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-neutral-300 mb-1">
                                Divisi
                            </label>
                            <p class="text-sm text-gray-900 dark:text-neutral-100 bg-gray-50 dark:bg-neutral-700 px-3 py-2 rounded-lg">
                                {{ $administrator->division->name ?? 'N/A' }}
                            </p>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-neutral-300 mb-1">
                                Dibuat pada
                            </label>
                            <p class="text-sm text-gray-900 dark:text-neutral-100 bg-gray-50 dark:bg-neutral-700 px-3 py-2 rounded-lg">
                                {{ $administrator->created_at->format('d M Y, H:i') }}
                            </p>
                        </div>
                    </div>

                    <!-- Actions -->
                    <div class="flex gap-x-3 mt-6">
                        <a href="{{ route('administrator.edit', $administrator) }}" 
                           class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 focus:outline-none focus:bg-blue-700">
                            <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M17 3a2.85 2.83 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5Z"/>
                                <path d="m15 5 4 4"/>
                            </svg>
                            Edit
                        </a>
                        <a href="{{ route('administrator.index') }}" 
                           class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 focus:outline-none focus:bg-gray-50 dark:bg-transparent dark:border-neutral-700 dark:text-neutral-300 dark:hover:bg-neutral-800">
                            <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="m12 19-7-7 7-7"/>
                                <path d="M19 12H5"/>
                            </svg>
                            Kembali ke Daftar
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="space-y-6">
            <!-- Total Deposito -->
            <div class="bg-white border border-gray-200 rounded-xl shadow-sm p-4 dark:bg-neutral-800 dark:border-neutral-700">
                <div class="flex items-center">
                    <div class="shrink-0">
                        <div class="size-10 bg-blue-100 rounded-lg flex items-center justify-center dark:bg-blue-800/30">
                            <svg class="shrink-0 size-5 text-blue-600 dark:text-blue-400" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M12 1v6m0 0 4-4m-4 4L8 3"/>
                                <path d="M12 11v6m0 0 4-4m-4 4-4-4"/>
                                <path d="M12 19v4"/>
                            </svg>
                        </div>
                    </div>
                    <div class="ms-3">
                        <p class="text-sm text-gray-500 dark:text-neutral-400">Total Deposito</p>
                        <p class="text-xl font-semibold text-gray-800 dark:text-neutral-200">{{ $administrator->deposits->count() ?? 0 }}</p>
                    </div>
                </div>
            </div>

            <!-- Total Kas -->
            <div class="bg-white border border-gray-200 rounded-xl shadow-sm p-4 dark:bg-neutral-800 dark:border-neutral-700">
                <div class="flex items-center">
                    <div class="shrink-0">
                        <div class="size-10 bg-green-100 rounded-lg flex items-center justify-center dark:bg-green-800/30">
                            <svg class="shrink-0 size-5 text-green-600 dark:text-green-400" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <line x1="12" y1="1" x2="12" y2="23"/>
                                <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/>
                            </svg>
                        </div>
                    </div>
                    <div class="ms-3">
                        <p class="text-sm text-gray-500 dark:text-neutral-400">Total Kas</p>
                        <p class="text-xl font-semibold text-gray-800 dark:text-neutral-200">{{ $administrator->cashes->count() ?? 0 }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
