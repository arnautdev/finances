<div>
    <div class="form-group row">
        <label class="col-sm-3"></label>
        <div class="col-sm-9">
            <button type="submit" class="btn btn-sm btn-info">
                <i class="fa fa-save"></i>&nbsp;
                {{ __('Save item') }}
            </button>
            <a href="{{ $page->getCancelRoute() }}" class="btn btn-sm btn-default">
                <i class="fa fa-arrow-circle-left"></i>&nbsp;
                {{ __('Cancel') }}
            </a>
        </div><!-- End ./col-sm -->
    </div><!-- End ./form-group -->
</div>
