/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, { enumerable: true, get: getter });
/******/ 		}
/******/ 	};
/******/
/******/ 	// define __esModule on exports
/******/ 	__webpack_require__.r = function(exports) {
/******/ 		if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 			Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 		}
/******/ 		Object.defineProperty(exports, '__esModule', { value: true });
/******/ 	};
/******/
/******/ 	// create a fake namespace object
/******/ 	// mode & 1: value is a module id, require it
/******/ 	// mode & 2: merge all properties of value into the ns
/******/ 	// mode & 4: return value when already ns object
/******/ 	// mode & 8|1: behave like require
/******/ 	__webpack_require__.t = function(value, mode) {
/******/ 		if(mode & 1) value = __webpack_require__(value);
/******/ 		if(mode & 8) return value;
/******/ 		if((mode & 4) && typeof value === 'object' && value && value.__esModule) return value;
/******/ 		var ns = Object.create(null);
/******/ 		__webpack_require__.r(ns);
/******/ 		Object.defineProperty(ns, 'default', { enumerable: true, value: value });
/******/ 		if(mode & 2 && typeof value != 'string') for(var key in value) __webpack_require__.d(ns, key, function(key) { return value[key]; }.bind(null, key));
/******/ 		return ns;
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "/";
/******/
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 35);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/assets/js/candidates/candidate-profile/candidate_career_informations.js":
/*!*******************************************************************************************!*\
  !*** ./resources/assets/js/candidates/candidate-profile/candidate_career_informations.js ***!
  \*******************************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


$(document).ready(function () {
  $('#countryId, #stateId, #cityId, #educationCountryId, #educationStateId, #educationCityId, #editCountry, #editState, #editCity, #degreeLevelId, #editEducationCountry, #editEducationState, #editEducationCity').select2({
    'width': '100%'
  });
  $('#addExperienceModal').on('shown.bs.modal', function () {
    setDatePicker('#startDate', '#endDate');
  });
  $('#editExperienceModal').on('shown.bs.modal', function () {
    setDatePicker('#editStartDate', '#editEndDate');
  });

  window.setDatePicker = function (startDate, endDate) {
    $(startDate).datetimepicker(DatetimepickerDefaults({
      format: 'YYYY-MM-DD',
      useCurrent: true,
      sideBySide: true,
      maxDate: new moment()
    }));
    $(endDate).datetimepicker(DatetimepickerDefaults({
      format: 'YYYY-MM-DD',
      sideBySide: true,
      maxDate: new moment(),
      useCurrent: false
    }));
  };

  $('#startDate').on('dp.change', function (e) {
    $('#endDate').val('');
    $('#endDate').data('DateTimePicker').minDate(e.date);
  });
  $('#editStartDate').on('dp.change', function (e) {
    setTimeout(function () {
      $('#editEndDate').data('DateTimePicker').minDate(e.date);
    }, 1000);
  });
  $('#default').on('click', function () {
    if ($(this).prop('checked') == true) {
      $('#endDate').prop('disabled', true);
      $('#endDate').val('');
    } else if ($(this).prop('checked') == false) {
      $('#endDate').data('DateTimePicker').minDate($('#startDate').val());
      $('#endDate').prop('disabled', false);
    }
  });
  $('#editWorking').on('click', function () {
    if ($(this).prop('checked') == true) {
      $('#editEndDate').prop('disabled', true);
      $('#editEndDate').val('');
    } else if ($(this).prop('checked') == false) {
      $('#editEndDate').data('DateTimePicker').minDate($('#editStartDate').val());
      $('#editEndDate').prop('disabled', false);
    }
  });
  $('.addExperienceModal').on('click', function () {
    $('#addExperienceModal').appendTo('body').modal('show');
  });
  $('.addEducationModal').on('click', function () {
    $('#addEducationModal').appendTo('body').modal('show');
  });

  window.renderExperienceTemplate = function (experienceArray) {
    var candidateExperienceCount = $('.candidate-experience-container .candidate-experience:last').data('experience-id') != undefined ? $('.candidate-experience-container .candidate-experience:last').data('experience-id') + 1 : 0;
    var template = $.templates('#candidateExperienceTemplate');
    var endDate = experienceArray.currently_working == 1 ? present : moment(experienceArray.end_date, 'YYYY-MM-DD').format('Do MMM, YYYY');
    var data = {
      candidateExperienceNumber: candidateExperienceCount,
      id: experienceArray.id,
      title: experienceArray.experience_title,
      company: experienceArray.company,
      startDate: moment(experienceArray.start_date, 'YYYY-MM-DD').format('Do MMM, YYYY'),
      endDate: endDate,
      description: experienceArray.description,
      country: experienceArray.country
    };
    var stageTemplateHtml = template.render(data);
    $('.candidate-experience-container').append(stageTemplateHtml);
    $('#notfoundExperience').addClass('d-none');
  };

  $(document).on('submit', '#addNewExperienceForm', function (e) {
    e.preventDefault();
    processingBtn('#addNewExperienceForm', '#btnExperienceSave', 'loading');
    $.ajax({
      url: addExperienceUrl,
      type: 'POST',
      data: $(this).serialize(),
      success: function success(result) {
        if (result.success) {
          $('#notfoundExperience').addClass('d-none');
          displaySuccessMessage(result.message);
          $('#addExperienceModal').modal('hide');
          renderExperienceTemplate(result.data);
        }
      },
      error: function error(result) {
        displayErrorMessage(result.responseJSON.message);
      },
      complete: function complete() {
        processingBtn('#addNewExperienceForm', '#btnExperienceSave');
      }
    });
  });
  $(document).on('click', '.edit-experience', function (event) {
    var experienceId = $(event.currentTarget).data('id');
    renderExperienceData(experienceId);
  });

  window.renderExperienceData = function (id) {
    $.ajax({
      url: candidateUrl + id + '/edit-experience',
      type: 'GET',
      success: function success(result) {
        if (result.success) {
          $('#experienceId').val(result.data.id);
          $('#editTitle').val(result.data.experience_title);
          $('#editCompany').val(result.data.company);
          $('#editCountry').val(result.data.country_id).trigger('change', [{
            stateId: result.data.state_id,
            cityId: result.data.city_id
          }]);
          $('#editStartDate').val(moment(result.data.start_date).format('YYYY-MM-DD'));
          $('#editDescription').val(result.data.description);

          if (result.data.currently_working == 1) {
            $('#editWorking').prop('checked', true);
            $('#editEndDate').val('');
          } else {
            $('#editWorking').prop('checked', false);
            $('#editEndDate').val(moment(result.data.end_date).format('YYYY-MM-DD'));
          }

          if (result.data.currently_working == 1) {
            $('#editEndDate').prop('disabled', true);
          }

          $('#editExperienceModal').appendTo('body').modal('show');
        }
      },
      error: function error(result) {
        displayErrorMessage(result.responseJSON.message);
      }
    });
  };

  $(document).on('submit', '#editExperienceForm', function (event) {
    event.preventDefault();
    processingBtn('#editExperienceForm', '#btnEditExperienceSave', 'loading');
    var id = $('#experienceId').val();
    $.ajax({
      url: experienceUrl + id,
      type: 'put',
      data: $(this).serialize(),
      success: function success(result) {
        if (result.success) {
          displaySuccessMessage(result.message);
          $('#editExperienceModal').modal('hide');
          location.reload();
          $('.candidate-experience-container').children('.candidate-experience').each(function () {
            var candidateExperienceId = $(this).attr('data-id');

            if (candidateExperienceId == result.data.id) {
              $(this).remove();
            }
          });
          renderExperienceTemplate(result.data.candidateExperience);
        }
      },
      error: function error(result) {
        displayErrorMessage(result.responseJSON.message);
      },
      complete: function complete() {
        processingBtn('#editExperienceForm', '#btnEditExperienceSave');
      }
    });
  });
  $('#addExperienceModal').on('hidden.bs.modal', function () {
    resetModalForm('#addNewExperienceForm', '#validationErrorsBox');
    $('#countryId, #stateId, #cityId').val('');
    $('#stateId, #cityId').empty();
    $('#countryId').trigger('change.select2');
  });
  $('#addEducationModal').on('hidden.bs.modal', function () {
    resetModalForm('#addNewEducationForm', '#validationErrorsBox');
    $('#educationCountryId, #educationStateId, #educationCityId').val('');
    $('#educationStateId, #educationCityId').empty();
    $('#educationCountryId').trigger('change.select2');
  });
  $(document).on('click', '.delete-experience', function (event) {
    var experienceId = $(event.currentTarget).data('id');
    deleteItem(experienceUrl + experienceId, 'Experience', '.candidate-experience-container', '.candidate-experience', '#notfoundExperience');
  });

  window.renderEducationTemplate = function (educationArray) {
    var candidateEducationCount = $('.candidate-education-container .candidate-education:last').data('education-id') != undefined ? $('.candidate-education-container .candidate-education:last').data('experience-id') + 1 : 0;
    var template = $.templates('#candidateEducationTemplate');
    var data = {
      candidateEducationNumber: candidateEducationCount,
      id: educationArray.id,
      degreeLevel: educationArray.degree_level.name,
      degreeTitle: educationArray.degree_title,
      year: educationArray.year,
      country: educationArray.country,
      institute: educationArray.institute
    };
    var stageTemplateHtml = template.render(data);
    $('.candidate-education-container').append(stageTemplateHtml);
    $('#notfoundEducation').addClass('d-none');
  };

  $(document).on('submit', '#addNewEducationForm', function (e) {
    e.preventDefault();
    processingBtn('#addNewEducationForm', '#btnEducationSave', 'loading');
    $.ajax({
      url: addEducationUrl,
      type: 'POST',
      data: $(this).serialize(),
      success: function success(result) {
        if (result.success) {
          $('#notfoundEducation').addClass('d-none');
          displaySuccessMessage(result.message);
          $('#addEducationModal').modal('hide');
          renderEducationTemplate(result.data);
        }
      },
      error: function error(result) {
        displayErrorMessage(result.responseJSON.message);
      },
      complete: function complete() {
        processingBtn('#addNewEducationForm', '#btnEducationSave');
      }
    });
  });
  $(document).on('click', '.edit-education', function (event) {
    var educationId = $(event.currentTarget).data('id');
    renderEducationData(educationId);
  });

  window.renderEducationData = function (id) {
    $.ajax({
      url: candidateUrl + id + '/edit-education',
      type: 'GET',
      success: function success(result) {
        if (result.success) {
          $('#educationId').val(result.data.id);
          $('#editDegreeLevel').val(result.data.degree_level.id).trigger('change');
          $('#editDegreeTitle').val(result.data.degree_title);
          $('#editEducationCountry').val(result.data.country_id).trigger('change', [{
            stateId: result.data.state_id,
            cityId: result.data.city_id
          }]);
          $('#editInstitute').val(result.data.institute);
          $('#editResult').val(result.data.result);
          $('#editYear').val(result.data.year).trigger('change');
          $('#editEducationModal').appendTo('body').modal('show');
        }
      },
      error: function error(result) {
        displayErrorMessage(result.responseJSON.message);
      }
    });
  };

  $(document).on('submit', '#editEducationForm', function (event) {
    event.preventDefault();
    processingBtn('#editEducationForm', '#btnEditEducationSave', 'loading');
    var id = $('#educationId').val();
    $.ajax({
      url: educationUrl + id,
      type: 'put',
      data: $(this).serialize(),
      success: function success(result) {
        if (result.success) {
          displaySuccessMessage(result.message);
          $('#editEducationModal').modal('hide');
          location.reload();
          $('.candidate-education-container').children('.candidate-education').each(function () {
            var candidateEducationId = $(this).attr('data-id');

            if (candidateEducationId == result.data.id) {
              $(this).remove();
            }
          });
          renderEducationTemplate(result.data.candidateEducation);
        }
      },
      error: function error(result) {
        displayErrorMessage(result.responseJSON.message);
      },
      complete: function complete() {
        processingBtn('#editEducationForm', '#btnEditEducationSave');
      }
    });
  });
  $('#editEducationModal').on('hidden.bs.modal', function () {
    resetModalForm('#addNewEducationForm', '#validationErrorsBox');
  });
  $(document).on('click', '.delete-education', function (event) {
    var educationId = $(event.currentTarget).data('id');
    deleteItem(educationUrl + educationId, 'Education', '.candidate-education-container', '.candidate-education', '#notfoundEducation');
  });

  window.deleteItem = function (url, header, parent, child, selector) {
    swal({
      title: 'Delete !',
      text: 'Are you sure want to delete this "' + header + '" ?',
      type: 'warning',
      showCancelButton: true,
      closeOnConfirm: false,
      showLoaderOnConfirm: true,
      confirmButtonColor: '#6777ef',
      cancelButtonColor: '#d33',
      cancelButtonText: 'No',
      confirmButtonText: 'Yes'
    }, function () {
      deleteItemAjax(url, header, parent, child, selector);
    });
  };

  function deleteItemAjax(url, header, parent, child, selector) {
    $.ajax({
      url: url,
      type: 'DELETE',
      dataType: 'json',
      success: function success(obj) {
        if (obj.success) {
          $(parent).children(child).each(function () {
            var templateId = $(this).attr('data-id');

            if (templateId == obj.data) {
              $(this).remove();
            }
          });

          if ($(parent).children(child).length <= 0) {
            $(selector).removeClass('d-none');
          }
        }

        swal({
          title: 'Deleted!',
          text: header + ' has been deleted.',
          type: 'success',
          confirmButtonColor: '#6777ef',
          timer: 2000
        });
      },
      error: function error(data) {
        swal({
          title: '',
          text: data.responseJSON.message,
          type: 'error',
          confirmButtonColor: '#6777ef',
          timer: 5000
        });
      }
    });
  }

  $('#countryId, #educationCountryId, #editCountry, #editEducationCountry').on('change', function (e, paramData) {
    var modalType = $(this).data('modal-type');
    var modalTypeHasEdit = typeof $(this).data('is-edit') === 'undefined' ? false : true;
    $.ajax({
      url: companyStateUrl,
      type: 'get',
      dataType: 'json',
      data: {
        postal: $(this).val()
      },
      success: function success(data) {
        $(modalType === 'experience' ? !modalTypeHasEdit ? '#stateId' : '#editState' : !modalTypeHasEdit ? '#educationStateId' : '#editEducationState').empty();
        $.each(data.data, function (i, v) {
          $(modalType === 'experience' ? !modalTypeHasEdit ? '#stateId' : '#editState' : !modalTypeHasEdit ? '#educationStateId' : '#editEducationState').append($('<option></option>').attr('value', i).text(v));
        });
        if (modalTypeHasEdit) $(modalType === 'experience' ? '#editState' : '#editEducationState').val(paramData.stateId).trigger('change', [{
          cityId: paramData.cityId
        }]);
      }
    });
  });
  $('#stateId, #educationStateId, #editState, #editEducationState').on('change', function (e, paramData) {
    var modalType = $(this).data('modal-type');
    var modalTypeHasEdit = typeof $(this).data('is-edit') === 'undefined' ? false : true;
    $.ajax({
      url: companyCityUrl,
      type: 'get',
      dataType: 'json',
      data: {
        state: $(this).val(),
        country: $(modalType === 'experience' ? !modalTypeHasEdit ? '#countryId' : '#editCountry' : !modalTypeHasEdit ? '#educationCountryId' : '#editEducationCountry').val()
      },
      success: function success(data) {
        $(modalType === 'experience' ? !modalTypeHasEdit ? '#cityId' : '#editCity' : !modalTypeHasEdit ? '#educationCityId' : '#editEducationCity').empty();
        $.each(data.data, function (i, v) {
          $(modalType === 'experience' ? !modalTypeHasEdit ? '#cityId' : '#editCity' : !modalTypeHasEdit ? '#educationCityId' : '#editEducationCity').append($('<option></option>').attr('value', i).text(v));
        });
        if (modalTypeHasEdit) $(modalType === 'experience' ? '#editCity' : '#editEducationCity').val(typeof paramData !== 'undefined' ? paramData.cityId : '').trigger('change.select2');
      }
    });
  });
});

/***/ }),

/***/ 35:
/*!*************************************************************************************************!*\
  !*** multi ./resources/assets/js/candidates/candidate-profile/candidate_career_informations.js ***!
  \*************************************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! /Applications/MAMP/htdocs/InfyOm Product/infy-jobs/resources/assets/js/candidates/candidate-profile/candidate_career_informations.js */"./resources/assets/js/candidates/candidate-profile/candidate_career_informations.js");


/***/ })

/******/ });