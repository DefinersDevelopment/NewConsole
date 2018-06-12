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
/******/ 			Object.defineProperty(exports, name, {
/******/ 				configurable: false,
/******/ 				enumerable: true,
/******/ 				get: getter
/******/ 			});
/******/ 		}
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
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 0);
/******/ })
/************************************************************************/
/******/ ([
/* 0 */
/***/ (function(module, exports, __webpack_require__) {

__webpack_require__(1);
module.exports = __webpack_require__(3);


/***/ }),
/* 1 */
/***/ (function(module, exports, __webpack_require__) {


/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

//require('./bootstrap');

__webpack_require__(2);

//window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

// Vue.component('example-component', require('./components/ExampleComponent.vue'));

// const app = new Vue({
//     el: '#app'
// });

/***/ }),
/* 2 */
/***/ (function(module, exports) {

var nav = 1;
$(".cover").click(function () {
	if (nav % 2 === 0) {
		$(".line").removeClass('animate');
		$(".line").toggleClass('reverse');
	} else {
		$(".line").removeClass('reverse');
		$('.line').toggleClass('animate');
	}
	nav = nav + 1;
});

// Open SubNavigation
function openSubNavigation() {
	$('#mainNav span.toggleNav').click(function () {
		$('#mainNav li ul').slideUp();
		if ($(this).parent().find('ul').is(':hidden') == true) {
			$(this).parent().find('ul').slideDown();
		}
	});
	$('#mainNav li ul li').click(function () {
		$(this).parent().css('display', 'block');
	});
}
openSubNavigation();

// Close/Open Middle Column
function closeOpenMiddleColumn() {
	$('#toggleMiddle').click(function () {
		$('#middleColumn').toggleClass('closed');
	});
	if ($(window).width() < 1170) {
		$('#middleColumn').addClass('closed');
	}
	$(window).resize(function () {
		console.log($(window).width());
		if ($(window).width() < 1170) {
			$('#middleColumn').addClass('closed');
		} else {
			$('#middleColumn').removeClass('closed');
		}
	});
}
closeOpenMiddleColumn();

// Advanced Search
function advancedSearch() {
	$('#openAdvancedSearch').click(function () {
		$('#advancedSearch').slideToggle();
		$(this).toggleClass('active');
		if ($('.advanced').hasClass('fa-chevron-circle-down')) {
			$('.advanced').removeClass('fa-chevron-circle-down').addClass('fa-chevron-circle-up');
		} else {
			$('.advanced').removeClass('fa-chevron-circle-up').addClass('fa-chevron-circle-down');
		}
	});
}
advancedSearch();

//Scroll To Top
function scrollToTop() {
	$('#content').scroll(function () {
		var scroll = $(this).scrollTop();
		console.log(scroll);
		if (scroll < 500) {
			$('#rightColumn .circle').css({ 'opacity': '.5' });
		} else {
			$('#rightColumn .circle').css({ 'opacity': '1' });
		}
	});
	$('#rightColumn .circle').click(function () {
		$('#content').animate({
			scrollTop: $($.attr(this, 'top')).offset().top
		}, '500');
		return false;
	});
}
scrollToTop();

// Scroll Bar
function scrollBar() {
	$('#color').show().css('width', 0);
	var d = $('#content').prop('scrollHeight');
	$('#content').on('scroll', function () {
		var h = $(window).innerHeight() - 75;
		var scroll = $(this).scrollTop();
		var output = scroll / (d - h) * 100;
		$('#color').css({ 'width': output + '%' });
	});
}
scrollBar();

/***/ }),
/* 3 */
/***/ (function(module, exports) {

// removed by extract-text-webpack-plugin

/***/ })
/******/ ]);