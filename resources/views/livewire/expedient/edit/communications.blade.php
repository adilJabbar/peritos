<div class="space-y-4">
    <x-card.card>
        <livewire:expedient.header :expedient="$expedient" :title="'Comunicaciones'" />
    </x-card.card>

    <x-card.card>
        <x-card.body>
            <x-button.primary wire:click="startNewCall">{{__('Start a call')}}</x-button.primary>
            <livewire:communication.video-panel />

        </x-card.body>
    </x-card.card>

{{--    @if($roomName)--}}
{{--        <div class="mt-1 sm:mt-0 sm:col-span-2">--}}
{{--            <div class="flex w-full shadow-sm">--}}
{{--                <div class="w-full relative">--}}
{{--                    <label for="cia"></label>--}}
{{--                    <div class="flex">--}}
{{--                        <input class="flex-1 block w-full mr-1 px-3 py-2 sm:text-sm border-gray-300 rounded-md border-gray-300 focus:ring-indigo-500 focus:border-indigo-500 bg-gray-200" value="{{ route("communications.join_room",[$roomName]) }}" id="cia" type="text" readonly="">--}}
{{--                        <x-button.primary wire:click="joinRoom">Join</x-button.primary>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    @endif--}}

</div>

