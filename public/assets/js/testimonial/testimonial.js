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
/******/ 	return __webpack_require__(__webpack_require__.s = 37);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/assets/js/testimonial/testimonial.js":
/*!********************************************************!*\
  !*** ./resources/assets/js/testimonial/testimonial.js ***!
  \********************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

$(document).ready(function () {
  'use strict';

  var tableName = '#testimonialTbl';
  $(tableName).DataTable({
    scrollX: true,
    deferRender: true,
    scroller: true,
    processing: true,
    serverSide: true,
    'order': [[1, 'asc']],
    ajax: {
      url: testimonialUrl
    },
    columnDefs: [{
      'targets': [0],
      'width': '8%',
      'orderable': false,
      'className': 'text-center'
    }, {
      'targets': [2],
      'width': '8%',
      'orderable': false,
      'className': 'text-center'
    }, {
      'targets': [3],
      'orderable': false,
      'className': 'text-center',
      'width': '8%'
    }],
    columns: [{
      data: function data(row) {
        return '<img src="' + row.customer_image_url + '" class="rounded-circle thumbnail-rounded"' + '</img>';
      },
      name: 'customer_name'
    }, {
      data: function data(row) {
        return '<a href="#" class="show-btn" data-id="' + row.id + '">' + row.customer_name + '</a>';
      },
      name: 'customer_name'
    }, {
      data: function data(row) {
        if (isEmpty(row.customer_image_url)) {
          return 'N/A';
        } else {
          return '<a  href="download-image/' + row.id + '">' + 'Download' + '</a>';
        }
      },
      name: 'customer_name'
    }, {
      data: function data(row) {
        var data = [{
          'id': row.id
        }];
        return prepareTemplateRender('#testimonialActionTemplate', data);
      },
      name: 'id'
    }]
  });
  $(document).on('submit', '#addNewForm', function (e) {
    e.preventDefault();

    if ($('#description').summernote('isEmpty')) {
      displayErrorMessage('description field is required.');
      return false;
    }

    processingBtn('#addNewForm', '#btnSave', 'loading');
    $.ajax({
      url: testimonialSaveUrl,
      type: 'POST',
      data: new FormData(this),
      dataType: 'JSON',
      processData: false,
      contentType: false,
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
    var testimonialId = $(event.currentTarget).data('id');
    renderData(testimonialId);
  });

  window.renderData = function (id) {
    $.ajax({
      url: testimonialUrl + id + '/edit',
      type: 'GET',
      success: function success(result) {
        if (result.success) {
          $('#testimonialId').val(result.data.id);
          $('#editCustomerName').val(result.data.customer_name);

          if (isEmpty(result.data.customer_image_url)) {
            $('#editPreviewImage').attr('src', defaultDocumentImageUrl);
          } else {
            $('#editPreviewImage').attr('src', result.data.customer_image_url);
          }

          $('#editDescription').summernote('code', result.data.description);
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

    if ($('#editDescription').summernote('isEmpty')) {
      displayErrorMessage('description field is required.');
      return false;
    }

    processingBtn('#editForm', '#btnEditSave', 'loading');
    var id = $('#testimonialId').val();
    $.ajax({
      url: testimonialUrl + id + '/update',
      type: 'POST',
      data: new FormData($(this)[0]),
      dataType: 'JSON',
      processData: false,
      contentType: false,
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
    var testimonialId = $(event.currentTarget).data('id');
    $.ajax({
      url: testimonialUrl + testimonialId,
      type: 'GET',
      success: function success(result) {
        console.log(result.data);

        if (result.success) {
          $('#showCustomerName').html('');
          $('#showDescription').html('');
          $('#documentUrl').html('');
          $('#showCustomerName').append(result.data.customer_name);

          if (isEmpty(result.data.customer_image_url)) {
            $('#documentUrl').hide();
            $('#noDocument').show();
          } else {
            $('#noDocument').hide();
            $('#documentUrl').show();
            $('#documentUrl').attr('src', result.data.customer_image_url);
          }

          var element = document.createElement('textarea');
          element.innerHTML = !isEmpty(result.data.description) ? result.data.description : 'N/A';
          $('#showDescription').append(element.value);
          $('#showModal').appendTo('body').modal('show');
        }
      },
      error: function error(result) {
        displayErrorMessage(result.responseJSON.message);
      }
    });
  });
  $(document).on('click', '.addTestimonialModal', function () {
    $('#addModal').appendTo('body').modal('show');
  });
  $(document).on('click', '.delete-btn', function (event) {
    var testimonialId = $(event.currentTarget).data('id');
    deleteItem(testimonialUrl + testimonialId, tableName, 'Testimonial');
  });
  $('#addModal').on('hidden.bs.modal', function () {
    resetModalForm('#addNewForm', '#validationErrorsBox');
    $('#description').summernote('code', '');
    $('#previewImage').attr('src', defaultDocumentImageUrl);
  });
  $('#description, #editDescription').summernote({
    minHeight: 200,
    toolbar: [['style', ['bold', 'italic', 'underline', 'clear']], ['font', ['strikethrough']], ['para', ['paragraph']]]
  });
  $(document).on('change', '#customerImage', function () {
    if (isValidFile($(this), '#validationErrorsBox')) {
      displayPhoto(this, '#previewImage');
    }
  });
  $(document).on('change', '#editCustomerImage', function () {
    if (isValidFile($(this), '#validationErrorsBox')) {
      displayPhoto(this, '#editPreviewImage');
    }
  });
});

/***/ }),

/***/ 37:
/*!**************************************************************!*\
  !*** multi ./resources/assets/js/testimonial/testimonial.js ***!
  \**************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! /Applications/MAMP/htdocs/InfyOm Product/infy-jobs/resources/assets/js/testimonial/testimonial.js */"./resources/assets/js/testimonial/testimonial.js");


/***/ })

/******/ });