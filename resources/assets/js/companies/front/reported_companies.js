'use strict';

let tableName = '#reportedCompaniesTbl';
$(tableName).DataTable({
    scrollX: true,
    deferRender: true,
    scroller: true,
    processing: true,
    serverSide: true,
    'order': [[0, 'asc']],
    ajax: {
        url: reportedCompaniesUrl,
    },
    columnDefs: [
        {
            'targets': [0],
            'width': '20%',
        },
        {
            'targets': [2],
            'width': '13%',
        },

        {
            'targets': [3],
            'orderable': false,
            'className': 'text-center',
            'width': '8%',
        },
        {
            'targets': [4],
            'visible': false,
        },
    ],
    columns: [
        {
            data: 'company.user.full_name',
            name: 'company.user.first_name',
        },
        {
            data: 'user.full_name',
            name: 'user.first_name',
        },
        {
            data: function (row) {
                return moment(row.created_at, 'YYYY-MM-DD hh:mm:ss').
                    format('Do MMM, YYYY');
            },
            name: 'created_at',
        },
        {
            data: function (row) {
                let data = [{ 'id': row.id }];
                return prepareTemplateRender('#reportedCompanyActionTemplate',
                    data);
            }, name: 'id',
        },
        {
            data: 'user.last_name',
            name: 'user.last_name',
        },
    ],
});
$(document).on('click', '.delete-btn', function (event) {
    let reportedCompanyId = $(event.currentTarget).data('id');
    deleteItem(reportedCompaniesUrl + '/' + reportedCompanyId, tableName,
        'Reported Company');
});

$(document).on('click', '.view-note', function (event) {
    let reportedCompanyId = $(event.currentTarget).data('id');
    $.ajax({
        url: reportedCompaniesUrl + '/' + reportedCompanyId,
        type: 'GET',
        success: function (result) {
            if (result.success) {
                $('#showNote').html('');
                if (!isEmpty(result.data.note) ? $('#showNote').
                    append(result.data.note) : $('#showNote').append('N/A'))
                    $('#showModal').appendTo('body').modal('show');
            }
        },
        error: function (result) {
            displayErrorMessage(result.responseJSON.message);
        },
    });
});
