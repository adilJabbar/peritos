<span
    x-data="{ open: true }"
    x-init=" setTimeout(() => { open = false }, 2500); "
    x-show.transition.out.duration.1000ms="open"
    class="text-red-500 text-xs italic"
>
    {{__('Hay errores en el formulario')}}
</span>
