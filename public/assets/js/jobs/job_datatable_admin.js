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
/******/ 	return __webpack_require__(__webpack_require__.s = 24);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/assets/js/jobs/job_datatable_admin.js":
/*!*********************************************************!*\
  !*** ./resources/assets/js/jobs/job_datatable_admin.js ***!
  \*********************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

$(document).ready(function () {
  'use strict';

  $('#filter_featured').select2({
    width: '180px'
  });
  $('#filter_suspended').select2({
    width: '200px'
  });
});
var tableName = '#jobsTbl';
$(tableName).DataTable({
  processing: true,
  serverSide: true,
  'order': [[0, 'asc']],
  ajax: {
    url: jobsUrl,
    data: function data(_data) {
      _data.is_featured = $('#filter_featured').find('option:selected').val();
      _data.is_suspended = $('#filter_suspended').find('option:selected').val();
    }
  },
  columnDefs: [{
    'targets': [3],
    'orderable': false,
    'className': 'text-center',
    'width': '9%'
  }, {
    'targets': [4],
    'orderable': false,
    'className': 'text-center',
    'width': '11%'
  }, {
    'targets': [2],
    'width': '15%'
  }, {
    'targets': [1],
    'width': '15%'
  }, {
    'targets': [5],
    'orderable': false,
    'className': 'text-center',
    'width': '5%'
  }],
  columns: [{
    data: function data(row) {
      return '<a href="' + jobsUrl + '/' + row.id + '">' + row.job_title + '</a>';
    },
    name: 'job_title'
  }, {
    data: function data(row) {
      return moment(row.created_at, 'YYYY-MM-DD hh:mm:ss').format('Do MMM, YYYY');
    },
    name: 'created_at'
  }, {
    data: function data(row) {
      return moment(row.job_expiry_date, 'YYYY-MM-DD hh:mm:ss').format('Do MMM, YYYY');
    },
    name: 'job_expiry_date'
  }, {
    data: function data(row) {
      var featured = row.active_featured;
      var expiryDate;

      if (featured) {
        expiryDate = moment(featured.end_time).format('YYYY-MM-DD');
      }

      var data = [{
        'id': row.id,
        'featured': featured,
        'expiryDate': expiryDate
      }];
      return prepareTemplateRender('#isFeatured', data);
    },
    name: 'hide_salary'
  }, {
    data: function data(row) {
      var checked = row.is_suspended === false ? '' : 'checked';
      var data = [{
        'id': row.id,
        'checked': checked
      }];
      return prepareTemplateRender('#isSuspended', data);
    },
    name: 'hide_salary'
  }, {
    data: function data(row) {
      var url = jobsUrl + '/' + row.id;
      var data = [{
        'id': row.id,
        'url': url + '/edit'
      }];
      return prepareTemplateRender('#jobActionTemplate', data);
    },
    name: 'id'
  }],
  'fnInitComplete': function fnInitComplete() {
    $('#filter_featured,#filter_suspended').change(function () {
      $(tableName).DataTable().ajax.reload(null, true);
    });
  }
});
$(document).on('click', '.delete-btn', function (event) {
  var jobId = $(event.currentTarget).data('id');
  deleteItem(jobsUrl + '/' + jobId, tableName, 'Job');
});
$(document).on('click', ' .adminJobMakeFeatured ', function (event) {
  var jobId = $(event.currentTarget).data('id');
  jobMakeFeatured(jobId);
});

window.jobMakeFeatured = function (id) {
  $.ajax({
    url: jobsUrl + '/' + id + '/make-job-featured',
    method: 'post',
    cache: false,
    success: function success(result) {
      if (result.success) {
        $(tableName).DataTable().ajax.reload(null, false);
        displaySuccessMessage(result.message);
        $('[data-toggle="tooltip"]').tooltip('hide');
      }
    },
    error: function error(result) {
      displayErrorMessage(result.responseJSON.message);
    }
  });
};

$(document).on('click', ' .adminJobUnFeatured ', function (event) {
  var jobId = $(event.currentTarget).data('id');
  jobMakeUnFeatured(jobId);
});

window.jobMakeUnFeatured = function (id) {
  $.ajax({
    url: jobsUrl + '/' + id + '/make-job-unfeatured',
    method: 'post',
    cache: false,
    success: function success(result) {
      if (result.success) {
        $(tableName).DataTable().ajax.reload(null, false);
        displaySuccessMessage(result.message);
        $('[data-toggle="tooltip"]').tooltip('hide');
      }
    },
    error: function error(result) {
      displayErrorMessage(result.responseJSON.message);
    }
  });
};

$(document).on('change', '.isSuspended', function (event) {
  var jobId = $(event.currentTarget).data('id');
  activeIsSuspended(jobId);
});

window.activeIsSuspended = function (id) {
  $.ajax({
    url: jobsUrl + '/' + id + '/change-is-suspend',
    method: 'post',
    cache: false,
    success: function success(result) {
      if (result.success) {
        $(tableName).DataTable().ajax.reload(null, false);
      }
    }
  });
};

/***/ }),

/***/ 24:
/*!***************************************************************!*\
  !*** multi ./resources/assets/js/jobs/job_datatable_admin.js ***!
  \***************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! /Applications/MAMP/htdocs/InfyOm Product/infy-jobs/resources/assets/js/jobs/job_datatable_admin.js */"./resources/assets/js/jobs/job_datatable_admin.js");


/***/ })

/******/ });