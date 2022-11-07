'use strict';

let tableName = '#followersTbl';
$(tableName).DataTable({
    scrollX: true,
    deferRender: true,
    scroller: true,
    processing: true,
    serverSide: true,
    'order': [[0, 'asc']],
    ajax: {
        url: followersUrl,
    },
    columnDefs: [
        {
            'targets': [1],
            'defaultContent': 'N/A',
            'width': '15%',
        },
        {
            'targets': [2],
            'className': 'text-center',
            'width': '25%',
        },
        {
            'targets': [3],
            'visible': false,
        },
    ],
    columns: [
        {
            data: function (row) {
                let showLink = candidateShowUrl + row.user.candidate.unique_id;
                return '<a href="' + showLink + '" target="_blank">' +
                    row.user.full_name + '</a>';
            },
            name: 'user.first_name',
        },
        {
            data: 'user.phone',
            name: 'user.phone',
        },
        {
            data: 'user.email',
            name: 'user.email',
        },
        {
            data: 'user.last_name',
            name: 'user.last_name',
        },
    ],
});
