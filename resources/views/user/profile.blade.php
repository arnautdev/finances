<x-dashboard-layout>

    <div class="card card-info card-outline">
        <div class="card-header">
            <h2 class="card-title">{{ __('Profile data') }}</h2>
        </div>
        <!-- End ./card-header -->

        <div class="card-body">
            {{ Form::open(['route' => ['profile.update', $data['user']->id], 'data-parsley-validate' => 'true']) }}
            @method('PUT')
            <div class="row">
                <div class="col-lg-7">
                    {{ $form->input([
                        'standartInput' => 'true',
                        'label' => 'Your names',
                        'model' => 'user',
                        'name' => 'name'
                    ]) }}
                </div>

                <div class="col-lg-7">
                    {{ $form->input([
                        'standartInput' => 'true',
                        'type' => 'email',
                        'label' => 'Your names',
                        'model' => 'user',
                        'name' => 'email'
                    ]) }}
                </div>
            </div>
            <!-- End ./row -->

            {{ Form::submit('Save changes', [
                'class'=> 'btn btn-sm btn-info'
                ]) }}

            {{ Form::close() }}
        </div>
        <!-- End ./body -->
    </div>
    <!-- End ./card -->


    <div class="card card-info card-outline">
        <div class="card-header">
            <h2 class="card-title">{{ __('Change password') }}</h2>
        </div>
        <!-- End ./card-header -->

        <div class="card-body">
            {{ Form::open(['route' => ['change-password.update', $data['user']->id], 'data-parsley-validate' => 'true', 'autofill' => 'false']) }}
            @method('PUT')
            <div class="row">
                <div class="col-lg-7">
                    {{ $form->input([
                        'standartInput' => 'true',
                        'label' => 'Current password',
                        'type' => 'password',
                        'name' => 'current_password',
                    ]) }}
                </div>
                <div class="col-lg-7">
                    {{ $form->input([
                        'standartInput' => 'true',
                        'label' => 'New password',
                        'type' => 'password',
                        'name' => 'password',
                        'model' => ''
                    ]) }}
                </div>
                <div class="col-lg-7">
                    {{ $form->input([
                        'standartInput' => 'true',
                        'label' => 'Password confirmation',
                        'type' => 'password',
                        'name' => 'password_confirmation',
                    ]) }}
                </div>
            </div>
            <!-- End ./row -->

            {{ Form::submit('Save changes', [
                'class'=> 'btn btn-sm btn-info'
                ]) }}

            {{ Form::close() }}
        </div>
        <!-- End ./body -->
    </div>
    <!-- End ./card -->

</x-dashboard-layout>
