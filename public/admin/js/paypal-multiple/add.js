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
            amount: {
                required: true
            },
            'links[]': {
                required: true,
                url: true
            }
        },
        messages: {
            amount: "Please enter amount",
            'links[]': {
                required: "Please enter a link",
                url: "Please enter a valid URL"
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

    // Function to create a new link field
    function createLinkField() {
        return `
            <div class="input-group mb-3">
                <input type="text" name="links[]" class="form-control" placeholder="https://example.com" autocomplete="off" />
                <div class="input-group-append">
                    <button type="button" class="btn btn-primary add-link">Add</button>
                    <button type="button" class="btn btn-danger remove-link">Remove</button>
                </div>
            </div>
        `;
    }

    // Function to add new link field
    function addLinkField() {
        $('#link-container').append(createLinkField());
    }

    // Add new link field when clicking "Add" button
    $(document).on('click', '.add-link', function() {
        addLinkField();
    });

    // Remove link field when clicking "Remove" button
    $(document).on('click', '.remove-link', function() {
        var $container = $('#link-container');
        if ($container.children().length > 1) {
            $(this).closest('.input-group').remove();
        } else {
            Toast.fire({
                icon: 'error',
                title: 'You must have at least one link field.'
            });
        }
    });

    // Initialize with one field on page load
    $(document).ready(function() {
        if ($('#link-container').children().length === 0) {
            $('#link-container').append(createLinkField());
        }
    });
})(jQuery);
