$(document).ready(function () {
    'use strict';

    $('#locationId,#industryId,#ownershipTypeId,#companySizeId,#countryId,#stateId,#cityId,#establishedIn').
        select2({
            width: '100%',
        });

    $('#details').summernote({
        minHeight: 200,
        toolbar: [
            ['style', ['bold', 'italic', 'underline', 'clear']],
            ['font', ['strikethrough']],
            ['para', ['paragraph']]],
    });

    $('#editDetails').summernote({
        minHeight: 200,
        toolbar: [
            ['style', ['bold', 'italic', 'underline', 'clear']],
            ['font', ['strikethrough']],
            ['para', ['paragraph']]],
    });

    $('#countryId').on('change', function () {
        $.ajax({
            url: companyStateUrl,
            type: 'get',
            dataType: 'json',
            data: { postal: $(this).val() },
            success: function (data) {
                $('#stateId').empty();
                $('#stateId').
                    append(
                        $('<option value=""></option>').text('Select State'));
                $.each(data.data, function (i, v) {
                    $('#stateId').
                        append($('<option></option>').attr('value', i).text(v));
                });
                if (isEdit && stateId) {
                    $('#stateId').val(stateId).trigger('change');
                }
            },
        });
    });

    $('#stateId').on('change', function () {
        $.ajax({
            url: companyCityUrl,
            type: 'get',
            dataType: 'json',
            data: {
                state: $(this).val(),
                country: $('#countryId').val(),
            },
            success: function (data) {
                $('#cityId').empty();
                $.each(data.data, function (i, v) {
                    $('#cityId').
                        append(
                            $('<option ></option>').attr('value', i).text(v));
                });
                if (isEdit && cityId) {
                    $('#cityId').val(cityId).trigger('change');
                }
            },
        });
    });
    if (isEdit & countryId) {
        $('#countryId').val(countryId).trigger('change');
    }

    $(document).on('change', '#logo', function () {
        let validFile = isValidFile($(this), '#validationErrorsBox');
        if (validFile) {
            displayPhoto(this, '#logoPreview');
            $('#btnSave').prop('disabled', false);
        } else {
            $('#btnSave').prop('disabled', true);
        }
    });

    $(document).on('submit', '#addCompanyForm', function (e) {
        $('#btnSave').prop('disabled', true);
        if ($('#details').summernote('isEmpty')) {
            displayErrorMessage('Employer Details field is required.');
            e.preventDefault();
            $('#btnSave').attr('disabled', false);
            return false;
        }
    });

    $(document).on('submit', '#editCompanyForm', function (e) {
        $('#btnSave').prop('disabled', true);
        if ($('#editDetails').summernote('isEmpty')) {
            displayErrorMessage('Employer Details field is required.');
            e.preventDefault();
            $('#btnSave').attr('disabled', false);
            return false;
        }
    });
});
