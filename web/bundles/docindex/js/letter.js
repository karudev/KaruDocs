$(function() {

    formAction();
    addEditAction('#add');
    addEditAction('.edit');
    delAction();

    function addEditAction(classe) {
        $(classe).click(function() {
            $('.modal-content').html('');
            $.get($(this).attr('data-url'), function(html) {
                $('.modal-content').html(html);
                formAction();
            });
        });
    }

    function formAction() {
        $('form').submit(function() {
            $.post($(this).attr('action'), $(this).serializeArray(), function(html) {
                $('#modal_id').modal('hide');
                //$('button[type=reset]').trigger('click');
                $('#show').html(html);
                addEditAction('.edit');
                delAction();
            });
            return false;
        });
    }
    function delAction() {
        $('.del').click(function() {
            if (confirm('Etes vous sûr de vouloir supprimer cette lettre ?')) {
                $.get($(this).attr('data-url'), function(html) {
                    $('#show').html(html);
                     addEditAction('.edit');
                    delAction();
                });
            }
        });
    }
});