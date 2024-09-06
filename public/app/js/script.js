// --------otp section------
$(".otp-inputbar").keypress(function (e) {
    if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
        return false;
    }
});

$(".otp-inputbar").on("keyup keydown keypress", function (e) {
    if ($(this).val()) {
        $(this).next().focus();
    }
    var KeyID = e.keyCode;
    switch (KeyID) {
        case 8:
            $(this).val("");
            $(this).prev().focus();
            break;
        case 46:
            $(this).val("");
            $(this).prev().focus();
            break;
        default:
            break;
    }
});

// Sidebar Toggle
$("[data-toggle='sidebar']").click(function (e) {
    e.preventDefault();
     // Toggle the data-side-minimize attribute
     var body = $("body");
     var currentState = body.attr("data-side-minimize");

     if (currentState === "off") {
        body.attr("data-side-minimize", "on");
     } else {
        body.attr("data-side-minimize", "off");
     }
});

// Swal Toast
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