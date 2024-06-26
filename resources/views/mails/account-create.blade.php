@component('mail::message')
# Your account has been created successfully

Please use below credentials to login

## Email
{{ $email }}

## Password
{{ $password }}


@component('mail::button', ['url' => route('login')])
Login Now
@endcomponent

{{ __('thanks') }},<br>
{{ config('app.name') }}
@endcomponent
