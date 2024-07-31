var validator;

function displayServerErrors(errors) {
    if (validator && validator.showErrors) {
        $.each(errors, function(field, messages) {
            var element = $('[name="' + field + '"]');
            var errorMessage = '<strong>' + messages[0] + '</strong>';
            validator.showErrors({
                [field]: errorMessage
            });
        });
    }
}

function initializeFormValidation() {
    function customErrorPlacement(error, element) {
        error.addClass('invalid-feedback');
        if (!error.find('strong').length) {
            error.wrapInner('<strong></strong>');
        }
        element.closest('.form-group').append(error);
    }

    function customSuccess(label, element) {
        $(element).removeClass('is-invalid');
        label.remove();
    }

    validator = $(".edit-form").validate({
        rules: {
            datetime: {
                required: true
            },
            mode: {
                required: true
            },
            details: {
                required: true
            },
            interview_outcome: {
                required: true
            },
            link: {
                required: function(element) {
                    return $("[name='mode']").val() === "online";
                }
            }
        },
        messages: {
            datetime: "Please select date & time",
            phone: "Please choose interview mode",
            details: "Please enter interview details",
            interview_outcome: "Please select a interview outcome",
            link: "Please provide a link for the online interview"
        },
        errorElement: 'div',
        errorPlacement: customErrorPlacement,
        success: customSuccess,
        highlight: function(element, errorClass, validClass) {
            $(element).addClass('is-invalid');
        },
        unhighlight: function(element, errorClass, validClass) {
            $(element).removeClass('is-invalid');
        },
        submitHandler: function(form) {
            form.submit();
        }
    });

    // Custom method for file size validation
    $.validator.addMethod('filesize', function(value, element, param) {
        return this.optional(element) || (element.files[0].size <= param)
    }, 'File size must be less than {0} bytes');

    if (validator && validator.showErrors) {
        var originalShowErrors = validator.showErrors;
        validator.showErrors = function(errors) {
            originalShowErrors.call(this, errors);
            $(".error.invalid-feedback").each(function() {
                var $this = $(this);
                if (!$this.find('strong').length) {
                    $this.wrapInner('<strong></strong>');
                }
            });
        };
    }

    if (Object.keys(laravelErrors).length > 0) {
        displayServerErrors(laravelErrors);
    }

    $("[name='mode']").change(function() {
        if (validator && validator.element) {
            validator.element("[name='link']");
        }
    });
}

$(document).on("click", ".update-record", function(e) {
    e.preventDefault();
    $.ajax({
        type: "GET",
        url: $(this).attr('href'),
        success: function (response) {
            $("#edit_details_modal .modal-body").html(response);
            $("#edit_details_modal [data-control='select2']").select2();
            $("#edit_details_modal .date-time-picker").flatpickr({
                enableTime: true,
                dateFormat: "Y-m-d H:i",
            });
            initializeFormValidation();
            $("#edit_details_modal").modal('show');
        },
    });
});
