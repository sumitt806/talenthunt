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
/******/ 	return __webpack_require__(__webpack_require__.s = 13);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/assets/js/companies/companies.js":
/*!****************************************************!*\
  !*** ./resources/assets/js/companies/companies.js ***!
  \****************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


var tableName = '#companiesTbl';
$(tableName).DataTable({
  processing: true,
  serverSide: true,
  'order': [[1, 'asc']],
  ajax: {
    url: companiesUrl,
    data: function data(_data) {
      _data.is_featured = $('#filter_featured').find('option:selected').val();
      _data.is_status = $('#filter_status').find('option:selected').val();
    }
  },
  columnDefs: [{
    'targets': [0],
    'orderable': false,
    'className': 'text-center',
    'width': '5%'
  }, {
    'targets': [3],
    'orderable': false,
    'className': 'text-center',
    'width': '5%'
  }, {
    'targets': [4],
    'orderable': false,
    'className': 'text-center',
    'width': '9%'
  }, {
    'targets': [5],
    'orderable': false,
    'className': 'text-center',
    'width': '8%'
  }],
  columns: [{
    data: function data(row) {
      return '<img src="' + row.company_url + '" class="rounded-circle thumbnail-rounded"' + '</img>';
    },
    name: 'user.last_name'
  }, {
    data: function data(row) {
      return '<a href="' + companiesUrl + '/' + row.id + '">' + row.user.first_name + '</a>';
    },
    name: 'user.first_name'
  }, {
    data: 'user.email',
    name: 'user.email'
  }, {
    data: function data(row) {
      var checked = row.user.is_active === 0 ? '' : 'checked';
      var data = [{
        'id': row.id,
        'checked': checked
      }];
      return prepareTemplateRender('#isActive', data);
    },
    name: 'user.is_active'
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
    name: 'is_featured'
  }, {
    data: function data(row) {
      var url = companiesUrl + '/' + row.id;
      var data = [{
        'id': row.id,
        'url': url + '/edit'
      }];
      return prepareTemplateRender('#companyActionTemplate', data);
    },
    name: 'id'
  }],
  'fnInitComplete': function fnInitComplete() {
    $('#filter_featured,#filter_status').change(function () {
      $(tableName).DataTable().ajax.reload(null, true);
    });
  }
});
$(document).ready(function () {
  $('#filter_featured').select2({
    width: '170px'
  });
  $('#filter_status').select2();
});
$(document).on('click', '.adminMakeFeatured', function (event) {
  var companyId = $(event.currentTarget).data('id');
  makeFeatured(companyId);
});

window.makeFeatured = function (id) {
  $.ajax({
    url: companiesUrl + '/' + id + '/mark-as-featured',
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

$(document).on('click', '.adminUnFeatured', function (event) {
  var companyId = $(event.currentTarget).data('id');
  makeUnFeatured(companyId);
});

window.makeUnFeatured = function (id) {
  $.ajax({
    url: companiesUrl + '/' + id + '/mark-as-unfeatured',
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

$(document).on('click', '.delete-btn', function (event) {
  var companyId = $(event.currentTarget).data('id');
  deleteItem(companiesUrl + '/' + companyId, tableName, 'Employer');
});
$(document).on('change', '.isFeatured', function (event) {
  var companyId = $(event.currentTarget).data('id');
  activeIsFeatured(companyId);
});
$(document).on('change', '.isActive', function (event) {
  var companyId = $(event.currentTarget).data('id');
  changeIsActive(companyId);
});

window.changeIsActive = function (id) {
  $.ajax({
    url: companiesUrl + '/' + id + '/change-is-active',
    method: 'post',
    cache: false,
    success: function success(result) {
      if (result.success) {
        $(tableName).DataTable().ajax.reload(null, false);
      }
    },
    error: function error(result) {
      displayErrorMessage(result.responseJSON.message);
    }
  });
};

/***/ }),

/***/ 13:
/*!**********************************************************!*\
  !*** multi ./resources/assets/js/companies/companies.js ***!
  \**********************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! /Applications/MAMP/htdocs/InfyOm Product/infy-jobs/resources/assets/js/companies/companies.js */"./resources/assets/js/companies/companies.js");


/***/ })

/******/ });