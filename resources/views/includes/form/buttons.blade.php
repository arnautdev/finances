@if($settings['action'] == 'index')
    <div class="form-group">
        <a href="{{ route("{$settings['uri']}.create") }}" class="btn btn-sm btn-primary no-radius">
            <i class="fa fa-plus"></i>&nbsp;
            {{ __('add-new-item') }}
        </a>
    </div><!-- End ./form-group -->
@elseif(in_array($settings['action'], ['create', 'edit']))
    <div class="form-group row">
        <label class="col-md-3 col-form-label text-right"></label>
        <div class="col-lg-6">
            <button type="submit" class="btn btn-sm btn-primary no-radius">
                <i class="fa fa-save"></i>&nbsp;
                {{ __('save-item') }}
            </button>
            <a href="{{ route("{$settings['uri']}.index") }}" class="btn btn-sm btn-default no-radius">
                <i class="fa fa-arrow-left"></i>&nbsp;
                {{ __('back-to-all') }}
            </a>
        </div>
    </div><!-- End ./form-group -->
@endif