@php
    $destroyAction = $page->getAction('destroy');
    if(!is_null($attributes->get('destroyAction'))){
        $destroyAction = $attributes->get('destroyAction');
    }

    $editAction = $page->getAction('edit');
    if(!is_null($attributes->get('editAction'))){
        $editAction = $attributes->get('editAction');
    }
@endphp

<div>
    {{ Form::open(['route' => [$destroyAction, $attributes->get('id')]]) }}
    @method('DELETE')
    <a href="{{ route($editAction, $attributes->get('id')) }}"
       class="btn btn-xs btn-info">
        <i class="fa fa-pencil-alt"></i>&nbsp;{{ __('Edit') }}
    </a>

    <button type="submit" class="btn btn-xs btn-danger">
        <i class="fa fa-trash"></i>&nbsp;{{ __('Delete') }}
    </button>
    {{ Form::close() }}
</div>
