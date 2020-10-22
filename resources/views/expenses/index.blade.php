<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Expenses settings') }}
        </h2>
    </x-slot>


    <div class="container">

        {{ Form::open(['route' => 'expenses.store']) }}

        <div class="form-group">
            <label for="">{{ __('Expense title') }}</label>
            <input type="text" class="form-control"/>
        </div>

        {{ Form::close() }}
    </div><!-- End ./container -->

</x-app-layout>
