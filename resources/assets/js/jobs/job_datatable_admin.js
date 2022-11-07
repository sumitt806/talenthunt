$(document).ready(function () {
    'use strict';

    $('#filter_featured').
        select2({
            width: '180px',
        });

    $('#filter_suspended').
        select2({
            width: '200px',
        });
});

let tableName = '#jobsTbl';
$(tableName).DataTable({
    processing: true,
    serverSide: true,
    'order': [[0, 'asc']],
    ajax: {
        url: jobsUrl,
        data: function (data) {
            data.is_featured = $('#filter_featured').
                find('option:selected').
                val();
            data.is_suspended = $('#filter_suspended').
                find('option:selected').
                val();
        },
    },
    columnDefs: [
        {
            'targets': [3],
            'orderable': false,
            'className': 'text-center',
            'width': '9%',
        },
        {
            'targets': [4],
            'orderable': false,
            'className': 'text-center',
            'width': '11%',
        },
        {
            'targets': [2],
            'width': '15%',
        },
        {
            'targets': [1],
            'width': '15%',
        },
        {
            'targets': [5],
            'orderable': false,
            'className': 'text-center',
            'width': '5%',
        },
    ],
    columns: [
        {
            data: function (row) {
                return '<a href="' + jobsUrl + '/' + row.id + '">' +
                    row.job_title + '</a>';
            },
            name: 'job_title',
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
                return moment(row.job_expiry_date, 'YYYY-MM-DD hh:mm:ss').
                    format('Do MMM, YYYY');
            },
            name: 'job_expiry_date',
        },
        {
            data: function (row) {
                let featured = row.active_featured;
                let expiryDate;
                if (featured) {
                    expiryDate = moment(featured.end_time).format('YYYY-MM-DD');
                }
                let data = [
                    {
                        'id': row.id,
                        'featured': featured,
                        'expiryDate': expiryDate,
                    }];
                return prepareTemplateRender('#isFeatured', data);
            },
            name: 'hide_salary',
        },
        {
            data: function (row) {
                let checked = row.is_suspended === false ? '' : 'checked';
                let data = [{ 'id': row.id, 'checked': checked }];
                return prepareTemplateRender('#isSuspended', data);
            },
            name: 'hide_salary',
        },
        {
            data: function (row) {
                let url = jobsUrl + '/' + row.id;
                let data = [
                    {
                        'id': row.id,
                        'url': url + '/edit',
                    }];
                return prepareTemplateRender('#jobActionTemplate',
                    data);
            }, name: 'id',
        },
    ],
    'fnInitComplete': function () {
        $('#filter_featured,#filter_suspended').change(function () {
            $(tableName).DataTable().ajax.reload(null, true);
        });
    },
});

$(document).on('click', '.delete-btn', function (event) {
    let jobId = $(event.currentTarget).data('id');
    deleteItem(jobsUrl + '/' + jobId, tableName, 'Job');
});

$(document).on('click', ' .adminJobMakeFeatured ', function (event) {
    let jobId = $(event.currentTarget).data('id');
    jobMakeFeatured(jobId);
});

window.jobMakeFeatured = function (id) {
    $.ajax({
        url: jobsUrl + '/' + id + '/make-job-featured',
        method: 'post',
        cache: false,
        success: function (result) {
            if (result.success) {
                $(tableName).DataTable().ajax.reload(null, false);
                displaySuccessMessage(result.message);
                $('[data-toggle="tooltip"]').tooltip('hide');
            }
        },
        error: function (result) {
            displayErrorMessage(result.responseJSON.message);
        },
    });
};

$(document).on('click', ' .adminJobUnFeatured ', function (event) {
    let jobId = $(event.currentTarget).data('id');
    jobMakeUnFeatured(jobId);
});

window.jobMakeUnFeatured = function (id) {
    $.ajax({
        url: jobsUrl + '/' + id + '/make-job-unfeatured',
        method: 'post',
        cache: false,
        success: function (result) {
            if (result.success) {
                $(tableName).DataTable().ajax.reload(null, false);
                displaySuccessMessage(result.message);
                $('[data-toggle="tooltip"]').tooltip('hide');
            }
        },
        error: function (result) {
            displayErrorMessage(result.responseJSON.message);
        },
    });
};

$(document).on('change', '.isSuspended', function (event) {
    let jobId = $(event.currentTarget).data('id');
    activeIsSuspended(jobId);
});

window.activeIsSuspended = function (id) {
    $.ajax({
        url: jobsUrl + '/' + id + '/change-is-suspend',
        method: 'post',
        cache: false,
        success: function (result) {
            if (result.success) {
                $(tableName).DataTable().ajax.reload(null, false);
            }
        },
    });
};


