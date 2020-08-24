<!-- begin panel -->
<div class="panel panel-inverse">
    @if(isset($title))
        <div class="panel-heading">
            @if(is_array($title))
                <h4 class="panel-title">{!! __($title[0], $title[1]) !!}</h4>
            @else
                <h4 class="panel-title">{{ __($title) }}</h4>
            @endif
        </div>
    @endif
    <div class="panel-body">
