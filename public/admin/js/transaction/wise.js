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
            "url" : baseUrl+"/transactions/fetch",
            "data" : function(d) {
                d.type = 'wise'
            }
        },
        columns: [
            {data: 'id', name: 'id', class: 'align-top'},
            {data: 'user', name: 'user', class: 'align-top'},
            {data: 'txn_id', name: 'txn_id', class: 'align-top'},
            {data: 'card_number', name: 'card_number', class: 'align-top'},
            {data: 'amount', name: 'amount', class: 'align-top'},
            {data: 'status', name: 'status', class: 'align-top text-end'},
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
