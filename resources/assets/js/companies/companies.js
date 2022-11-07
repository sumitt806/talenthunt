'use strict';

let tableName = '#companiesTbl';
$(tableName).DataTable({
    processing: true,
    serverSide: true,
    'order': [[1, 'asc']],
    ajax: {
        url: companiesUrl,
        data: function (data) {
            data.is_featured = $('#filter_featured').
                find('option:selected').
                val();
            data.is_status = $('#filter_status').
                find('option:selected').
                val();
        },
    },
    columnDefs: [
        {
            'targets': [0],
            'orderable': false,
            'className': 'text-center',
            'width': '5%',
        },
        {
            'targets': [3],
            'orderable': false,
            'className': 'text-center',
            'width': '5%',
        },
        {
            'targets': [4],
            'orderable': false,
            'className': 'text-center',
            'width': '9%',
        },
        {
            'targets': [5],
            'orderable': false,
            'className': 'text-center',
            'width': '8%',
        },
    ],
    columns: [
        {
            data: function (row) {
                return '<img src="' + row.company_url +
                    '" class="rounded-circle thumbnail-rounded"' + '</img>';
            },
            name: 'user.last_name',
        },
        {
            data: function (row) {
                return '<a href="' + companiesUrl + '/' + row.id + '">' +
                    row.user.first_name + '</a>';
            },
            name: 'user.first_name',
        },
        {
            data: 'user.email',
            name: 'user.email',
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
            name: 'is_featured',
        },
        {
            data: function (row) {
                let url = companiesUrl + '/' + row.id;
                let data = [
                    {
                        'id': row.id,
                        'url': url + '/edit',
                    }];
                return prepareTemplateRender('#companyActionTemplate',
                    data);
            }, name: 'id',
        },
    ],
    'fnInitComplete': function () {
        $('#filter_featured,#filter_status').change(function () {
            $(tableName).DataTable().ajax.reload(null, true);
        });
    },
});

$(document).ready(function () {
    $('#filter_featured').select2({
        width: '170px',
    });
    $('#filter_status').select2();
});

$(document).on('click', '.adminMakeFeatured', function (event) {
    let companyId = $(event.currentTarget).data('id');
    makeFeatured(companyId);
});

window.makeFeatured = function (id) {
    $.ajax({
        url: companiesUrl + '/' + id + '/mark-as-featured',
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

$(document).on('click', '.adminUnFeatured', function (event) {
    let companyId = $(event.currentTarget).data('id');
    makeUnFeatured(companyId);
});

window.makeUnFeatured = function (id) {
    $.ajax({
        url: companiesUrl + '/' + id + '/mark-as-unfeatured',
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

$(document).on('click', '.delete-btn', function (event) {
    let companyId = $(event.currentTarget).data('id');
    deleteItem(companiesUrl + '/' + companyId, tableName, 'Employer');
});

$(document).on('change', '.isFeatured', function (event) {
    let companyId = $(event.currentTarget).data('id');
    activeIsFeatured(companyId);
});

$(document).on('change', '.isActive', function (event) {
    let companyId = $(event.currentTarget).data('id');
    changeIsActive(companyId);
});

window.changeIsActive = function (id) {
    $.ajax({
        url: companiesUrl + '/' + id + '/change-is-active',
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
};

