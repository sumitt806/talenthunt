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
/******/ 	return __webpack_require__(__webpack_require__.s = 33);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/assets/js/custom/currency.js":
/*!************************************************!*\
  !*** ./resources/assets/js/custom/currency.js ***!
  \************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

var __WEBPACK_AMD_DEFINE_FACTORY__, __WEBPACK_AMD_DEFINE_RESULT__;function _typeof(obj) { "@babel/helpers - typeof"; if (typeof Symbol === "function" && typeof Symbol.iterator === "symbol") { _typeof = function _typeof(obj) { return typeof obj; }; } else { _typeof = function _typeof(obj) { return obj && typeof Symbol === "function" && obj.constructor === Symbol && obj !== Symbol.prototype ? "symbol" : typeof obj; }; } return _typeof(obj); }

/*
 currency.js - v1.2.2
 http://scurker.github.io/currency.js

 Copyright (c) 2019 Jason Wilson
 Released under MIT license
*/
(function (d, c) {
  'object' === ( false ? undefined : _typeof(exports)) && 'undefined' !== typeof module ? module.exports = c() :  true ? !(__WEBPACK_AMD_DEFINE_FACTORY__ = (c),
				__WEBPACK_AMD_DEFINE_RESULT__ = (typeof __WEBPACK_AMD_DEFINE_FACTORY__ === 'function' ?
				(__WEBPACK_AMD_DEFINE_FACTORY__.call(exports, __webpack_require__, exports, module)) :
				__WEBPACK_AMD_DEFINE_FACTORY__),
				__WEBPACK_AMD_DEFINE_RESULT__ !== undefined && (module.exports = __WEBPACK_AMD_DEFINE_RESULT__)) : (undefined);
})(this, function () {
  function d(b, a) {
    if (!(this instanceof d)) return new d(b, a);
    a = Object.assign({}, m, a);
    var f = Math.pow(10, a.precision);
    this.intValue = b = c(b, a);
    this.value = b / f;
    a.increment = a.increment || 1 / f;
    a.groups = a.useVedic ? n : p;
    this.s = a;
    this.p = f;
  }

  function c(b, a) {
    var f = 2 < arguments.length && void 0 !== arguments[2] ? arguments[2] : !0,
        c = a.decimal,
        g = a.errorOnInvalid;
    var e = Math.pow(10, a.precision);
    var h = 'number' === typeof b;
    if (h || b instanceof d) e *= h ? b : b.value;else if ('string' === typeof b) g = new RegExp('[^-\\d' + c + ']', 'g'), c = new RegExp('\\' + c, 'g'), e = (e *= b.replace(/\((.*)\)/, '-$1').replace(g, '').replace(c, '.')) || 0;else {
      if (g) throw Error('Invalid Input');
      e = 0;
    }
    e = e.toFixed(4);
    return f ? Math.round(e) : e;
  }

  var m = {
    symbol: '$',
    separator: ',',
    decimal: '.',
    formatWithSymbol: !1,
    errorOnInvalid: !1,
    precision: 2,
    pattern: '!#',
    negativePattern: '-!#'
  },
      p = /(\d)(?=(\d{3})+\b)/g,
      n = /(\d)(?=(\d\d)+\d\b)/g;
  d.prototype = {
    add: function add(b) {
      var a = this.s,
          f = this.p;
      return d((this.intValue + c(b, a)) / f, a);
    },
    subtract: function subtract(b) {
      var a = this.s,
          f = this.p;
      return d((this.intValue - c(b, a)) / f, a);
    },
    multiply: function multiply(b) {
      var a = this.s;
      return d(this.intValue * b / Math.pow(10, a.precision), a);
    },
    divide: function divide(b) {
      var a = this.s;
      return d(this.intValue / c(b, a, !1), a);
    },
    distribute: function distribute(b) {
      for (var a = this.intValue, f = this.p, c = this.s, g = [], e = Math[0 <= a ? 'floor' : 'ceil'](a / b), h = Math.abs(a - e * b); 0 !== b; b--) {
        var k = d(e / f, c);
        0 < h-- && (k = 0 <= a ? k.add(1 / f) : k.subtract(1 / f));
        g.push(k);
      }

      return g;
    },
    dollars: function dollars() {
      return ~~this.value;
    },
    cents: function cents() {
      return ~~(this.intValue % this.p);
    },
    format: function format(b) {
      var a = this.s,
          c = a.pattern,
          d = a.negativePattern,
          g = a.formatWithSymbol,
          e = a.symbol,
          h = a.separator,
          k = a.decimal;
      a = a.groups;
      var l = (this + '').replace(/^-/, '').split('.'),
          m = l[0];
      l = l[1];
      'undefined' === typeof b && (b = g);
      return (0 <= this.value ? c : d).replace('!', b ? e : '').replace('#', ''.concat(m.replace(a, '$1' + h)).concat(l ? k + l : ''));
    },
    toString: function toString() {
      var b = this.s,
          a = b.increment;
      return (Math.round(this.intValue / this.p / a) * a).toFixed(b.precision);
    },
    toJSON: function toJSON() {
      return this.value;
    }
  };
  return d;
});

/***/ }),

/***/ 33:
/*!******************************************************!*\
  !*** multi ./resources/assets/js/custom/currency.js ***!
  \******************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! /Applications/MAMP/htdocs/InfyOm Product/infy-jobs/resources/assets/js/custom/currency.js */"./resources/assets/js/custom/currency.js");


/***/ })

/******/ });