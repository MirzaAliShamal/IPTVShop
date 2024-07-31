(function($) {
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

    var validator = $(".edit-form").validate({
        rules: {
            name: {
                required: true
            },
            email: {
                required: true,
                email: true
            },
            phone: {
                required: true
            },
            nationality: {
                required: true
            },
            passport_no: {
                required: false
            },
            passport_expiry: {
                required: function(element) {
                    return $("[name='passport_no']").val().length > 0;
                },
                date: true
            },
            hiring_status: {
                required: true
            },
            recruitment_channel: {
                required: true
            },
            cv: {
                required: false,
                extension: "pdf|doc|docx",
                filesize: 10000000 // 10MB
            }
        },
        messages: {
            name: "Please enter your name",
            email: {
                required: "Please enter your email address",
                email: "Please enter a valid email address"
            },
            phone: "Please enter your phone number",
            nationality: "Please select your nationality",
            passport_expiry: {
                required: "Passport expiry date is required when passport number is provided",
                date: "Please enter a valid date"
            },
            hiring_status: "Please select a hiring status",
            recruitment_channel: "Please select a recruitment channel",
            cv: {
                required: "Please upload your CV/Resume",
                extension: "Please upload a PDF or Word document",
                filesize: "File size must be less than 10MB"
            }
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


    function displayServerErrors(errors) {
        $.each(errors, function(field, messages) {
            var element = $('[name="' + field + '"]');
            var errorMessage = '<strong>' + messages[0] + '</strong>';
            validator.showErrors({
                [field]: errorMessage
            });
        });
    }

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

    if (Object.keys(laravelErrors).length > 0) {
        displayServerErrors(laravelErrors);
    }

    $("[name='passport_no']").change(function() {
        if (validator && validator.element) {
            validator.element("[name='passport_expiry']");
        }
    });
})(jQuery);
