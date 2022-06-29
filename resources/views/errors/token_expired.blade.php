<div>

    <x-slot name="title">
        {{__('El enlace ha caducado')}}
    </x-slot>
    <x-slot name="background">
        {{asset('img/backgrounds/login.jpg')}}
    </x-slot>

    <p>{{__('El enlace que estás intentando utilizar ha caducado. Por favor contacta con nosotros para que te habilitemos un nuevo enlace.')}}</p>

    <div class="flex items-center justify-right">
{{--        <div class="flex items-center">--}}
{{--            <input id="remember_me" name="remember" type="checkbox" class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">--}}
{{--            <label for="remember_me" class="ml-2 block text-sm text-gray-900">--}}
{{--                {{__('Remember me')}}--}}
{{--            </label>--}}
{{--        </div>--}}

        <div class="text-sm ml-auto mt-4">
            <a href="{{ route('login') }}" class="font-medium text-indigo-600 hover:text-indigo-500">
                {{__('Home')}}
            </a>
        </div>
    </div>
</div>
