var markAsDone = function () {
    $(document).on('click', '.markAsDone', function () {

        var $checkbox = $(this).prev('input[type="checkbox"]');
        var $url = $checkbox.data('url');
        var $id = $checkbox.data('id');

        if (!$checkbox.is(':checked')) {
            $checkbox.parents('li').addClass('done');
            $.post($url, {id: $id, isDone: 'yes'}, function ($resp) {
                console.log($resp);
            });
        } else {
            $checkbox.parents('li').removeClass('done');
            $.post($url, {id: $id, isDone: 'no'}, function ($resp) {
                console.log($resp);
            });
        }
    });
};

var editTodo = function () {
    if ($('.edit-todo-row').length > 0) {
        $(document).on('click', '.edit-todo-row', function () {
            var $url = $(this).data('url');
            var $id = $(this).data('id');
            $.get($url, function ($resp) {
                $('#edit-todo-list').remove();
                $('body').append($resp);
                $('#edit-todo-list').modal('show');
            });
        });
    }
};

var destroyTodo = function () {
    if ($('.destroy-todo-row').length > 0) {
        $(document).on('click', '.destroy-todo-row', function () {
            var $url = $(this).data('url');
            var $id = $(this).data('id');
            var $row = $(this);

            $.ajax({
                type: "DELETE",
                url: $url,
                data: {id: $id},
                success: function () {
                    $row.parents('li').remove();
                }
            });
        });
    }
};

$daterangepicker = document.getElementById('daterangepicker');
if ($daterangepicker !== null) {
    console.log('initrange picker');
    $($daterangepicker).daterangepicker({
        locale: {
            format: 'YYYY-MM-DD'
        }
    });
}

$('#reservationtime').daterangepicker({
    timePicker: true,
    timePickerIncrement: 30,
    locale: {
        format: 'MM/DD/YYYY hh:mm A'
    }
});

$('.todo-list').sortable({
    placeholder: 'sort-highlight',
    handle: '.handle',
    forcePlaceholderSize: true,
    zIndex: 999999
});

/* Init functions */
$(function () {
    editTodo();
    destroyTodo();
    markAsDone();
});

