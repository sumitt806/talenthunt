'use strict';
$(document).on('submit', '#addCandidateNewForm', function (e) {
    e.preventDefault();
    processingBtn('#addCandidateNewForm', '#btnCandidateSave', 'loading');
    $.ajax({
        url: registerSaveUrl,
        type: 'POST',
        data: $(this).serialize(),
        success: function (result) {
            if (result.success) {
                displaySuccessMessage(result.message);
                setTimeout(function () {
                    window.location = logInUrl;
                }, 1500);
            }
        },
        error: function (result) {
            displayErrorMessage(result.responseJSON.message);
        },
        complete: function () {
            processingBtn('#addCandidateNewForm', '#btnCandidateSave');
        },
    });
});

$(document).on('submit', '#addEmployerNewForm', function (e) {
    e.preventDefault();
    processingBtn('#addEmployerNewForm', '#btnEmployerSave', 'loading');
    $.ajax({
        url: registerSaveUrl,
        type: 'POST',
        data: $(this).serialize(),
        success: function (result) {
            if (result.success) {
                displaySuccessMessage(result.message);
                setTimeout(function () {
                    window.location = logInUrl;
                }, 1500);
            }
        },
        error: function (result) {
            displayErrorMessage(result.responseJSON.message);
        },
        complete: function () {
            processingBtn('#addEmployerNewForm', '#btnEmployerSave');
        },
    });
});
