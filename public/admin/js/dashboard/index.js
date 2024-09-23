(function($) {
    $('#iptvSubscription').DataTable({
        "sort": false,
        "ordering": false,
        "pagingType": "full_numbers",
        "processing": true,
        "serverSide": true,
        "lengthMenu": [
            [25, 50, 150, -1],
            [25, 50, 150, "All"]
        ],
        ajax: {
            "url" : baseUrl+"/iptv-subscriptions/fetch",
            "data" : function(d) {
                d.status = 'pending';
            }
        },
        columns: [
            {data: 'id', name: 'id', class: 'align-top'},
            {data: 'user', name: 'user.email', class: 'align-top'},
            {data: 'title', name: 'title', class: 'align-top'},
            {data: 'status', name: 'status', class: 'align-top'},
            {
                class: 'td-actions align-top text-end',
                data: 'action',
                name: 'action',
                orderable: true,
                sorting: false,
                searchable: false
            },
        ],
        fnDrawCallback: function (oSettings) {
            var tooltip = document.querySelectorAll('[data-bs-toggle="tooltip"]');
            $(tooltip).each(function (index, element) {
                new bootstrap.Tooltip(element)
            });
        },
        responsive: true,
        language: {
            search: "_INPUT_",
            searchPlaceholder: "Search records",
        }
    });

    $('#servicesSubscription').DataTable({
        "sort": false,
        "ordering": false,
        "pagingType": "full_numbers",
        "processing": true,
        "serverSide": true,
        "lengthMenu": [
            [25, 50, 150, -1],
            [25, 50, 150, "All"]
        ],
        ajax: {
            "url" : baseUrl+"/services-subscriptions/fetch",
            "data" : function(d) {
                d.status = 'pending';
            }
        },
        columns: [
            {data: 'id', name: 'id', class: 'align-top'},
            {data: 'user', name: 'user.email', class: 'align-top'},
            {data: 'title', name: 'title', class: 'align-top'},
            {data: 'status', name: 'status', class: 'align-top'},
            {
                class: 'td-actions align-top text-end',
                data: 'action',
                name: 'action',
                orderable: true,
                sorting: false,
                searchable: false
            },
        ],
        fnDrawCallback: function (oSettings) {
            var tooltip = document.querySelectorAll('[data-bs-toggle="tooltip"]');
            $(tooltip).each(function (index, element) {
                new bootstrap.Tooltip(element)
            });
        },
        responsive: true,
        language: {
            search: "_INPUT_",
            searchPlaceholder: "Search records",
        }
    });

    $('#pendingOrders').DataTable({
        "sort": false,
        "ordering": false,
        "pagingType": "full_numbers",
        "processing": true,
        "serverSide": true,
        "lengthMenu": [
            [25, 50, 150, -1],
            [25, 50, 150, "All"]
        ],
        ajax: {
            "url" : baseUrl+"/products-orders/fetch",
            "data" : function(d) {
                d.status = 'pending';
            }
        },
        columns: [
            {data: 'id', name: 'id', class: 'align-top'},
            {data: 'user', name: 'user.email', class: 'align-top'},
            {data: 'product', name: 'product', class: 'align-top'},
            {data: 'address', name: 'address', class: 'align-top'},
            {
                class: 'td-actions align-top text-end',
                data: 'action',
                name: 'action',
                orderable: true,
                sorting: false,
                searchable: false
            },
        ],
        fnDrawCallback: function (oSettings) {
            var tooltip = document.querySelectorAll('[data-bs-toggle="tooltip"]');
            $(tooltip).each(function (index, element) {
                new bootstrap.Tooltip(element)
            });
        },
        responsive: true,
        language: {
            search: "_INPUT_",
            searchPlaceholder: "Search records",
        }
    });

    $('#pendingPaypal').DataTable({
        "sort": false,
        "ordering": false,
        "pagingType": "full_numbers",
        "processing": true,
        "serverSide": true,
        "lengthMenu": [
            [25, 50, 150, -1],
            [25, 50, 150, "All"]
        ],
        ajax: {
            "url" : baseUrl+"/transactions/fetch",
            "data" : function(d) {
                d.type = 'paypal',
                d.status = 'pending'
            }
        },
        columns: [
            {data: 'id', name: 'id'},
            {data: 'sender_paypal_email', name: 'sender_paypal_email'},
            {data: 'company_paypal_email', name: 'company_paypal_email'},
            {data: 'amount', name: 'amount'},
            {
                class: 'td-actions text-end',
                data: 'action',
                name: 'action',
                orderable: true,
                sorting: false,
                searchable: false
            },
        ],
        fnDrawCallback: function (oSettings) {
            var tooltip = document.querySelectorAll('[data-bs-toggle="tooltip"]');
            $(tooltip).each(function (index, element) {
                new bootstrap.Tooltip(element)
            });
        },
        responsive: true,
        language: {
            search: "_INPUT_",
            searchPlaceholder: "Search records",
        }
    });

    $('#pendingWire').DataTable({
        "sort": false,
        "ordering": false,
        "pagingType": "full_numbers",
        "processing": true,
        "serverSide": true,
        "lengthMenu": [
            [25, 50, 150, -1],
            [25, 50, 150, "All"]
        ],
        ajax: {
            "url" : baseUrl+"/transactions/fetch",
            "data" : function(d) {
                d.type = 'visa',
                d.status = 'pending'
            }
        },
        columns: [
            {data: 'id', name: 'id'},
            {data: 'sender_bank_iban', name: 'sender_bank_iban'},
            {data: 'company_bank', name: 'company_bank'},
            {data: 'amount', name: 'amount'},
            {
                class: 'td-actions text-end',
                data: 'action',
                name: 'action',
                orderable: true,
                sorting: false,
                searchable: false
            },
        ],
        fnDrawCallback: function (oSettings) {
            var tooltip = document.querySelectorAll('[data-bs-toggle="tooltip"]');
            $(tooltip).each(function (index, element) {
                new bootstrap.Tooltip(element)
            });
        },
        responsive: true,
        language: {
            search: "_INPUT_",
            searchPlaceholder: "Search records",
        }
    });

    $(document).on("click", ".update-record", function(e) {
        e.preventDefault();
        $.ajax({
            type: "GET",
            url: $(this).attr('href'),
            success: function (response) {
                $("#edit_details_modal .modal-body").html(response);
                $("#edit_details_modal").modal('show');
            },
        });
    });
})(jQuery);
