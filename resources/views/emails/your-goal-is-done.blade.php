@component('mail::message')
# Hello, {{ $user->name }}

Your goal {{ $goal->title }} Is done, Our congratulations.

Thanks,<br>
{{ config('app.name') }}
@endcomponent
