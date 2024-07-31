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
            visa_document: {
                required: false,
                extension: "pdf|doc|docx",
                filesize: 10000000 // 10MB
            }
        },
        messages: {
            visa_document: {
                extension: "Please upload a PDF or Word document",
                filesize: "File size must be less than 10MB"
            },
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
            $("#edit_details_modal .date-only-picker").flatpickr();
            initializeFormValidation();
            $("#edit_details_modal").modal('show');
        },
    });
});
