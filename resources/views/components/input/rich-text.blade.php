@props([
    'id',
    'error' => false,
    ])

<div>
    <div
        x-data="{ value: @entangle($attributes->wire('model')),
            setValue() {
                this.$refs.trix.editor.loadHTML(this.value);
            },
            setCursorAtEnd() {
                this.$refs.trix.editor.setSelectedRange(
                    (this.$refs.trix.editor.getDocument().toString().length) - 1
                );
            }
        };"
        x-init="
            setValue();
            $watch('value', () => setValue() );
        "
        x-on:trix-focus="setCursorAtEnd();"
        x-on:trix-blur="value = $event.target.value"
        wire:ignore
        class="mt-1"
        {{ $attributes->whereDoesntStartWith('wire:model') }}
    >
        <input id="{{$id}}x" type="hidden" x-bind:value="value">

        <trix-editor
            x-ref="trix"
            class="shadow-sm block w-full sm:text-sm  rounded-md {{ $error ? 'border-red-300 text-red-900 placeholder-red-300 focus:outline-none focus:ring-red-500 focus:border-red-500' : ' focus:ring-indigo-500 focus:border-indigo-500 border-gray-300 ' }} "
            input="{{$id}}x"
            id="{{$id}}"
        ></trix-editor>

    </div>
</div>

{{--@section('css-trix')--}}
{{--    <link rel="stylesheet" type="text/css" href="https://unpkg.com/trix@1.3.1/dist/trix.css">--}}
{{--@endsection--}}
{{--@section('trix')--}}
{{--    <script src="https://unpkg.com/trix@1.3.1/dist/trix.js"></script>--}}
{{--@endsection--}}
