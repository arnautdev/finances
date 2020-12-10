<div class="modal fade" id="set-amount-modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">{{ __('Set amount') }}</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            {{ Form::open(['route' => 'add-expense.store', 'data-parsley-validate' => 'true']) }}
            <div class="modal-body">
                <input type="hidden" name="userId" value="{{ auth()->id() }}">
                <input type="hidden" name="expenseId" value="{{ $data['expense']->id }}">
                <input type="hidden" name="categoryId" value="{{ $data['expense']->categoryId }}">

                <input type="text" name="amount" required="required" class="form-control"
                       placeholder="{{ __('Set amount 99.00') }}"/>

            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">{{ __('Close') }}</button>
                <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>
            </div>
            {{ Form::close() }}
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
