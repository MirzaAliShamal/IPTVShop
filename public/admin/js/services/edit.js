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
            duration: {
                required: true,
                number: true
            },
            title: {
                required: true
            },
            price: {
                required: true
            },
            short_desc: {
                required: false
            },
            description: {
                required: true
            },
            status: {
                required: true
            }
        },
        messages: {
            duration: {
                required: "Please select a duration",
                number: "Please enter a valid duration"
            },
            title: "Please enter title",
            price: "Please enter price",
            short_desc: "Please enter short description",
            description: "Please enter description",
            status: "Please select a status"
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
})(jQuery);
