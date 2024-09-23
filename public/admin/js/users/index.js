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
            "url" : baseUrl+"/users/fetch",
            // "data" : function(d) {
            //     d.type = 'visa'
            // }
        },
        columns: [
            {data: 'id', name: 'id', class: 'align-top'},
            {data: 'name', name: 'name', class: 'align-top'},
            {data: 'email', name: 'email', class: 'align-top'},
            {data: 'wallet_balance', name: 'wallet_balance', class: 'align-top'},
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

    $("#search").keyup(function (e) {
        table.search($(this).val()).draw() ;
    });

    $(document).on("click", ".adjust-balance", function(e) {
        e.preventDefault();
        $.ajax({
            type: "GET",
            url: $(this).attr('href'),
            success: function (response) {
                $("#adjust_details_modal .modal-body").html(response);
                $("#adjust_details_modal").modal('show');
            },
        });
    });
})(jQuery);
