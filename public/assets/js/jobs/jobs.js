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
/******/ 	return __webpack_require__(__webpack_require__.s = 23);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/assets/js/jobs/jobs.js":
/*!******************************************!*\
  !*** ./resources/assets/js/jobs/jobs.js ***!
  \******************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


var tableName = '#jobsTbl';
$(tableName).DataTable({
  processing: true,
  serverSide: true,
  'order': [[0, 'asc']],
  ajax: {
    url: jobsUrl,
    data: function data(_data) {
      _data.is_featured = $('#filter_featured').find('option:selected').val();
    }
  },
  columnDefs: [{
    'targets': [0],
    'width': '15%'
  }, {
    'targets': [2],
    'className': 'text-right',
    'width': '15%'
  }, {
    'targets': [3],
    'orderable': false,
    'className': 'text-center',
    'width': '14%'
  }, {
    'targets': [4],
    'orderable': false,
    'className': 'text-center',
    'width': '14%'
  }, {
    'targets': [5],
    'orderable': false,
    'className': 'text-center',
    'width': '12%',
    'visible': isFeaturedEnable
  }, {
    'targets': [6],
    'orderable': false,
    'className': 'text-center',
    'width': '12%'
  }, {
    'targets': [7],
    'orderable': false,
    'className': 'text-center',
    'width': '15%'
  }],
  columns: [{
    data: function data(row) {
      return '<a href="' + frontJobDetail + '/' + row.job_id + '" target="_blank">' + row.job_title + '</a>';
    },
    name: 'job_title'
  }, {
    data: function data(row) {
      var currentDate = moment().format('YYYY-MM-DD');
      var expiryDate = moment(row.job_expiry_date).format('YYYY-MM-DD');
      if (currentDate > expiryDate) return '<div class="badge badge-danger">' + moment(row.job_expiry_date, 'YYYY-MM-DD hh:mm:ss').format('Do MMM, YYYY') + '</div>';
      return '<div class="badge badge-primary">' + moment(row.job_expiry_date, 'YYYY-MM-DD hh:mm:ss').format('Do MMM, YYYY') + '</div>';
    },
    name: 'job_expiry_date'
  }, {
    data: function data(row) {
      return '<div class="badge badge-primary">' + +row.applied_jobs.length + '</div>';
    },
    name: 'id'
  }, {
    data: function data(row) {
      var checked = row.is_freelance === false ? '' : 'checked';
      var data = [{
        'id': row.id,
        'checked': checked
      }];
      return prepareTemplateRender('#isFreelance', data);
    },
    name: 'is_freelance'
  }, {
    data: function data(row) {
      var checked = row.hide_salary === false ? '' : 'checked';
      var data = [{
        'id': row.id,
        'checked': checked
      }];
      return prepareTemplateRender('#hideSalary', data);
    },
    name: 'hide_salary'
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
        'expiryDate': expiryDate,
        'isFeaturedAvilabal': isFeaturedAvilabal,
        'isJobLive': row.status == 1 ? true : false
      }];
      return prepareTemplateRender('#feauredJobTemplate', data);
    },
    name: 'hide_salary'
  }, {
    data: function data(row) {
      var isJobClosed = false;

      if (row.status == 2) {
        isJobClosed = true;
      }

      var statusColor = {
        '0': 'dark',
        '1': 'success',
        '2': 'warning',
        '3': 'primary'
      };
      var data = [{
        'status': statusArray[row.status],
        'statusColor': statusColor[row.status],
        'isJobClosed': isJobClosed,
        'id': row.id
      }];
      return prepareTemplateRender('#jobStatusActionTemplate', data);
    },
    name: 'id'
  }, {
    data: function data(row) {
      var url = jobsUrl + '/' + row.id;
      var isJobClosed = false;

      if (row.status == 2) {
        isJobClosed = true;
      }

      var data = [{
        'id': row.id,
        'url': url + '/edit',
        'isJobClosed': isJobClosed,
        'jobApplicationUrl': url + '/applications',
        'jobId': row.job_id
      }];
      return prepareTemplateRender('#jobActionTemplate', data);
    },
    name: 'id'
  }],
  'fnInitComplete': function fnInitComplete() {
    $('#filter_featured').change(function () {
      $(tableName).DataTable().ajax.reload(null, true);
    });
  }
});
$(document).ready(function () {
  $('#filter_featured').select2();
});
$(document).on('click', '.delete-btn', function (event) {
  var jobId = $(event.currentTarget).data('id');
  deleteItem(jobsUrl + '/' + jobId, tableName, 'Job');
});
$(document).on('change', '.isFreelance', function (event) {
  var jobId = $(event.currentTarget).data('id');
  activeIsFreelance(jobId);
});

window.activeIsFreelance = function (id) {
  $.ajax({
    url: jobsUrl + '/' + id + '/change-is-freelance',
    method: 'post',
    cache: false,
    success: function success(result) {
      if (result.success) {
        $(tableName).DataTable().ajax.reload(null, false);
      }
    }
  });
};

$(document).on('change', '.hideSalary', function (event) {
  var jobId = $(event.currentTarget).data('id');
  changeHideSalary(jobId);
});

window.changeHideSalary = function (id) {
  $.ajax({
    url: jobsUrl + '/' + id + '/change-hide-salary',
    method: 'post',
    cache: false,
    success: function success(result) {
      if (result.success) {
        $(tableName).DataTable().ajax.reload(null, false);
      }
    }
  });
};

$(document).on('click', '.change-status', function (event) {
  var jobId = $(this).data('id');
  var jobStatus = statusArray.indexOf($(this).data('option'));
  swal({
    title: 'Attention !',
    text: 'Are you sure want to change the status?',
    type: 'info',
    showCancelButton: true,
    closeOnConfirm: false,
    showLoaderOnConfirm: true,
    confirmButtonColor: '#6777ef',
    cancelButtonColor: '#d33',
    cancelButtonText: 'No',
    confirmButtonText: 'Yes'
  }, function () {
    changeStatus(jobId, jobStatus);
  });
});

window.changeStatus = function (id, jobStatus) {
  $.ajax({
    url: jobStatusUrl + id + '/status/' + jobStatus,
    method: 'get',
    cache: false,
    success: function success(result) {
      if (result.success) {
        $(tableName).DataTable().ajax.reload(null, false);
      }
    },
    error: function error(result) {
      displayErrorMessage(result.responseJSON.message);
    },
    complete: function complete() {
      swal.close();
    }
  });
};

$(document).on('click', '.copy-btn', function (event) {
  var id = $(event.currentTarget).data('job-id');
  var copyUrl = frontJobDetail + '/' + id;
  var $temp = $('<input>');
  $('body').append($temp);
  $temp.val(copyUrl).select();
  document.execCommand('copy');
  $temp.remove();
  displaySuccessMessage('Link Copied Successfully.');
});

/***/ }),

/***/ 23:
/*!************************************************!*\
  !*** multi ./resources/assets/js/jobs/jobs.js ***!
  \************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! /Applications/MAMP/htdocs/InfyOm Product/infy-jobs/resources/assets/js/jobs/jobs.js */"./resources/assets/js/jobs/jobs.js");


/***/ })

/******/ });