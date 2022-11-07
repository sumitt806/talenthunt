'use strict';

let tableName = '#candidatesTbl';
let tbl = $('#candidatesTbl').DataTable({
    processing: true,
    serverSide: true,
    scrollX: true,
    deferRender: true,
    scroller: true,
    'order': [[0, 'asc']],
    ajax: {
        url: candidateUrl,
        data: function (data) {
            data.is_status = $('#filter_status').
                find('option:selected').
                val();
        },
    },
    columnDefs: [
        {
            targets: '_all',
            defaultContent: 'N/A',
        },
        {
            'targets': [3],
            'className': 'text-center',
            'width': '5%',
            'orderable': false,
        },
        {
            'targets': [4],
            'className': 'text-center',
            'width': '5%',
            'orderable': false,
        },
        {
            'targets': [5],
            'visible': false,
        },
    ],
    columns: [
        {
            data: function (row) {
                let showUrl = candidateUrl + '/' + row.id;
                return '<a href="' + showUrl + '">' + row.user.full_name +
                    '</a>';
            },
            name: 'user.first_name',
        },
        {
            data: 'user.email',
            name: 'user.email',
        },
        {
            data: function (row) {
                if (row.industry_id == null) {
                    return 'N/A';
                } else {
                    return row.industry.name;
                }
            },
            name: 'industry.name',
        },
        {
            data: function (row) {
                let checked = row.user.is_active === 0 ? '' : 'checked';
                let data = [{ 'id': row.id, 'checked': checked }];
                return prepareTemplateRender('#isActive', data);
            },
            name: 'user.is_active',
        },
        {
            data: function (row) {
                let url = candidateUrl + '/' + row.id;
                let data = [
                    {
                        'id': row.id,
                        'url': url + '/edit',
                    }];
                return prepareTemplateRender('#candidateActionTemplate', data);
            }, name: 'id',
        },
        {
            data: 'user.last_name',
            name: 'user.last_name',
        },
    ],
    'fnInitComplete': function () {
        $('#filter_status').change(function () {
            $(tableName).DataTable().ajax.reload(null, true);
        });
    },
});

$(document).ready(function () {
    $('#filter_status').select2();
});

$(document).on('click', '.delete-btn', function (event) {
    let candidateId = $(event.currentTarget).data('id');
    console.log(candidateId);
    deleteItem(candidateUrl + '/' + candidateId, tableName, 'Candidate');
});

$(document).on('change', '.isActive', function (event) {
    let candidateId = $(event.currentTarget).data('id');
    $.ajax({
        url: candidateUrl + '/' + candidateId + '/' + 'change-status',
        method: 'post',
        cache: false,
        success: function (result) {
            if (result.success) {
                $(tableName).DataTable().ajax.reload(null, false);
            }
        },
        error: function (result) {
            displayErrorMessage(result.responseJSON.message);
        },
    });
});
