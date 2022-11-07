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
/******/ 	return __webpack_require__(__webpack_require__.s = 45);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/assets/js/candidate/applied-jobs.js":
/*!*******************************************************!*\
  !*** ./resources/assets/js/candidate/applied-jobs.js ***!
  \*******************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


var tableName = '#appliedJobsTbl';
var rowCount = 0;
$(tableName).DataTable({
  scrollX: true,
  deferRender: true,
  scroller: true,
  processing: true,
  serverSide: true,
  'order': [[0, 'asc']],
  ajax: {
    url: candidateAppliedJobUrl
  },
  columnDefs: [{
    'targets': [1],
    'width': '15%'
  }, {
    'targets': [2],
    'orderable': false,
    'className': 'text-center',
    'width': '5%'
  }, {
    'targets': [3],
    'orderable': false,
    'className': 'text-center',
    'width': '10%'
  }, {
    'targets': [4],
    'visible': false
  }],
  columns: [{
    data: function data(row) {
      return '<a href="' + JobTitleUrl + '/' + row.job.job_id + '" target="_blank">' + row.job.job_title + '</a>';
    },
    name: 'job.job_title'
  }, {
    data: function data(row) {
      return moment(row.created_at, 'YYYY-MM-DD hh:mm:ss').format('Do MMM, YYYY');
    },
    name: 'created_at'
  }, {
    data: function data(row) {
      var statusColor = {
        '0': 'warning',
        '1': 'primary',
        '2': 'danger',
        '3': 'info',
        '4': 'success'
      };
      return '<span style="width:100px" class="badge badge-' + statusColor[row.status] + '">' + statusArray[row.status] + '</span>';
    },
    name: 'status'
  }, {
    data: function data(row) {
      var data = [{
        'id': row.id,
        'isJobDrafted': row.status === 0 ? true : false,
        'showUrl': jobDetailsUrl + '/' + row.job.job_id
      }];
      return prepareTemplateRender('#appliedJobActionTemplate', data);
    },
    name: 'id'
  }, {
    data: 'candidate.user.last_name',
    name: 'candidate.user.last_name'
  }]
});
$(document).on('click', '.delete-btn', function (event) {
  var applyJobId = $(event.currentTarget).data('id');
  deleteItem(candidateAppliedJobUrl + '/' + applyJobId, tableName, 'Apply job');
});
$(document).on('click', '.view-note', function (event) {
  var appliedJobId = $(event.currentTarget).data('id');
  $.ajax({
    url: candidateAppliedJobUrl + '/' + appliedJobId,
    type: 'GET',
    success: function success(result) {
      if (result.success) {
        $('#showNote').html('');
        if (!isEmpty(result.data.notes) ? $('#showNote').append(result.data.notes) : $('#showNote').append('N/A')) $('#showModal').appendTo('body').modal('show');
      }
    },
    error: function error(result) {
      displayErrorMessage(result.responseJSON.message);
    }
  });
});

/***/ }),

/***/ 45:
/*!*************************************************************!*\
  !*** multi ./resources/assets/js/candidate/applied-jobs.js ***!
  \*************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! /Applications/MAMP/htdocs/InfyOm Product/infy-jobs/resources/assets/js/candidate/applied-jobs.js */"./resources/assets/js/candidate/applied-jobs.js");


/***/ })

/******/ });