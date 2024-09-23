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
            amount: {
                required: true,
                number: true
            },
            'links[][link]': {
                required: true,
                url: true
            }
        },
        messages: {
            amount: "Please enter a valid amount",
            'links[][link]': {
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

    // Function to create a new link field
    function createLinkField() {
        var newId = Date.now(); // Use timestamp as a temporary id
        return `
            <div class="input-group mb-3">
                <input type="hidden" name="links[${newId}][id]" value="new">
                <input type="text" name="links[${newId}][link]" class="form-control" placeholder="https://example.com" autocomplete="off" />
                <div class="input-group-append">
                    <button type="button" class="btn btn-primary add-link">Add</button>
                    <button type="button" class="btn btn-danger remove-link">Remove</button>
                </div>
            </div>
        `;
    }

    // Add new link field when clicking "Add" button
    $(document).on('click', '.add-link', function() {
        $('#link-container').append(createLinkField());
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

    if (Object.keys(laravelErrors).length > 0) {
        displayServerErrors(laravelErrors);
    }

    function displayServerErrors(errors) {
        $.each(errors, function(field, messages) {
            var element = $('[name="' + field + '"]');
            var errorMessage = '<strong>' + messages[0] + '</strong>';
            validator.showErrors({
                [field]: errorMessage
            });
        });
    }
})(jQuery);
