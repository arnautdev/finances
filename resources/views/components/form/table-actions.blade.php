<div class="btn-group">
    {{ Form::open(['route' => [$data['destroyRoute'], $data['id']]]) }}
    @method('DELETE')

    @if($sidebar->can($data['editRoute']))
        <a href="{{ route($data['editRoute'], $data['id']) }}" class="btn btn-xs btn-primary">
            <i class="fa fa-edit"></i>&nbsp;
            {{ __('Edit') }}
        </a>
    @endif

    @if($sidebar->can($data['destroyRoute']))
        <button type="submit" class="btn btn-xs btn-danger">
            <i class="fa fa-trash"></i>&nbsp;
            {{ __('Delete') }}
        </button>
    @endif
    {{ Form::close() }}

</div>
<!-- End ./btn-group -->
