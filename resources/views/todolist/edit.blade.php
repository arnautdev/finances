<div class="modal fade" id="edit-todo-list" aria-hidden="true">
    <div class="modal-dialog">
        {{ Form::open(['route' => ['todo.update', $data['todo']->id], 'data-parsley-validate' => 'true']) }}
        @method('PUT')
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">{{ __('Update task') }}</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="from-group">
                        <textarea type="text"
                                  name="description"
                                  required="required"
                                  class="form-control"
                                  placeholder="{{ __('Task description') }}"
                                  maxlength="500"
                        >{{ $data['todo']->description }}</textarea>
                </div><!-- End ./form-group -->
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">{{ __('Close') }}</button>
                <button type="submit" class="btn btn-primary">{{ __('Save changes') }}</button>
            </div>
        </div>
        <!-- /.modal-content -->

        {{ Form::close() }}
    </div>
    <!-- /.modal-dialog -->
</div>
