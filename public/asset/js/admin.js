var MsgBox = {
    question: function (title, msg, yes, no, cancel = '', yesBtnClass = 'primary') {
        return Swal.fire({
            title: title,
            html: msg,
            icon: 'question',
            showDenyButton: true,
            showCloseButton: true,
            showCancelButton: cancel.length > 0,
            confirmButtonText: '<i class="fa fa-check mr-2"></i>' + yes,
            denyButtonText: '<i class="fa fa-xmark mr-2"></i>' + no,
            cancelButtonText: cancel,
            showClass: { popup: 'animate__animated animate__fadeInDown' },
            hideClass: { popup: 'animate__animated animate__fadeOutUp' },
            buttonsStyling: false,
            customClass: {
                confirmButton: 'btn btn-' + yesBtnClass + ' mr-3',
                denyButton: 'btn btn-default',
                cancelButton: 'btn btn-default',
            },
        });
    }
}

function confirmDelete(form, title = 'Anda yakin akan menghapus rekaman ini?') {
    MsgBox.question('Konfirmasi', title, 'Ya', 'Tidak', '', 'danger')
        .then((result) => {
            if (result.isConfirmed) {
                form.submit();
            }
        });
    return false;
}