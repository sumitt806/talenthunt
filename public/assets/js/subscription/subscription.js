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
/******/ 	return __webpack_require__(__webpack_require__.s = 60);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/assets/js/subscription/subscription.js":
/*!**********************************************************!*\
  !*** ./resources/assets/js/subscription/subscription.js ***!
  \**********************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


$(document).ready(function () {
  $(document).on('click', '.subscribe', function () {
    var _this = this;

    var payloadData = {
      plan_id: $(this).data('id')
    };
    $(this).html('<div class="spinner-border spinner-border-sm" role="status">\n' + '                                            <span class="sr-only">Loading...</span>\n' + '                                        </div>').addClass('disabled');
    $('subscribe').attr('disabled', true);
    $.post('purchase-subscription', payloadData).done(function (result) {
      var sessionId = result.data.sessionId;
      stripe.redirectToCheckout({
        sessionId: sessionId
      }).then(function (result) {
        $(this).html(subscribeText).removeClass('disabled');
        $('.subscribe').attr('disabled', false);
        displayErrorMessage(result.responseJSON.message);
      });
    })["catch"](function (error) {
      $(_this).html('Purchase').removeClass('disabled');
      $('.subscribe').attr('disabled', false);
      displayErrorMessage(error.responseJSON.message);
    });
  });
  $(document).on('click', '.subscribe-trial', function () {
    var _this2 = this;

    $(this).html('<div class="spinner-border spinner-border-sm" role="status">\n' + '                                            <span class="sr-only">Loading...</span>\n' + '                                        </div>').addClass('disabled');
    $('subscribe').attr('disabled', true);
    $.post(purchaseTriaalSubscriptionUrl).done(function (result) {
      if (result.data) {
        displaySuccessMessage(result.message);
        location.reload();
      }

      displayErrorMessage(error.responseJSON.message);
    })["catch"](function (error) {
      $(_this2).html('Purchase').removeClass('disabled');
      $('.subscribe-trial').attr('disabled', false);
      displayErrorMessage(error.responseJSON.message);
    });
  });
});
$('.cancel-subscription').click(function () {
  $('#cancelSubscriptionModal').appendTo('body').modal('show');
});
$(document).on('submit', '#cancelSubscriptionForm', function (e) {
  $(this).find('#btnCancelSave').html('<div class="spinner-border spinner-border-sm" role="status">\n' + '                                            <span class="sr-only">Loading...</span>\n' + '                                        </div>').attr('disabled', true);
  e.preventDefault();
  $.ajax({
    url: cancelSubscriptionUrl,
    type: 'POST',
    data: $(this).serialize(),
    success: function success(result) {
      if (result.success) {
        displaySuccessMessage(result.message);
        $('#cancelSubscriptionModal').modal('hide');
        location.reload();
      }
    },
    error: function error(result) {
      displayErrorMessage(result.responseJSON.message);
    },
    complete: function complete() {
      $('#btnCancelSave').html('Save').attr('disabled', false);
    }
  });
});

/***/ }),

/***/ 60:
/*!****************************************************************!*\
  !*** multi ./resources/assets/js/subscription/subscription.js ***!
  \****************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! /Applications/MAMP/htdocs/InfyOm Product/infy-jobs/resources/assets/js/subscription/subscription.js */"./resources/assets/js/subscription/subscription.js");


/***/ })

/******/ });