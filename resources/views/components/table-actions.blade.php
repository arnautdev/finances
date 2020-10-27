<div>
    {{ Form::open(['route' => [$page->getAction('destroy'), $attributes->get('id')]]) }}
    @method('DELETE')
    <a href="{{ route($page->getAction('edit'), $attributes->get('id')) }}"
       class="btn btn-xs btn-info">
        <i class="fa fa-pencil-alt"></i>&nbsp;{{ __('Edit') }}
    </a>

    <button type="submit" class="btn btn-xs btn-danger">
        <i class="fa fa-trash"></i>&nbsp;{{ __('Delete') }}
    </button>
    {{ Form::close() }}
</div>
