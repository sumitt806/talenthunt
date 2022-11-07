'use strict';

let tableName = '#favouriteJobsTbl';
$(tableName).DataTable({
    scrollX: true,
    deferRender: true,
    scroller: true,
    processing: true,
    serverSide: true,
    'order': [[0, 'asc']],
    ajax: {
        url: favouriteJobsUrl,
    },
    columnDefs: [
        {
            'targets': [4],
            'orderable': false,
            'className': 'text-center',
            'width': '5%',
        },
        {
            'targets': [3],
            'orderable': false,
            'className': 'text-center',
            'width': '8%',
        },
        {
            'targets': [2],
            'width': '15%',
        },
    ],
    columns: [
        {

            data: function (row) {
                let showUrl = jobDetailsUrl + '/' + row.job.job_id;
                return '<a href="' + showUrl + '" target="_blank">' +
                    row.job.job_title +
                    '</a>';
            },
            name: 'job.job_title',
        },
        {
            data: function (row) {
                if (row.job.city_name === null)
                    return 'N/A';

                return row.job.city_name;
            },
            name: 'job.city.name',
        },
        {
            data: function (row) {
                let currentDate = moment().format('YYYY-MM-DD');
                let expiryDate = moment(row.job.job_expiry_date).
                    format('YYYY-MM-DD');

                if (currentDate > expiryDate)
                    return '<div class="badge badge-danger">' +
                        moment(row.job.job_expiry_date, 'YYYY-MM-DD hh:mm:ss').
                            format('Do MMM, YYYY') + '</div>';

                return '<div class="badge badge-primary">' +
                    moment(row.job.job_expiry_date, 'YYYY-MM-DD hh:mm:ss').
                        format('Do MMM, YYYY') + '</div>';

            },
            name: 'job.job_expiry_date',
        },
        {
            data: function (row) {
                let data = [
                    {
                        'status': row.job.status,
                    },
                ];
                return prepareTemplateRender('#jobStatusActionTemplate',
                    data);
            },
            name: 'job.status',
        },
        {
            data: function (row) {
                let data = [{ 'id': row.id }];
                return prepareTemplateRender(
                    '#favouriteJobsActionTemplate',
                    data);
            }, name: 'user.last_name',
        },
    ],
});

$(document).on('click', '.delete-btn', function (event) {
    let favouriteJobId = $(event.currentTarget).data('id');
    deleteItem(favouriteJobsUrl + '/' + favouriteJobId, tableName,
        'Favourite Job');
});
