
function loadForm(data) {
    if ('title' in data) {
        $("#modal-edit .modal-title").html(data['title']);
    }
    if ('size' in data) {
        $("#modal-edit .modal-dialog").addClass('modal-'+data['size']);
    }
    if ('url' in data) {
        $("#modal-edit").modal('show')
            .find('.modal-body')
            .load(data['url']);
    }
}

$('body')
    .on('submit', '#modal-edit form',function (event) {
        event.preventDefault();
        $.post($(this).attr("action"), $(this).serialize())
            .done(function(result){
                const resultObj = JSON.parse(result);
                const pjaxModalContainer = $('div[data-pjax-container]');
                if (pjaxModalContainer.length) {
                    $.pjax.reload({'container': '#' + pjaxModalContainer.attr('id')});
                }
                $("#modal-edit").modal('hide');
                if (resultObj.message) {
                    $('#modalToast').find('.toast-body').html(resultObj.message);
                    $("#modalToast").toast('show');
                }
            })
            .fail(function(){
                console.log("Modal form submit error");
            });
    })
    .on('click', '#modal-submit',function () {
        $('body').find('#modal-edit').find('form').submit();
    })
    .on('click', '.modal-edit-toggle', function () {
        let modalParam = $(this).data();
        if ($('#modal-edit').length === 0) {
            $.ajax({
                type: 'POST',
                dataType: 'html',
                url: '/adminlte/modal',
                success: function (data) {
                    $('body').append(data);
                    loadForm(modalParam);
                }
            });
        } else {
            loadForm(modalParam);
        }
    });