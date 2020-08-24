@component('mail::message')
    # Здравей,

    Бяхте поканени за регистрация в {{ config('app.name') }}, от

    {!! dump($order) !!}
    Поздрави,<br>
    Екип на {{ config('app.name') }}
@endcomponent
