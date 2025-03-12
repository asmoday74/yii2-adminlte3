function setModalParam(params) {
    let modalDialog = $("#modal-edit");
    if (params.size) {
        modalDialog.find('.modal-dialog')
            .removeClass('modal-sm')
            .removeClass('modal-lg')
            .removeClass('modal-xl')
            .addClass(params.size);
    }
    if (params.title) {
        modalDialog.find('.modal-title').html(params.title);
    }

    let buttonCancel = modalDialog.find('.btn[data-bs-dismiss="modal"]');
    if (params.cancel) {
        if (buttonCancel.is(":hidden")) {
            buttonCancel.show();
        }
        buttonCancel.html(params.cancel);
    } else {
        buttonCancel.hide();
    }

    let buttonSubmit = modalDialog.find('#modal-submit');
    if (params.submit) {
        if (buttonSubmit.is(":hidden")) {
            buttonSubmit.show();
        }
        buttonSubmit.html(params.submit);
    } else {
        buttonSubmit.hide();
    }
}

function loadData(data) {
    setModalParam(data);
    let modalDialog = $("#modal-edit");
    $.ajax({
        url: data.url,
        method: "POST",
        success: function(result) {
            if (typeof result === 'object') {
                if (result.data) {
                    setModalParam(result.data);
                    modalDialog.find('.modal-body').html(result.data);
                } else {
                    modalDialog.find('.modal-body').html(result);
                }
            } else {
                modalDialog.find('.modal-body').html(result);
            }
        },
        error: function () {
            modalDialog.find('.modal-body').html(result.responseText);
        }
    });
    modalDialog.modal('show');
}

$('body')
    .on('submit', '#modal-edit form',function (event) {
        event.preventDefault();

        let opts = {
            url: $(this).attr("action"),
            data: false,
            cache: false,
            method: 'POST',
            type: 'POST',
            dataType: 'json',
            success: function(result) {
                if (result.hasOwnProperty('data')) {
                    $("#modal-edit").find('.modal-body').html(result.data);
                } else {
                    let pjaxModalContainer = $('div[data-pjax-container]');
                    if (pjaxModalContainer.length) {
                        $.pjax.reload({'container': '#' + pjaxModalContainer.attr('id')});
                    }
                    $("#modal-edit").modal('hide');
                }
                if (result.hasOwnProperty('message')) {
                    $('#modalToast').find('.toast-body').html(result.message);
                    $("#modalToast").toast('show');
                }
            },
            error: function (result) {
                $("#modal-edit").find('.modal-body').html(result.responseText);
            }
        };

        if ($(this).attr('enctype')) {
            opts.data = new FormData($(this)[0]);
            opts.contentType = false;
            opts.processData = false;
        } else {
            opts.data = $(this).serialize();
        }
        $.ajax(opts);
    })
    .on('click', '#modal-submit',function () {
        $('body').find('#modal-edit').find('form').submit();
    })
    .on('click', '.modal-edit-toggle', function (event) {
        let modalParam = $(this).data();
        if (modalParam.url === undefined) {
            modalParam.url = $(this).attr('href');
        }
        if ((modalParam.url !== '#') && (modalParam.url !== "")) {
            event.preventDefault();
            if ($('#modal-edit').length === 0) {
                $.ajax({
                    type: 'POST',
                    data: modalParam,
                    dataType: 'html',
                    url: '/adminlte/modal',
                    success: function (data) {
                        $('body').append(data);
                        loadData(modalParam);
                    }
                });
            } else {
                loadData(modalParam);
            }
        }
    });