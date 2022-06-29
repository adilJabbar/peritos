<div>

    <x-slot name="title">
        {{__('Prohibido')}}
    </x-slot>
    <x-slot name="background">
        {{asset('img/backgrounds/password.jpg')}}
    </x-slot>

    <p>{{__('Estás intentando acceder a información restringida a la que no tienes acceso.')}}</p>

    <div class="flex items-center justify-right">
        {{--        <div class="flex items-center">--}}
        {{--            <input id="remember_me" name="remember" type="checkbox" class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">--}}
        {{--            <label for="remember_me" class="ml-2 block text-sm text-gray-900">--}}
        {{--                {{__('Remember me')}}--}}
        {{--            </label>--}}
        {{--        </div>--}}

        <div class="text-sm ml-auto mt-4">
            <a href="{{ route('dashboard.index')  }}" class="font-medium text-indigo-600 hover:text-indigo-500">
                {{__('Dashboard')}}
            </a>
        </div>
    </div>
</div>
