@component('mail::message')

    Hello, {{ $user->name }}

    # You have {{ $expenses->count() }} expenses.
    And those expenses was added to current month.

    @foreach($expenses as $expense)
        {{ $expense->title }} {!! $expense->intToFloat($expense->amount) !!}
    @endforeach

    Thanks,<br>
    {{ config('app.name') }}
@endcomponent
