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

    var validator = $(".add-form").validate({
        rules: {
            link: {
                required: true
            },
            amount: {
                required: true
            },
        },
        messages: {
            link: "Please enter link",
            amount: "Please enter amount"
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
