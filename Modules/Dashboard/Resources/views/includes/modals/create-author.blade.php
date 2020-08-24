<div class="modal fade" id="{{ $modalName }}">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">{{ __('Create brand') }}</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            {{ Form::open(['route' => ['brands.store', 'referer' => 1], 'data-parsley-validate' => 'true','enctype' => 'multipart/form-data']) }}
            <input type="hidden" name="isActive" value="yes"/>

            <div class="modal-body">
                <div class="form-group">
                    <label for="title">{{ __('Title') }}</label>
                    {!! $form->input([
                        'name' => 'title',
                        'onlyInput' => true,
                        'attrs' => [
                            'required' => 'required',
                            'data-parsley-minlength' => 3,
                            'data-parsley-maxlength' => 100
                        ]
                    ]) !!}
                </div>

                <div class="form-group">
                    <label for="attachments">{{ __('Brand image') }}</label>
                    <input type="file" name="attachments" class="btn btn-secondary btn-block">
                </div>

            </div>
            <div class="modal-footer">
                <a href="javascript:;" class="btn btn-white" data-dismiss="modal">{{ __('Close') }}</a>
                <button type="submit" class="btn btn-success">
                    <i class="fa fa-save"></i>&nbsp;
                    {{ __('Save') }}
                </button>
            </div>

            {{ Form::close() }}
        </div>
    </div>
</div>