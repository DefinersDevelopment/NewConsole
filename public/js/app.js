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
module.exports = __webpack_require__(5);


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
__webpack_require__(3);
__webpack_require__(4);

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

// Close/Open Middle Column
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

// Advanced Search
$('#openAdvancedSearch').click(function () {
	$('#advancedSearch').slideToggle();
	$(this).toggleClass('active');
	if ($('.advanced').hasClass('fa-chevron-circle-down')) {
		$('.advanced').removeClass('fa-chevron-circle-down').addClass('fa-chevron-circle-up');
	} else {
		$('.advanced').removeClass('fa-chevron-circle-up').addClass('fa-chevron-circle-down');
	}
});

var john = 'test';

/***/ }),
/* 3 */
/***/ (function(module, exports) {


/**********************
	This file contains all event listeners for the app
***********************/

function addCatClick() {
	// TODO should i add a class/id hiearchy here??
	$(".catClick").on('click', getMiddleWithCategory);
}

function addPostClick() {
	console.log('add post click events');
	// TODO should i add a class/id hiearchy here??
	$(".postClick").on('click', getPost);
}

/***/ }),
/* 4 */
/***/ (function(module, exports) {



/*
Generic Ajax function, may not work in all cases
endPoint is a string for the URL to be called
data is a JS object
successFunc is a call back function
*/

function makeAjaxCall(endPoint, method, data, successFunc) {

	data._token = document.getElementById("token");

	$.ajax({
		method: method,
		url: endPoint,
		data: data,
		beforeSend: function beforeSend() {},
		complete: function complete() {},
		success: function success(response) {

			// TODO check error code here!
			temp = JSON.parse(response);
			//console.log(temp.data);
			successFunc(temp.data);
		},
		error: function error(jqXHR, textStatus, errorThrown) {
			console.log("Ajax Error");
			console.log(JSON.stringify(jqXHR));
			console.log("AJAX error: " + textStatus + ' : ' + errorThrown);
			/* TODO show user a nice error code somewhere */
		}
	});
}

function addPostClick() {
	console.log('add post click events');
	// TODO should i add a class/id hiearchy here??
	$(".postClick").on('click', getPost);
}

// Function that is run when a category is clicked
function getMiddleWithCategory() {
	data = new Object();
	//console.log("my object: %o", this);
	endPoint = '/a/getMiddleByCat/' + this.getAttribute('catId');
	console.log("this is endpoint " + endPoint);
	makeAjaxCall(endPoint, 'GET', data, loadMiddleHTML);
}
// the AJAX call will have stripped out
// response codes and such and just passes html to here
function loadMiddleHTML(html) {
	if (html) {
		document.getElementById("entries").innerHTML = html;
		console.log('trying to add post clicks');
		addPostClick();
	}
}

// Function that is run when a post is clicked in middle col
// to populate the right area
function getPost() {
	data = new Object();
	endPoint = '/a/getPost/' + this.getAttribute('postId');
	console.log("this is endpoint " + endPoint);
	makeAjaxCall(endPoint, 'GET', data, loadRightHTML);
}
// the AJAX call will have stripped out
// response codes and such and just passes html to here
function loadRightHTML(html) {
	if (html) {
		document.getElementById("mainContent").innerHTML = html;
	}
}

$(document).ready(function () {

	// register the nav links to show cats
	// in middle col when clicked
	$(".catClick").on('click', getMiddleWithCategory);
});

/***/ }),
/* 5 */
/***/ (function(module, exports) {

// removed by extract-text-webpack-plugin

/***/ })
/******/ ]);