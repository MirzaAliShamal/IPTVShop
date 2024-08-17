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
            "url" : baseUrl+"/products-orders/fetch",
            // "data" : function(d) {
            //     d.joined_from = $('[name="joined_from"]').val();
            //     d.joined_to = $('[name="joined_to"]').val();
            // }
        },
        columns: [
            {data: 'id', name: 'id', class: 'align-top'},
            {data: 'user', name: 'user.email', class: 'align-top'},
            {data: 'product', name: 'product', class: 'align-top'},
            {data: 'address', name: 'address', class: 'align-top'},
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
