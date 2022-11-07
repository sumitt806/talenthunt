'use strict';

let tableName = '#appliedJobsTbl';
let rowCount = 0;
$(tableName).DataTable({
    scrollX: true,
    deferRender: true,
    scroller: true,
    processing: true,
    serverSide: true,
    'order': [[0, 'asc']],
    ajax: {
        url: candidateAppliedJobUrl,
    },
    columnDefs: [
        {
            'targets': [1],
            'width': '15%',
        },

        {
            'targets': [2],
            'orderable': false,
            'className': 'text-center',
            'width': '5%',
        },
        {
            'targets': [3],
            'orderable': false,
            'className': 'text-center',
            'width': '10%',
        },
        {
            'targets': [4],
            'visible': false,
        },
    ],
    columns: [
        {
            data: function (row) {
                return '<a href="' + JobTitleUrl + '/' + row.job.job_id +
                    '" target="_blank">'
                    + row.job.job_title + '</a>';
            },
            name: 'job.job_title',
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
                const statusColor = {
                    '0': 'warning',
                    '1': 'primary',
                    '2': 'danger',
                    '3': 'info',
                    '4': 'success',
                };
                return '<span style="width:100px" class="badge badge-' +
                    statusColor[row.status] +
                    '">' + statusArray[row.status] + '</span>';
            },
            name: 'status',
        },
        {
            data: function (row) {
                let data = [
                    {
                        'id': row.id,
                        'isJobDrafted': (row.status === 0) ? true : false,
                        'showUrl': jobDetailsUrl + '/' + row.job.job_id,
                    }];

                return prepareTemplateRender('#appliedJobActionTemplate', data);
            }, name: 'id',
        },
        {
            data: 'candidate.user.last_name',
            name: 'candidate.user.last_name',
        },
    ],
});

$(document).on('click', '.delete-btn', function (event) {
    let applyJobId = $(event.currentTarget).data('id');
    deleteItem(candidateAppliedJobUrl + '/' + applyJobId, tableName,
        'Apply job');
});

$(document).on('click', '.view-note', function (event) {
    let appliedJobId = $(event.currentTarget).data('id');
    $.ajax({
        url: candidateAppliedJobUrl + '/' + appliedJobId,
        type: 'GET',
        success: function (result) {
            if (result.success) {
                $('#showNote').html('');
                if (!isEmpty(result.data.notes) ? $('#showNote').
                    append(result.data.notes) : $('#showNote').append('N/A'))
                    $('#showModal').appendTo('body').modal('show');
            }
        },
        error: function (result) {
            displayErrorMessage(result.responseJSON.message);
        },
    });
});
