@props(['notification'])

<span
    x-data="{ open: false }"
    x-init="
        @this.on('{{ $notification }}', () => {
             open = true;
             setTimeout(() => { open = false }, 2500);
        });
    "
    x-show.transition.out.duration.1000ms="open"
    style="display:none;"
    class="text-gray-500"
>
    {{ $slot }}
</span>
