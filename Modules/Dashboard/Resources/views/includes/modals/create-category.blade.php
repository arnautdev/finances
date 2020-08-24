<div class="modal fade" id="{{ $modalName }}">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">{{ __('Create category') }}</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div><!-- End ./modal-header -->

            {{ Form::open(['route' => ['categories.store', 'referer'=>1], 'data-parsley-validate' => 'true']) }}
            <input type="hidden" name="isActive" value="yes">
            <div class="modal-body">

                <div class="form-group">
                    <label for="title">{{ __('Category title') }}</label>
                    {!! $form->input([
                        'name' => 'title',
                        'onlyInput' => true,
                        'attrs' => [
                            'required' => 'required'
                        ]
                    ]) !!}
                </div><!-- End ./form-group -->

                <div class="form-group">
                    <label for="title">{{ __('Parent category') }}</label>
                    {!! $form->select([
                        'onlyInput' => true,
                        'name' => 'parentCategoryId',
                        'class' => 'no-radius',
                        'emptyOption' => [0, 'This category is parent'],
                        'options' => $parentCategories
                    ]) !!}
                </div><!-- End ./form-group -->

            </div>
            <div class="modal-footer">
                <a href="javascript:;" class="btn btn-white" data-dismiss="modal">{{ __('Close') }}</a>
                <button type="submit" class="btn btn-success">
                    <i class="fa fa-save"></i>&nbsp;
                    {{ __('Save') }}
                </button>
            </div>

            {{ Form::close() }}
        </div><!-- End ./modal-content -->
    </div><!-- End ./modal-dialog -->
</div><!-- End modal fade -->