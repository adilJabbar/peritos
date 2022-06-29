<div class="fixed inset-0 flex items-end justify-center px-4 py-6 pointer-events-none sm:p-6 sm:items-start sm:justify-end z-50">
    <div x-data="{ show: false, title: '', message: '', result: '' }"
         x-on:notify.window="show = true; title = $event.detail.title; message = $event.detail.message; result = $event.detail.result; setTimeout(() => {show = false}, 2500)"
         x-show="show"
         x-transition:enter="transform ease-out duration-300 transition"
         x-transition:enter-start="translate-y-2 opacity-0 sm:translate-y-0 sm:translate-x-2"
         x-transition:enter-end="translate-y-0 opacity-100 sm:translate-x-0"
         x-transition:leave="transition ease-in duration-100"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         class="max-w-sm w-full bg-white shadow-lg rounded-lg pointer-events-auto ring-1 ring-black ring-opacity-5 overflow-hidden">
        <div class="p-4">
            <div class="flex items-start">
                <div class="flex-shrink-0">
                    <div x-show="result == 'success'">
                        <x-icon.check-circle class="text-green-400" />
                    </div>
                    <div x-show="result == 'error'">
                        <x-icon.exclamation class="text-red-500" />
                    </div>
                    <div x-show="result == 'sync'">
                        <x-icon.refresh class="text-gray-700" />
                    </div>
                    <div x-show="result == 'warning'">
                        <x-icon.exclamation class="text-yellow-500" />
                    </div>
                </div>
                <div class="ml-3 w-0 flex-1 pt-0.5">
                    <p x-text="title" class="text-sm font-medium text-gray-900"></p>
                    <p x-text="message" class="mt-1 text-sm text-gray-500"></p>
                </div>
                <div class="ml-4 flex-shrink-0 flex">
                    <button @click="show = false" class="bg-white rounded-md inline-flex text-gray-400 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        <span class="sr-only">{{__('Close')}}</span>
                        <svg class="h-5 w-5" x-description="Heroicon name: x" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
