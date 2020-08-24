@include('dashboard::includes.component.panel-start', [
    'title' => 'Page media'
])
<input type="hidden" name="pageMedia" value="yes"/>
<div class="form-group">
    <label for="fb-share-image">
        {{ __('Fb share image') }}
        <small class="text-secondary">{{ __('optional') }}</small>
    </label><br>
    <input type="file"
           name="fbShareImage"
           class="btn btn-sm btn-secondary"
    />
</div><!-- End ./form-group -->
@if($data['page']->getMedia('fbShareImage')->count() > 0)
    <div class="form-group row">
        <div class="col-lg-2">
            <img src="{{ $data['page']->getMedia('fbShareImage')->first()->getUrl('small') }}"
                 class="img-fluid"
            />
            <a href="{{ route('media.destroy', $data['page']->getMedia('fbShareImage')->first()->id) }}"
               class="btn btn-xs btn-danger btn-block no-radius">
                <i class="fa fa-trash"></i>&nbsp;
                {{ __('Delete') }}
            </a>
        </div><!-- End ./col-lg-2 -->
    </div><!-- End ./form-group -->
@endif


<div class="form-group">
    <label for="fb-share-image">
        {{ __('Page background, header and etc.') }}
        <small class="text-secondary">{{ __('optional') }}</small>
    </label><br>
    <input type="file"
           name="pageImage"
           class="btn btn-sm btn-secondary"
    />
</div><!-- End ./form-group -->
@if($data['page']->getMedia('pageImage')->count() > 0)
    <div class="form-group row">
        <div class="col-lg-2">
            <img src="{{ $data['page']->getMedia('pageImage')->first()->getUrl('small') }}"
                 class="img-fluid"
            />
            <a href="{{ route('media.destroy', $data['page']->getMedia('pageImage')->first()->id) }}"
               class="btn btn-xs btn-danger btn-block no-radius">
                <i class="fa fa-trash"></i>&nbsp;
                {{ __('Delete') }}
            </a>
        </div><!-- End ./col-lg-2 -->
    </div><!-- End ./form-group -->
@endif


<div class="form-group">
    <label for="fb-share-image">
        {{ __('Page gallery') }}
        <small class="text-secondary">{{ __('optional') }}</small>
    </label><br>
    <input type="file"
           name="pageGallery[]"
           class="btn btn-sm btn-secondary"
           multiple="multiple"
    />
</div><!-- End ./form-group -->
@if($data['page']->getMedia('pageGallery')->count() > 0)
    <div class="form-group row gallery-sortable" data-save-order="{{ route('media.save-order') }}">
        @foreach($data['page']->getMedia('pageGallery') as $media)
            <div class="col-lg-3 cursor-pointer" data-id="{{ $media->id }}">
                <img src="{{ $media->getUrl('small') }}"
                     class="img-fluid"
                />
                <a href="{{ route('media.destroy', $media->id) }}"
                   class="btn btn-xs btn-danger btn-block no-radius">
                    <i class="fa fa-trash"></i>&nbsp;
                    {{ __('Delete') }}
                </a>
            </div><!-- End ./col-lg-2 -->
        @endforeach
    </div><!-- End ./form-group -->
@endif

<hr>
{{ Form::submit(__('Save media'), ['class' => 'btn btn-sm btn-primary btn-block no-radius']) }}
@include('dashboard::includes.component.panel-end')
