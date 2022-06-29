<x-table.row wire:key="row-select-all-messages" class="bg-gray-200">
    <x-table.cell colspan="{{ $colspan ?? 8 }}">
        @if($selectPage)
            @unless($selectAll)
                <div>
                    {!! __('user_trans.Have selected rows', [
                     'number' => count($selected),
                     'row' => trans_choice('user_trans.row|rows', count($selected))
                     ]) !!}.
                    @if($total > count($selected))
                        {!! __('user_trans.Do you want to select all?', ['total' =>$total]) !!}
                        <x-button.link wire:click="selectAll" class="ml-2 text-indigo-500">Seleccionar todos</x-button.link>
                    @endif
                </div>
            @else
                <div>
                    {!! trans_choice(
                        'user_trans.Have selected all rows',
                        $total,
                        ['number' => $total]
                    ) !!}
                </div>
            @endunless
        @else
            <div>
                {!! __('user_trans.Have selected rows', [
                    'number' => count($selected),
                    'row' => trans_choice('user_trans.row|rows', count($selected))
                    ]) !!}
            </div>
        @endif
    </x-table.cell>
</x-table.row>
