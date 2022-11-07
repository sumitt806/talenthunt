'use strict';

$(document).on('submit', '#newsLetterForm', function (event) {
    event.preventDefault();
    let loadingButton = jQuery(this).find('#btnLetterSave');
    loadingButton.button('loading');
    $.ajax({
        url: createNewLetterUrl,
        type: 'post',
        data: new FormData($(this)[0]),
        processData: false,
        contentType: false,
        success: function (result) {
            displaySuccessMessage(result.message);
        },
        error: function (result) {
            displayErrorMessage(result.responseJSON.message);
        },
        complete: function () {
            $('#mc-email').val('');
            loadingButton.button('reset');
        },
    });
});
