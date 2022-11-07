'use strict';

$(document).ready(function () {
    $(document).on('click', '.subscribe', function () {
        let payloadData = {
            plan_id: $(this).data('id')
        };
        $(this).html('<div class="spinner-border spinner-border-sm" role="status">\n' +
            '                                            <span class="sr-only">Loading...</span>\n' +
            '                                        </div>').addClass('disabled');
        $('subscribe').attr('disabled', true);
        $.post('purchase-subscription', payloadData).done((result) => {
            let sessionId = result.data.sessionId;
            stripe.redirectToCheckout({
                sessionId: sessionId
            }).then(function (result) {
                $(this).html(subscribeText).removeClass('disabled');
                $('.subscribe').attr('disabled', false);
                displayErrorMessage(result.responseJSON.message);
            })
        }).catch(error => {
            $(this).html('Purchase').removeClass('disabled');
            $('.subscribe').attr('disabled', false);
            displayErrorMessage(error.responseJSON.message);
        });
    });

    $(document).on('click', '.subscribe-trial', function () {

        $(this).
            html(
                '<div class="spinner-border spinner-border-sm" role="status">\n' +
                '                                            <span class="sr-only">Loading...</span>\n' +
                '                                        </div>').
            addClass('disabled');
        $('subscribe').attr('disabled', true);
        $.post(purchaseTriaalSubscriptionUrl).done((result) => {
            if (result.data) {
                displaySuccessMessage(result.message);
                location.reload();
            }
            displayErrorMessage(error.responseJSON.message);
        }).catch(error => {
            $(this).html('Purchase').removeClass('disabled');
            $('.subscribe-trial').attr('disabled', false);
            displayErrorMessage(error.responseJSON.message);
        });
    });
});

$('.cancel-subscription').click(function () {
    $('#cancelSubscriptionModal').appendTo('body').modal('show');
});

$(document).on('submit', '#cancelSubscriptionForm', function (e) {
    $(this).find('#btnCancelSave').
        html('<div class="spinner-border spinner-border-sm" role="status">\n' +
            '                                            <span class="sr-only">Loading...</span>\n' +
            '                                        </div>').
        attr('disabled', true);
    e.preventDefault();
    $.ajax({
        url: cancelSubscriptionUrl,
        type: 'POST',
        data: $(this).serialize(),
        success: function (result) {
            if (result.success) {
                displaySuccessMessage(result.message);
                $('#cancelSubscriptionModal').modal('hide');
                location.reload();
            }
        },
        error: function (result) {
            displayErrorMessage(result.responseJSON.message);
        },
        complete: function () {
            $('#btnCancelSave').html('Save').attr('disabled', false);
        },
    });
});
