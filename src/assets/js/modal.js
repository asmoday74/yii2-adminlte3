
function loadForm(data) {
    let modal = $("#modal-edit");
    if ('url' in data) {
        $.getJSON(data['url'], function(result) {
            if (result.data) {
                const data = result.data;
                if (result.modalCancel) {
                    modal.find('.btn[data-bs-dismiss="modal"]').html(result.modalCancel);
                }
                if (result.modalSubmit) {
                    modal.html(result.modalSubmit);
                }
            } else {
                const data = result;
            }
            modal.find('.modal-body').html(data);
        });
    }
    modal.modal('show');
}

$('body')
    .on('submit', '#modal-edit form',function (event) {
        event.preventDefault();
        $.post($(this).attr("action"), $(this).serialize())
            .done(function(result){
                const resultObj = JSON.parse(result);
                if ((resultObj.reload) && (resultObj.data)) {
                    $("#modal-edit").find('.modal-body').html(resultObj.data);
                } else {
                    const pjaxModalContainer = $('div[data-pjax-container]');
                    if (pjaxModalContainer.length) {
                        $.pjax.reload({'container': '#' + pjaxModalContainer.attr('id')});
                    }
                    $("#modal-edit").modal('hide');
                }
                if (resultObj.message) {
                    $('#modalToast').find('.toast-body').html(resultObj.message);
                    $("#modalToast").toast('show');
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