'use strict';

let tableName = '#favouriteCompaniesTbl';
$(tableName).DataTable({
    scrollX: true,
    deferRender: true,
    scroller: true,
    processing: true,
    serverSide: true,
    'order': [[0, 'asc']],
    ajax: {
        url: favouriteCompaniesUrl,
    },

    columnDefs: [
        {
            'targets': [2],
            'orderable': false,
            'className': 'text-center',
            'width': '5%',
        },
    ],
    columns: [
        {
            data: 'company.user.full_name',
            name: 'company.user.first_name',
        },
        {
            data: 'company.user.email',
            name: 'company.user.email',
        },
        {
            data: function (row) {
                let data = [{ 'id': row.id }];
                return prepareTemplateRender(
                    '#favouriteCompaniesActionTemplate',
                    data);
            }, name: 'id',
        },

    ],
});

$(document).on('click', '.delete-btn', function (event) {
    let favouriteCompanyId = $(event.currentTarget).data('id');
    deleteItem(favouriteCompaniesUrl + '/' + favouriteCompanyId, tableName,
        'Following   Company');
});
