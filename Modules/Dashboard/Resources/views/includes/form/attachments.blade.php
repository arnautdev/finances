<div class="form-group row">
    <label class="col-lg-3 col-form-label text-right">{{ __('YouTube URL') }}</label>
    <div class="col-lg-6">
        {!!  $form->input([
            'name' => 'youTubeVideo',
            'onlyInput' => true
        ]) !!}
    </div><!-- End ./col-lg-6 -->
</div><!-- End ./form-group -->

<div class="form-group row">
    <label for="choice-media" class="col-lg-3 col-form-label text-right">{{ __('Media') }}</label>
    <div class="col-lg-6">
        <input type="file"
               name="attachments[]"
               class="btn btn-sm btn-secondary"
               multiple="multiple"
        />
    </div><!-- End ./col-lg-6 -->
</div><!-- End ./form-group -->

@if(isset($model) && isset($data[$model]) && $data[$model]->getMedia('attachments')->count() > 0)
    <div class="form-group row">
        <label class="col-lg-3 col-form-label text-right">{{ __('Added files') }}</label>
        <div class="col-lg-6">
            <div class="row gallery-sortable" data-save-order="{{ route('media.save-order') }}">
                @foreach($data['product']->getMedia('attachments') as $media)
                    <div class="col-lg-3 cursor-pointer" data-id="{{ $media->id }}">
                        <img src="{{ $media->getUrl('sm') }}"
                             class="img-fluid"
                        />
                        <a href="{{ route('media.destroy', $media->id) }}"
                           class="btn btn-xs btn-danger btn-block no-radius">
                            <i class="fa fa-trash"></i>&nbsp;
                            {{ __('Delete') }}
                        </a>
                    </div><!-- End ./col-lg-2 -->
                @endforeach
            </div>
        </div>
    </div><!-- End ./form-group -->
@endif
