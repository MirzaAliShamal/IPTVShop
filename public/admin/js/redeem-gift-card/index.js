(function($) {
    var table = $('.server-datatables').DataTable({
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
            "url" : baseUrl+"/redeem-gift-cards/fetch",
            // "data" : function(d) {
            //     d.type = 'visa'
            // }
        },
        columns: [
            {data: 'id', name: 'id'},
            {data: 'user', name: 'user'},
            {data: 'user_link', name: 'user_link'},
            {data: 'amount', name: 'amount'},
            {data: 'status', name: 'status'},
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

    $("#search").keyup(function (e) {
        table.search($(this).val()).draw() ;
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
