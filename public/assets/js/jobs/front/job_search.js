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
/******/ 	return __webpack_require__(__webpack_require__.s = 25);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/assets/js/jobs/front/job_search.js":
/*!******************************************************!*\
  !*** ./resources/assets/js/jobs/front/job_search.js ***!
  \******************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

$(document).ready(function () {
  var salaryFromSlider = $('#salaryFrom');
  var salaryToSlider = $('#salaryTo');
  $(document).on('change', '.jobType', function () {
    var jobType = [];
    $('input:checkbox[name=job-type]:checked').each(function () {
      jobType.push($(this).val());
    });

    if (jobType.length > 0) {
      window.livewire.emit('changeFilter', 'types', jobType);
    } else {
      window.livewire.emit('resetFilter');
    }
  });
  salaryFromSlider.ionRangeSlider({
    type: 'single',
    min: 0,
    step: 100,
    max: 150000,
    max_postfix: '+',
    skin: 'round',
    onFinish: function onFinish(data) {
      window.livewire.emit('changeFilter', 'salaryFrom', data.from);
    }
  });
  salaryToSlider.ionRangeSlider({
    type: 'single',
    min: 0,
    step: 100,
    max: 150000,
    max_postfix: '+',
    skin: 'round',
    onFinish: function onFinish(data) {
      window.livewire.emit('changeFilter', 'salaryTo', data.from);
    }
  });
  $('#searchCategories').on('change', function () {
    window.livewire.emit('changeFilter', 'category', $(this).val());
  });
  $('#searchSkill').on('change', function () {
    window.livewire.emit('changeFilter', 'skill', $(this).val());
  });
  $('#searchGender').on('change', function () {
    window.livewire.emit('changeFilter', 'gender', $(this).val());
  });
  $('#searchCareerLevel').on('change', function () {
    window.livewire.emit('changeFilter', 'careerLevel', $(this).val());
  });
  $('#searchFunctionalArea').on('change', function () {
    window.livewire.emit('changeFilter', 'functionalArea', $(this).val());
  });

  if (input.location != '') {
    $('#searchByLocation').val(input.location);
    window.livewire.emit('changeFilter', 'searchByLocation', input.location);
  }

  if (input.keywords != '') {
    window.livewire.emit('changeFilter', 'title', input.keywords);
  }

  $(document).on('click', '.reset-filter', function () {
    window.livewire.emit('resetFilter');
    salaryFromSlider.data('ionRangeSlider').update({
      from: 0,
      to: 0
    });
    salaryToSlider.data('ionRangeSlider').update({
      from: 0,
      to: 0
    });
    $('#searchFunctionalArea').val('default').selectpicker('refresh');
    $('#searchCareerLevel').val('default').selectpicker('refresh');
    $('#searchGender').val('default').selectpicker('refresh');
    $('#searchSkill').val('default').selectpicker('refresh');
    $('#searchCategories').val('default').selectpicker('refresh');
    $('.jobType').each(function () {
      $(this).prop('checked', false);
    });
  });
});

/***/ }),

/***/ 25:
/*!************************************************************!*\
  !*** multi ./resources/assets/js/jobs/front/job_search.js ***!
  \************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! /Applications/MAMP/htdocs/InfyOm Product/infy-jobs/resources/assets/js/jobs/front/job_search.js */"./resources/assets/js/jobs/front/job_search.js");


/***/ })

/******/ });