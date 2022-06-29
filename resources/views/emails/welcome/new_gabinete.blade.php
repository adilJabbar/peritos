@component('mail::message')
<p>{{__('mailing.welcome', ['name' => $gabinete->name])}}</p>
<p>{{__('mailing.new gabinete intro')}}</p>

@component('mail::button', ['url' => route('register.newUser', ['token' => $gabinete->create_main_user_token])])
    {{__('Create User')}}
@endcomponent

<p>{{__('mailing.link 30 minutos')}}</p>

<p>{{__('mailing.any doubt')}}</p>
<p>{{__('mailing.welcome to the app')}}</p>
<p>{{__('Gracias')}},<br>
{{ config('app.name') }}</p>
@component('mail::subcopy')
<p>{{__('mailing.problems create user button')}} <span class="break-all"><a href="{{ route('register.newUser', ['token' => $gabinete->create_main_user_token]) }}">{{ route('register.newUser', ['token' => $gabinete->create_main_user_token]) }}</a></span></p>
@endcomponent
@endcomponent
