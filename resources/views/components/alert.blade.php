@if($type === 'success')
<div class="bg-teal-50 border border-teal-200 rounded-lg p-4 dark:bg-teal-800/10 dark:border-teal-900" role="alert">
    <div class="flex">
        <div class="shrink-0">
            <span class="inline-flex justify-center items-center size-8 rounded-full border-4 border-teal-100 bg-teal-200 text-teal-800 dark:border-teal-900 dark:bg-teal-800 dark:text-teal-400">
                <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <polyline points="20 6 9 17 4 12"></polyline>
                </svg>
            </span>
        </div>
        <div class="ms-3">
            <h3 class="text-gray-800 font-semibold dark:text-white">Berhasil!</h3>
            <p class="text-sm text-gray-700 dark:text-neutral-400">{{ $message }}</p>
        </div>
    </div>
</div>
@elseif($type === 'error')
<div class="bg-red-50 border border-red-200 rounded-lg p-4 dark:bg-red-800/10 dark:border-red-900" role="alert">
    <div class="flex">
        <div class="shrink-0">
            <span class="inline-flex justify-center items-center size-8 rounded-full border-4 border-red-100 bg-red-200 text-red-800 dark:border-red-900 dark:bg-red-800 dark:text-red-400">
                <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M18 6 6 18"/>
                    <path d="M6 6l12 12"/>
                </svg>
            </span>
        </div>
        <div class="ms-3">
            <h3 class="text-gray-800 font-semibold dark:text-white">Error!</h3>
            <p class="text-sm text-gray-700 dark:text-neutral-400">{{ $message }}</p>
        </div>
    </div>
</div>
@elseif($type === 'warning')
<div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4 dark:bg-yellow-800/10 dark:border-yellow-900" role="alert">
    <div class="flex">
        <div class="shrink-0">
            <span class="inline-flex justify-center items-center size-8 rounded-full border-4 border-yellow-100 bg-yellow-200 text-yellow-800 dark:border-yellow-900 dark:bg-yellow-800 dark:text-yellow-400">
                <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="m21 16-4 4-4-4"/>
                    <path d="M17 20V4"/>
                    <path d="m3 8 4-4 4 4"/>
                    <path d="M7 4v16"/>
                </svg>
            </span>
        </div>
        <div class="ms-3">
            <h3 class="text-gray-800 font-semibold dark:text-white">Peringatan!</h3>
            <p class="text-sm text-gray-700 dark:text-neutral-400">{{ $message }}</p>
        </div>
    </div>
</div>
@endif
