@component('mail::message')
# Здравей, {{ $invitation->name }}

Бяхте поканени за регистрация в {{ config('app.name') }}, от {{ $invitation->user()->fullname() }}

@component('mail::button', ['url' => url('/user/register/?acceptInvitationId='.$invitation->id)])
Продължи
@endcomponent

Поздрави,<br>
Екип на {{ config('app.name') }}
@endcomponent
