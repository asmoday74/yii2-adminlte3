
function loadForm(data) {
    let modalDialog = $("#modal-edit");
    if ('url' in data) {
        $.getJSON(data['url'], function(result) {
            if (result.data) {
                modalDialog.find('.modal-body').html(result.data);
                if (result.modalCancel) {
                    modalDialog.find('.btn[data-bs-dismiss="modal"]').html(result.modalCancel);
                }
                if (result.modalSubmit) {
                    modalDialog.find('#modal-submit').html(result.modalSubmit);
                }
            } else {
                modalDialog.find('.modal-body').html(result);
            }
        });
    }
    modalDialog.modal('show');
}

$('body')
    .on('submit', '#modal-edit form',function (event) {
        event.preventDefault();
        $.post($(this).attr("action"), $(this).serialize())
            .done(function(result) {
                let resultObj = JSON.parse(result);
                if (resultObj) {
                    if (resultObj.hasOwnProperty('data')) {
                        $("#modal-edit").find('.modal-body').html(resultObj.data);
                    }
                    if (resultObj.hasOwnProperty('message')) {
                        $('#modalToast').find('.toast-body').html(resultObj.message);
                        $("#modalToast").toast('show');
                    }
                } else {
                    let pjaxModalContainer = $('div[data-pjax-container]');
                    if (pjaxModalContainer.length) {
                        $.pjax.reload({'container': '#' + pjaxModalContainer.attr('id')});
                    }
                    $("#modal-edit").modal('hide');
                }
            })
            .fail(function(){
                    console.log("Modal form submit error");
                }
            );
    })
    .on('click', '#modal-submit',function () {
        $('body').find('#modal-edit').find('form').submit();
    })
    .on('click', '.modal-edit-toggle', function () {
        let modalParam = $(this).data();
        if ($('#modal-edit').length === 0) {
            $.ajax({
                type: 'POST',
                data: modalParam,
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