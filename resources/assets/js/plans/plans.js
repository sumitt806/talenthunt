'use strict';

let tableName = '#plansTbl';
$(tableName).DataTable({
    processing: true,
    serverSide: true,
    ajax: {
        url: planUrl,
    },
    columnDefs: [
        {
            'targets': [1],
            'className': 'text-right',
        },
        {
            'targets': [2],
            'className': 'text-right',
        },
        {
            'targets': [3],
            'className': 'text-center',
            'width': '12%',
        },
        {
            'targets': [4],
            'orderable': false,
            'className': 'text-center',
            'width': '8%',
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
                return row;
            },
            render: function (row) {
                if (row.name.length < 60) {
                    return row.name;
                }
                return '<span data-toggle="tooltip" title="' +
                    row.name + '">' +
                    row.name.substr(0, 60).concat('...') + '</span>';
            },
            name: 'name',
        },
        {
            data: function (row) {
                return row
            },
            render: function (row) {
                return row.allowed_jobs
            },
            name: 'allowed_jobs',
        },
        {
            data: function (row) {
                return row;
            },
            render: function (row) {
                return currency(row.amount, { precision: 0 }).format();
            },
            name: 'amount',
        },
        {
            data: 'active_subscriptions_count',
            name: 'id',
        },
        {
            data: function (row) {
                let data = [
                    {
                        'trial': row.is_trial_plan == 1,
                    }];
                return prepareTemplateRender('#trialSwitch', data);
            }, name: 'id',
        },
        {
            data: function (row) {
                let isDisabledDelete = (row.active_subscriptions_count > 0)
                    ? 'disabled'
                    : '';
                let data = [
                    {
                        'id': row.id,
                        'trial': row.is_trial_plan == 1,
                        'isDisabledDelete': isDisabledDelete,
                    }];
                return prepareTemplateRender('#planActionTemplate',
                    data);
            }, name: 'id',
        },
    ],
});

$('.addPlanModal').click(function () {
    $('#addModal').appendTo('body').modal('show');
});

$(document).on('keyup', '.amount', function () {
    let amount = $(this).val();
    if (parseInt(amount) <= 0) {
        $(this).val('1');
        return true;
    }
    $(this).val().
        replace(/,/g, '').
        replace(/[^0-9.]/g, '').
        replace(/(\..*)\./g, '$1');
    $(this).val(currency(amount, { precision: 0 }).format());
});

$(document).on('submit', '#addNewForm', function (e) {
    e.preventDefault();
    processingBtn('#addNewForm', '#btnSave', 'loading');
    e.preventDefault();
    $.ajax({
        url: planSaveUrl,
        type: 'POST',
        data: $(this).serialize(),
        success: function (result) {
            if (result.success) {
                displaySuccessMessage(result.message);
                $('#addModal').modal('hide');
                $(tableName).DataTable().ajax.reload(null, false);
            }
        },
        error: function (result) {
            displayErrorMessage(result.responseJSON.message);
        },
        complete: function () {
            processingBtn('#addNewForm', '#btnSave');
        },
    });
});

$(document).on('click', '.edit-btn', function (event) {
    let planId = $(event.currentTarget).data('id');
    renderData(planId);
});

window.renderData = function (id) {
    $.ajax({
        url: planUrl + '/' + id + '/edit',
        type: 'GET',
        success: function (result) {
            if (result.success) {
                $('#planId').val(result.data.id);
                $('#editName').val(result.data.name);
                $('#editAllowedJobs').val(result.data.allowed_jobs);
                $('#editAmount').val(result.data.amount).trigger('keyup');
                $('#editModal').appendTo('body').modal('show');
            }
        },
        error: function (result) {
            displayErrorMessage(result.responseJSON.message);
        },
    });
};

$(document).on('submit', '#editForm', function (event) {
    event.preventDefault();
    processingBtn('#editForm', '#btnEditSave', 'loading');
    var id = $('#planId ').val();
    $.ajax({
        url: planUrl + "/" + id,
        type: 'put',
        data: $(this).serialize(),
        success: function (result) {
            if (result.success) {
                displaySuccessMessage(result.message);
                $('#editModal').modal('hide');
                $(tableName).DataTable().ajax.reload(null, false);
            }
        },
        error: function (result) {
            displayErrorMessage(result.responseJSON.message);
        },
        complete: function () {
            processingBtn('#editForm', '#btnEditSave');
        },
    });
});

$(document).on('click', '.delete-btn', function (event) {
    let planId = $(event.currentTarget).data('id');
    deleteItem(planUrl + '/' + planId, tableName, 'Plan');
});

$('#addModal').on('hidden.bs.modal', function () {
    resetModalForm('#addNewForm', '#validationErrorsBox');
});

$('#editModal').on('hidden.bs.modal', function () {
    resetModalForm('#editForm', '#editValidationErrorsBox');
});

$('#addModal').on('shown.bs.modal', function () {
    $('#name').focus();
});

$('#editModal').on('shown.bs.modal', function () {
    $('#editName').focus();
});


