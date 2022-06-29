@component('mail::message')
<p>{{__('mailing.welcome', ['name' => $user->name])}}</p>
<p>{{__('mailing.new user intro')}} <a target="_blank" href="{{env('APP_URL')}}/login">{{env('APP_NAME')}}</a>:</p>

<ul>
    <li>{{__('User')}}: <h3>{{ $user->email }}</h3></li>
    <li>{{__('Password')}}: <h3>{{ $password }}</h3></li>
</ul>

<p>{{__('mailing.any doubt')}}</p>
<p>{{__('Gracias')}},<br>
{{ config('app.name') }}</p>
@endcomponent
