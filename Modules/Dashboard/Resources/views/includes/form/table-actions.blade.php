{{ Form::open(['route' => $deleteAction]) }}
@method('DELETE')

@if($dashboard->can($editAction[0]))
    <a href="{{ route($editAction[0], $editAction[1]) }}" class="btn btn-xs btn-primary no-radius">
        <i class="fa fa-edit"></i>&nbsp;{{ __('Edit') }}
    </a>
@endif

@if($dashboard->can($deleteAction[0]))
    <button type="submit" class="btn btn-xs btn-danger no-radius">
        <i class="fa fa-trash"></i>&nbsp;{{ __('Delete') }}
    </button>
@endif
{{ Form::close() }}