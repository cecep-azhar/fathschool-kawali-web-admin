@component('mail::message')
# Admission Approved

Your admission has beed approved. Please use below credentials to login

Email: {{ $email }} <br>
Password: {{ $password }}

@component('mail::button', ['url' => route('login')])
Login Now
@endcomponent

{{ __('thanks') }},<br>
{{ config('app.name') }}
@endcomponent
