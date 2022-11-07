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
/******/ 	return __webpack_require__(__webpack_require__.s = 59);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/assets/js/plans/plans.js":
/*!********************************************!*\
  !*** ./resources/assets/js/plans/plans.js ***!
  \********************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


var tableName = '#plansTbl';
$(tableName).DataTable({
  processing: true,
  serverSide: true,
  ajax: {
    url: planUrl
  },
  columnDefs: [{
    'targets': [1],
    'className': 'text-right'
  }, {
    'targets': [2],
    'className': 'text-right'
  }, {
    'targets': [3],
    'className': 'text-center',
    'width': '12%'
  }, {
    'targets': [4],
    'orderable': false,
    'className': 'text-center',
    'width': '8%'
  }, {
    'targets': [5],
    'orderable': false,
    'className': 'text-center',
    'width': '8%'
  }],
  columns: [{
    data: function data(row) {
      return row;
    },
    render: function render(row) {
      if (row.name.length < 60) {
        return row.name;
      }

      return '<span data-toggle="tooltip" title="' + row.name + '">' + row.name.substr(0, 60).concat('...') + '</span>';
    },
    name: 'name'
  }, {
    data: function data(row) {
      return row;
    },
    render: function render(row) {
      return row.allowed_jobs;
    },
    name: 'allowed_jobs'
  }, {
    data: function data(row) {
      return row;
    },
    render: function render(row) {
      return currency(row.amount, {
        precision: 0
      }).format();
    },
    name: 'amount'
  }, {
    data: 'active_subscriptions_count',
    name: 'id'
  }, {
    data: function data(row) {
      var data = [{
        'trial': row.is_trial_plan == 1
      }];
      return prepareTemplateRender('#trialSwitch', data);
    },
    name: 'id'
  }, {
    data: function data(row) {
      var isDisabledDelete = row.active_subscriptions_count > 0 ? 'disabled' : '';
      var data = [{
        'id': row.id,
        'trial': row.is_trial_plan == 1,
        'isDisabledDelete': isDisabledDelete
      }];
      return prepareTemplateRender('#planActionTemplate', data);
    },
    name: 'id'
  }]
});
$('.addPlanModal').click(function () {
  $('#addModal').appendTo('body').modal('show');
});
$(document).on('keyup', '.amount', function () {
  var amount = $(this).val();

  if (parseInt(amount) <= 0) {
    $(this).val('1');
    return true;
  }

  $(this).val().replace(/,/g, '').replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');
  $(this).val(currency(amount, {
    precision: 0
  }).format());
});
$(document).on('submit', '#addNewForm', function (e) {
  e.preventDefault();
  processingBtn('#addNewForm', '#btnSave', 'loading');
  e.preventDefault();
  $.ajax({
    url: planSaveUrl,
    type: 'POST',
    data: $(this).serialize(),
    success: function success(result) {
      if (result.success) {
        displaySuccessMessage(result.message);
        $('#addModal').modal('hide');
        $(tableName).DataTable().ajax.reload(null, false);
      }
    },
    error: function error(result) {
      displayErrorMessage(result.responseJSON.message);
    },
    complete: function complete() {
      processingBtn('#addNewForm', '#btnSave');
    }
  });
});
$(document).on('click', '.edit-btn', function (event) {
  var planId = $(event.currentTarget).data('id');
  renderData(planId);
});

window.renderData = function (id) {
  $.ajax({
    url: planUrl + '/' + id + '/edit',
    type: 'GET',
    success: function success(result) {
      if (result.success) {
        $('#planId').val(result.data.id);
        $('#editName').val(result.data.name);
        $('#editAllowedJobs').val(result.data.allowed_jobs);
        $('#editAmount').val(result.data.amount).trigger('keyup');
        $('#editModal').appendTo('body').modal('show');
      }
    },
    error: function error(result) {
      displayErrorMessage(result.responseJSON.message);
    }
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
    success: function success(result) {
      if (result.success) {
        displaySuccessMessage(result.message);
        $('#editModal').modal('hide');
        $(tableName).DataTable().ajax.reload(null, false);
      }
    },
    error: function error(result) {
      displayErrorMessage(result.responseJSON.message);
    },
    complete: function complete() {
      processingBtn('#editForm', '#btnEditSave');
    }
  });
});
$(document).on('click', '.delete-btn', function (event) {
  var planId = $(event.currentTarget).data('id');
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

/***/ }),

/***/ 59:
/*!**************************************************!*\
  !*** multi ./resources/assets/js/plans/plans.js ***!
  \**************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! /Applications/MAMP/htdocs/InfyOm Product/infy-jobs/resources/assets/js/plans/plans.js */"./resources/assets/js/plans/plans.js");


/***/ })

/******/ });