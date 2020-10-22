<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Expenses settings') }}
        </h2>
    </x-slot>


    <div class="container">

        {{ Form::open(['route' => 'expenses.store']) }}

        

        {{ Form::close() }}
    </div><!-- End ./container -->

</x-app-layout>
