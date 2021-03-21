<div class="@if(!request()->routeIs('login.*') || !request()->routeIs('register.*')) content @endif no-padding">
    @if(session('success'))
        <div class="alert alert-success fade show m-b-10 no-radius no-margin">
            <span class="close cursor-pointer" data-dismiss="alert">×</span>
            {{ session('success') }}
        </div>
    @endif

    @if(session('warning'))
        <div class="alert alert-warning fade show m-b-10 no-radius no-margin">
            <span class="close cursor-pointer" data-dismiss="alert">×</span>
            {{ session('warning') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger fade show m-b-10 no-radius no-margin">
            <span class="close cursor-pointer" data-dismiss="alert">×</span>
            {{ session('error') }}
        </div>
    @endif

    @if(isset($errors) && count($errors) > 0)
        <div class="alert alert-danger fade show m-b-10 no-radius no-margin">
            <span class="close cursor-pointer" data-dismiss="alert">×</span>
            <p>{{ __('error-message') }}</p>
            <ul class="no-margin">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
</div>

