function setModalParam(params, checkButton = true) {
    let modalDialog = $("#modal-edit");
    let newSize = params.size || params.modalSize;
    if (newSize) {
        modalDialog.find('.modal-dialog')
            .removeClass('modal-sm')
            .removeClass('modal-lg')
            .removeClass('modal-xl')
            .addClass(newSize);
    }

    let newTitle = params.title || params.modalSize;
    if (newTitle) {
        modalDialog.find('.modal-title').html(newTitle);
    }

    if (checkButton) {
        let buttonCancel = modalDialog.find('.btn[data-bs-dismiss="modal"]');
        let buttonCancelName = params.cancel || params.modalCancel;
        if (buttonCancelName) {
            if (buttonCancel.is(":hidden")) {
                buttonCancel.show();
            }
            buttonCancel.html(buttonCancelName);
        } else {
            buttonCancel.hide();
        }

        let buttonSubmit = modalDialog.find('#modal-submit');
        let buttonSubmitName = params.submit || params.modalSubmit;
        if (buttonSubmitName) {
            if (buttonSubmit.is(":hidden")) {
                buttonSubmit.show();
            }
            buttonSubmit.html(buttonSubmitName);
        } else {
            buttonSubmit.hide();
        }
    }
}

function loadData(data) {
    setModalParam(data);
    let modalDialog = $("#modal-edit");
    let modalSpinner = modalDialog.find('.modal-body').find('.modal-spinner');
    let modalContent = modalDialog.find('.modal-body').find('.modal-edit-content');
    modalSpinner.show();
    $.ajax({url: data.url, method: "GET"})
        .done(function(result) {
            if (typeof result === 'object') {
                if (result.data) {
                    setModalParam(result);
                    modalContent.html(result.data);
                } else {
                    modalContent.html(result);
                }
            } else {
                modalContent.html(result);
            }
        })
        .fail(function (result) {
            if ((typeof result === 'object') && (result.hasOwnProperty('responseText'))) {
                modalContent.html(result.responseText);
            } else {
                modalContent.html(result);
            }
        })
        .always(function () {
            modalSpinner.hide();
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
            dataType: 'json'
        };

        if ($(this).attr('enctype')) {
            opts.data = new FormData($(this)[0]);
            opts.contentType = false;
            opts.processData = false;
        } else {
            opts.data = $(this).serialize();
        }
        $.ajax(opts)
            .done(function(result) {
                let modalDialogContent = $("#modal-edit").find('.modal-body').find('.modal-edit-content');
                if (typeof result === 'object') {
                    if (result.hasOwnProperty('data')) {
                        modalDialogContent.html(result.data);
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
                }
            });
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
                    async: false,
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