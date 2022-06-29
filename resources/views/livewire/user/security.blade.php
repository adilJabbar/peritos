<x-card.card class="divide-gray-200 divide-y">
    <x-card.header>
        <h3>{{__('Roles')}}</h3>
    </x-card.header>
    <x-table.table>
        <x-slot name="head"></x-slot>
        <x-slot name="body">
            @foreach($roles as $role)
                @if($role->name !== 'Super Admin' || ($role->name === 'Super Admin' && auth()->user()->hasRole('Super Admin')))
                    <x-table.row>
                        <x-table.cell>
                            <x-input.checkbox wire:model="roleList" value="{{ $role->id }}" size="6" :disabled="!auth()->user()->can('roles.update') || $role->level > auth()->user()->max_role "/>
                        </x-table.cell>
                        <x-table.cell>
                            <div class="min-w-0">
                                <p class="text-sm font-medium text-gray-900 truncate">{{ __($role->name) }}</p>
                                <p class="text-sm text-gray-500 truncate">{{ __($role->description) }}</p>
                                {{--                                        <a href="#" class="block focus:outline-none">--}}
                                {{--                                            <span class="absolute inset-0" aria-hidden="true"></span>--}}
                                {{--                                            <p class="text-sm font-medium text-gray-900 truncate">{{ __($role->name) }}</p>--}}
                                {{--                                            <p class="text-sm text-gray-500 truncate">{{ __($role->description) }}</p>--}}
                                {{--                                        </a>--}}
                            </div>
                        </x-table.cell>
                    </x-table.row>
                @endif
            @endforeach
        </x-slot>
    </x-table.table>
</x-card.card>
