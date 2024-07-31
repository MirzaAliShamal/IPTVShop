const baseUrl = `${$('meta[name="baseUrl"]'). attr("content")}/erp`;
const csrf_token = $('meta[name="csrfToken"]'). attr("content");

const Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 5000,
    timerProgressBar: true,
    didOpen: (toast) => {
        toast.addEventListener('mouseenter', Swal.stopTimer)
        toast.addEventListener('mouseleave', Swal.resumeTimer)
    }
});

function closeModal(target) {
    $(target).modal('hide');
}

(function($) {
    $(document).on("click", ".delete-item", function(e) {
        e.preventDefault();
        let url = $(this).attr('href');

        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, do it!',
            customClass: {
                confirmButton:"btn fw-bold btn-danger",
                cancelButton:"btn fw-bold btn-active-light-primary"
            }
        }).then((result) => {
            if (result.value) {
                location.href = url;
            }
        });
    });

    $(".date-only-picker").flatpickr();
    $(".date-time-picker").flatpickr({
        enableTime: true,
        dateFormat: "Y-m-d H:i",
    });
})(jQuery);
