@can('roles.update')
    {{-- Team and role--}}
    <x-card.card class="px-4 py-5 sm:p-6">
        <x-layout.two-column-card title="Permisos" info="Selecciona los roles de este usuario">

            <div class="mt-1 border border-gray-200 rounded-lg cursor-pointer">
                @forelse($roles as $role)
                    <div class="px-4 py-3 {{ $loop->first ? '' : 'border-t border-gray-200' }}" wire:click="toggleRolesList('{{ $role->id  }}')">

                        <div class="{{in_array($role->id, $rolesList) ? '' : 'opacity-50'}}">
                            <!-- Role Name -->
                            <div class="flex items-center">
                                <div class="text-sm text-gray-600 {{in_array($role->id, $rolesList) ? 'font-semibold' : ''}}">
                                    {{ __($role->name) }}
                                </div>
                                @if(in_array($role->id, $rolesList))
                                    <svg class="ml-2 h-5 w-5 text-green-400" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" stroke="currentColor" viewBox="0 0 24 24"><path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                @endif
                            </div>

                            <!-- Role Description -->
                            <div class="mt-2 text-xs text-gray-600">
                                {{__($role->description)}}.
                            </div>
                        </div>
                    </div>
                @empty
                    {{__('No hay ningún rol definido')}}
                @endforelse

            </div>
            @if ($errors->first('rolesList'))
                <div class="mt-1 text-red-500 text-xs italic">{{ $errors->first('rolesList') }}</div>
            @endif



        </x-layout.two-column-card>
    </x-card.card>
@endcan
