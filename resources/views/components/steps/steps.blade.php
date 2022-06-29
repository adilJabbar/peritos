
    <ol class="border border-gray-300 rounded-md divide-y divide-gray-300 md:flex md:divide-y-0">
        @foreach ($steps as $key => $value)
            <li class="relative md:flex-1 md:flex">

                @if($stepSelected == $key)
                    <x-steps.current number="{{ $key }}" title="{{ __($value) }}"/>
                @elseif(in_array($key, $completedSteps))
                    <x-steps.completed number="{{ $key }}" title="{{ __($value) }}"/>
                @else
                    <x-steps.upcoming number="{{ $key }}" title="{{ __($value) }}"/>
                @endif
                @if(!$loop->last)
                    <x-steps.arrow/>
                @endif
            </li>
        @endforeach
    </ol>
</nav>
