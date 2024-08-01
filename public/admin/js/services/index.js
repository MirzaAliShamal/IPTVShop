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
            "url" : baseUrl+"/services/fetch",
            // "data" : function(d) {
            //     d.joined_from = $('[name="joined_from"]').val();
            //     d.joined_to = $('[name="joined_to"]').val();
            // }
        },
        columns: [
            {data: 'id', name: 'id'},
            {data: 'logo', name: 'logo'},
            {data: 'duration', name: 'duration'},
            {data: 'price', name: 'price'},
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
})(jQuery);
