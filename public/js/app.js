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


/**********************
	This file contains all event listeners for the app
***********************/

// function addPostClick(){
// 	console.log('add post click events');
// 	// TODO should i add a class/id hiearchy here??
// 	$(".postClick").on('click', getPost);
// }

/***/ }),
/* 4 */
/***/ (function(module, exports) {


/*********************************
Event Listeners

    ______                 __      
   / _____   _____  ____  / /______
  / __/ | | / / _ \/ __ \/ __/ ___/
 / /___ | |/ /  __/ / / / /_(__  ) 
/_____/ |___/\___/_/ /_/\__/____/  
                                   

**********************************/
function addPostClick() {
	console.log('add post click events');
	// TODO should i add a class/id hiearchy here??
	$(".isPost").on('click', postClick);
}
function addCatClick() {
	// TODO should i add a class/id hiearchy here??
	$(".isCat").on('click', categoryClick);
}
function addPrevClick() {
	// TODO should i add a class/id hiearchy here??
	$(".prevClick").on('click', prevClick);
}
function addNextClick() {
	// TODO should i add a class/id hiearchy here??
	$(".nextClick").on('click', nextClick);
}

/******** END EVENT LISTNER SECTION ******************/

/*
Generic Ajax function, may not work in all cases
endPoint is a string for the URL to be called
data is a JS object
successFunc is a call back function
*/

function makeAjaxCall(endPoint, method, data, successFunc) {

	data._token = document.getElementById("token").getAttribute('value');

	$.ajax({
		method: method,
		url: endPoint,
		data: data,
		beforeSend: function beforeSend() {},
		complete: function complete() {},
		success: function success(response) {

			// TODO check error code here!
			temp = JSON.parse(response);
			//console.log(temp);
			if (temp.error > 0) {
				// TODO handle this better
				console.log('we got a graceful error from the system');
			}

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

/********************************************************
NAVIGATION STUFF
  _   _             _             _   _             
 | \ | |           (_)           | | (_)            
 |  \| | __ ___   ___  __ _  __ _| |_ _  ___  _ __  
 | . ` |/ _` \ \ / | |/ _` |/ _` | __| |/ _ \| '_ \ 
 | |\  | (_| |\ V /| | (_| | (_| | |_| | (_) | | | |
 |_| \_|\__,_| \_/ |_|\__, |\__,_|\__|_|\___/|_| |_|
                       __/ |                        
                      |___/                         
*********************************************************/

// Function that is run when a category is clicked
function categoryClick() {
	data = new Object();
	//console.log("my object: %o", this);
	endPoint = '/a/getMiddleByCat/' + this.getAttribute('catId');
	console.log("this is endpoint " + endPoint);
	makeAjaxCall(endPoint, 'GET', data, loadMiddleHTML);
	document.getElementById('currentContext').setAttribute('value', 'categoryBrowse');
}

// Success callback for loading posts in middle col
function loadMiddleHTML(html) {
	if (html) {
		document.getElementById("entries").innerHTML = html;
		console.log('trying to add post clicks');
		addPostClick();
	}
}

// Function that is run when a post is clicked in middle col
// to populate the right area
function postClick() {
	data = new Object();
	postId = this.getAttribute('postId');
	endPoint = '/a/getPost/' + postId;
	console.log("this is endpoint " + endPoint);
	makeAjaxCall(endPoint, 'GET', data, loadRightHTML);
	setCurrentPostId(postId);
}
// Success callback for loading a post in right main area
function loadRightHTML(html) {
	if (html) {
		document.getElementById("mainContent").innerHTML = html;
	}
}

/*
finds current active post and loads the next one in the div of entries
*/
function nextClick() {

	console.log('next clicked');

	// TODO make this a function getCurPostId();
	curPostId = getCurrentPostId();

	// if there is no active post, do nothing
	// TODO, is this good logic
	if (!curPostId) {
		return;
	}

	allPosts = $('.isPost');

	foundIndex = -1;
	for (i = 0; i < allPosts.length; i++) {
		if (curPostId == allPosts[i].getAttribute('postId')) {
			foundIndex = i;
			break;
		}
	}
	// if cur not found (technically not possible)
	// or cur value is last in array
	// then there is no next, do nothing
	if (foundIndex == -1 || foundIndex == allPosts.length) {
		return;
	} else {
		nextPost = allPosts[foundIndex + 1];
	}

	nextPost.click();
}

function prevClick() {

	console.log('prev clicked');

	// TODO make this a function getCurPostId();
	curPostId = getCurrentPostId();

	// if there is no active post, do nothing
	// TODO, is this good logic
	if (!curPostId) {
		return;
	}

	allPosts = $('.isPost');

	foundIndex = -1;
	for (i = 0; i < allPosts.length; i++) {
		if (curPostId == allPosts[i].getAttribute('postId')) {
			foundIndex = i;
			break;
		}
	}
	// if cur not found (technically not possible)
	// or cur value is index 0
	// then there is no previous, do nothing
	if (foundIndex == -1 || foundIndex == 0) {
		return;
	} else {
		prevPost = allPosts[foundIndex - 1];
	}

	prevPost.click();
}

/*********************************************
Helpers
                                                  
,--.  ,--.       ,--.                             
|  '--'  | ,---. |  | ,---.  ,---. ,--.--. ,---.  
|  .--.  || .-. :|  || .-. || .-. :|  .--'(  .-'  
|  |  |  |\   --.|  || '-' '\   --.|  |   .-'  `) 
`--'  `--' `----'`--'|  |-'  `----'`--'   `----'  
                     `--'                         

*********************************************/

function getCurrentPostId() {
	return document.getElementById('currentPost').getAttribute('value');
}

function setCurrentPostId(postId) {
	document.getElementById('currentPost').setAttribute('value', postId);
}

$(document).ready(function () {

	// register the nav links to show cats
	// in middle col when clicked
	addCatClick();

	// register the prev and next buttons
	// that are top of right area
	addPrevClick();
	addNextClick();
});

/***/ }),
/* 5 */
/***/ (function(module, exports) {

// removed by extract-text-webpack-plugin

/***/ })
/******/ ]);