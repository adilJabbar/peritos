<div
    wire:ignore
    x-data
    x-init="() => {
        {{isset($attributes['maxSize']) ? 'FilePond.registerPlugin(FilePondPluginFileValidateSize);' : '' }}
    {{isset($attributes['validation']) ? 'FilePond.registerPlugin(FilePondPluginFileValidateType);' : '' }}
    {{isset($attributes['image-preview']) ? 'FilePond.registerPlugin(FilePondPluginImagePreview);' : ''}}
        const Pond = FilePond.create($refs.input);
        Pond.setOptions({
            allowMultiple: {{ $attributes->has('multiple') ? 'true' : 'false' }},
            allowImagePreview: {{ $attributes->has('image-preview') ? 'true' : 'false' }},
            allowFileSizeValidation: {{ ($attributes->has('maxSize') || $attributes->has('maxHeight')) ? 'true' : 'false' }},
            imagePreviewMaxHeight: {{ $attributes->has('maxHeight') ? $attributes->get('maxHeight') : '256' }},
            maxFileSize: {{ $attributes->has('maxSize') ? ("'" .$attributes->get('maxSize') ."'" ): 'null' }},
            allowFileTypeValidation: {{ $attributes->has('validation') ? 'true' : 'false' }},
            acceptedFileTypes: {{ $attributes->has('validation') ? "[" .  $attributes->get('validation') . "]" : 'null' }},
{{--            acceptedFileTypes: {{ $attributes->has('validation') ? "'" . $attributes->get('validation') . "'" : 'null' }},--}}


        server: {
            process:(fieldName, file, metadata, load, error, progress, abort, transfer, options) => {
@this.upload('{{ $attributes->whereStartsWith('wire:model')->first() }}', file, load, error, progress)
                },
                revert: (filename, load) => {
                    @this.removeUpload('{{ $attributes->whereStartsWith('wire:model')->first() }}', filename, load)
                },
            }
        });
        this.addEventListener('pondReset', e => {
            Pond.removeFiles();
        });
    }"
>
    {{ $slot }}
    <input type="file" x-ref="input" />
</div>
