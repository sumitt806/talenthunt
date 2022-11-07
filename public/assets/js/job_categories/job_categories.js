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
/******/ 	return __webpack_require__(__webpack_require__.s = 3);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/assets/js/job_categories/job_categories.js":
/*!**************************************************************!*\
  !*** ./resources/assets/js/job_categories/job_categories.js ***!
  \**************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


var tableName = '#jobCategoriesTbl';
$(tableName).DataTable({
  scrollX: true,
  deferRender: true,
  scroller: true,
  processing: true,
  serverSide: true,
  'order': [[0, 'asc']],
  ajax: {
    url: jobCategoryUrl,
    data: function data(_data) {
      _data.is_featured = $('#filterFeatured').find('option:selected').val();
    }
  },
  columnDefs: [{
    'targets': [2],
    'orderable': false,
    'className': 'text-center',
    'width': '9%'
  }, {
    'targets': [3],
    'orderable': false,
    'className': 'text-center',
    'width': '8%'
  }, {
    'targets': [1],
    render: function render(data) {
      return data.length > 80 ? data.substr(0, 80) + '...' : data;
    }
  }, {
    'targets': [0],
    'width': '25%'
  }],
  columns: [{
    data: function data(row) {
      return '<a href="#" class="show-btn" data-id="' + row.id + '">' + row.name + '</a>';
    },
    name: 'name'
  }, {
    data: function data(row) {
      if (!isEmpty(row.description)) {
        var element = document.createElement('textarea');
        element.innerHTML = row.description;
        return element.value;
      } else return 'N/A';
    },
    name: 'description'
  }, {
    data: function data(row) {
      var checked = row.is_featured === false ? '' : 'checked';
      var data = [{
        'id': row.id,
        'checked': checked
      }];
      return prepareTemplateRender('#isFeatured', data);
    },
    name: 'is_featured'
  }, {
    data: function data(row) {
      var data = [{
        'id': row.id
      }];
      return prepareTemplateRender('#jobCategoryActionTemplate', data);
    },
    name: 'id'
  }],
  'fnInitComplete': function fnInitComplete() {
    $('#filterFeatured').change(function () {
      $(tableName).DataTable().ajax.reload(null, true);
    });
  }
});
$(document).ready(function () {
  $('#filterFeatured').select2();
});
$(document).on('click', '.addJobCategoryModal', function () {
  $('#addModal').appendTo('body').modal('show');
});
$(document).on('submit', '#addNewForm', function (e) {
  e.preventDefault();
  processingBtn('#addNewForm', '#btnSave', 'loading');
  $.ajax({
    url: jobCategorySaveUrl,
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
  var jobCategoryId = $(event.currentTarget).data('id');
  renderData(jobCategoryId);
});

window.renderData = function (id) {
  $.ajax({
    url: jobCategoryUrl + id + '/edit',
    type: 'GET',
    success: function success(result) {
      if (result.success) {
        $('#jobCategoryId').val(result.data.id);
        $('#editName').val(result.data.name);
        $('#editDescription').summernote('code', result.data.description);
        result.data.is_featured == 1 ? $('#editIsFeatured').prop('checked', true) : $('#editIsFeatured').prop('checked', false);
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
  var id = $('#jobCategoryId').val();
  $.ajax({
    url: jobCategoryUrl + id,
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
$(document).on('click', '.show-btn', function (event) {
  var jobCategoryId = $(event.currentTarget).data('id');
  $.ajax({
    url: jobCategoryUrl + jobCategoryId,
    type: 'GET',
    success: function success(result) {
      if (result.success) {
        $('#showName').html('');
        $('#showDescription').html('');
        $('#showIsFeatured').html('');
        $('#showName').append(result.data.name);
        var element = document.createElement('textarea');
        element.innerHTML = !isEmpty(result.data.description) ? result.data.description : 'N/A';
        $('#showDescription').append(element.value);
        result.data.is_featured == 1 ? $('#showIsFeatured').append('Yes') : $('#showIsFeatured').append('No');
        $('#showModal').appendTo('body').modal('show');
      }
    },
    error: function error(result) {
      displayErrorMessage(result.responseJSON.message);
    }
  });
});
$(document).on('click', '.delete-btn', function (event) {
  var jobCategoryId = $(event.currentTarget).data('id');
  deleteItem(jobCategoryUrl + jobCategoryId, tableName, 'Job Category');
});
$('#addModal').on('hidden.bs.modal', function () {
  resetModalForm('#addNewForm', '#validationErrorsBox');
  $('#description').summernote('code', '');
});
$('#editModal').on('hidden.bs.modal', function () {
  resetModalForm('#editForm', '#editValidationErrorsBox');
});
$(document).on('change', '.isFeatured', function (event) {
  var jobCategoryId = $(event.currentTarget).data('id');
  activeIsFeatured(jobCategoryId);
});

window.activeIsFeatured = function (id) {
  $.ajax({
    url: jobCategoryUrl + id + '/change-status',
    method: 'post',
    cache: false,
    success: function success(result) {
      if (result.success) {
        $(tableName).DataTable().ajax.reload(null, false);
      }
    }
  });
};

$('#description, #editDescription').summernote({
  minHeight: 200,
  toolbar: [['style', ['bold', 'italic', 'underline', 'clear']], ['font', ['strikethrough']], ['para', ['paragraph']]]
});

/***/ }),

/***/ 3:
/*!********************************************************************!*\
  !*** multi ./resources/assets/js/job_categories/job_categories.js ***!
  \********************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! /Applications/MAMP/htdocs/InfyOm Product/infy-jobs/resources/assets/js/job_categories/job_categories.js */"./resources/assets/js/job_categories/job_categories.js");


/***/ })

/******/ });