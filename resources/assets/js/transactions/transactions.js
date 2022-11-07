'use strict';
let tableName = '#transactionsTable';
$(tableName).DataTable({
    processing: true,
    serverSide: true,
    'order': [[3, 'desc']],
    ajax: {
        url: transactionUrl,
    },
    columnDefs: [
        {
            'targets': [4],
            'className': 'text-center',
            'width': '10%',
            'orderable': false,
        },
        {
            'targets': [3],
            'className': 'text-right',
            'width': '13%',
        },
        {
            targets: '_all',
            defaultContent: 'N/A',
        },
    ],
    columns: [
        {
            data: 'type_name',
            name: 'owner_type',
        },
        {
            data: 'user.full_name',
            name: 'user.first_name',
        },
        {
            data: function (row) {
                return moment(row.created_at).format('YYYY-MM-DD');
            },
            name: 'created_at',
        },
        {
            data: function (row) {
                return row;
            },
            render: function (row) {
                return '$' + currency(row.amount, { precision: 0 }).format();
            },
            name: 'amount',
        },
        {
            data: function (row) {
                if (row.invoice_id != null) {
                    let data = [
                        {
                            'invoiceId': row.invoice_id,
                        }];
                    return prepareTemplateRender('#invoiceTemplate', data);
                }
                return 'N/A';
            }, name: 'id',
        },
    ],
});

$(document).on('click', '.view-invoice', function () {
    let invoiceId = $(this).data('invoice-id');
    $.ajax({
        url: invoiceUrl + invoiceId,
        type: 'get',
        success: function (result) {
            window.open(result.data, '_blank');
        },
        error: function (result) {
            displayErrorMessage(result.responseJSON.message);
        },
    });
});
