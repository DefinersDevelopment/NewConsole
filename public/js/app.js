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



__webpack_require__(4);
__webpack_require__(2);

/***/ }),
/* 2 */
/***/ (function(module, exports) {

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

//Scroll To Top
function scrollToTop() {
	$('#content').animate({
		scrollTop: $('#topBar').offset().top
	}, '500');
}

//Scroll Bar
function scroller() {
	$('#content').scroll(function () {
		var scrollPercent = $(this).scrollTop() / ($('#contentWrapper').height() - $(this).height()) * 100;
		$('#color').css('width', scrollPercent + '%');

		if ($(this).scrollTop() < 500) {
			$('#rightColumn .circle').css({ 'opacity': '.5' });
		} else {
			$('#rightColumn .circle').css({ 'opacity': '1' });
		}
	});

	$('#rightColumn .circle').click(function () {
		scrollToTop();
	});
}
scroller();

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

/***/ }),
/* 3 */,
/* 4 */
/***/ (function(module, exports) {

/********************************
Globals

*********************************/
_log = 'dev';

/*********************************
Event Listeners

    ______                 __      
   / _____   _____  ____  / /______
  / __/ | | / / _ \/ __ \/ __/ ___/
 / /___ | |/ /  __/ / / / /_(__  ) 
/_____/ |___/\___/_/ /_/\__/____/  
                                   

**********************************/
// Scroll the view back to the top -- can be used for when content changes to show the user the first items
function scrollToTop(topDiv) {
	$('#content').animate({
		scrollTop: $(topDiv).offset().top
	}, '500');
}

function addViewPostClick() {
	// TODO should i add a class/id hiearchy here??
	$(".isPost").on('click', viewPostClick);
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
function addShowPostCreateFormClick() {
	// TODO should i add a class/id hiearchy here??
	$(".showPostCreateFormClick").on('click', showPostCreateFormClick);
}
function addFormSaveClick() {
	// TODO should i add a class/id hiearchy here??
	$(".formSaveClick").on('click', formSaveClick);
}
function addEditPostClick() {
	// TODO should i add a class/id hiearchy here??
	$(".editPostClick").on('click', editPostClick);
}
function addToggleFavPostClick() {
	// TODO should i add a class/id hiearchy here??
	$(".toggleFavPostClick").on('click', toggleFavPostClick);
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

			if (temp.error > 0) {
				// TODO handle this better
				logIt('we got a graceful error from the system');
				if (temp.message) {
					logIt(temp.message);
				}
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

// Function that is run when a post is clicked in middle col
// to populate the right area
function viewPostClick() {
	data = new Object();
	postId = this.getAttribute('postId');
	endPoint = '/a/getPost/' + postId;
	logIt("this is endpoint " + endPoint);
	makeAjaxCall(endPoint, 'GET', data, loadRightHTML);
	setCurrentPostId(postId);
}

/*
finds current active post and loads the next one in the div of entries
*/
function nextClick() {

	logIt('next clicked');

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

	logIt('prev clicked');

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

function showPostCreateFormClick() {
	logIt('show form clicked');
	data = new Object();
	endPoint = '/admin/showForm/article';
	logIt("this is endpoint " + endPoint);
	makeAjaxCall(endPoint, 'GET', data, loadRightHTML);
}

function formSaveClick() {
	logIt('form save click');
	// TODO, make this dynamic not hard coded form
	// name
	data = new Object();
	data.formData = $("#theForm").serializeArray();
	//logIt(data); return;
	makeAjaxCall('/admin/savePost', 'POST', data, loadRightHTML);
}

function editPostClick() {
	logIt('edit post click');
	// TODO, make this dynamic not hard coded form
	// name
	data = new Object();
	//logIt(data); return;
	endpoint = '/admin/editPost/' + this.getAttribute('postId');
	logIt("endpoint " + endpoint);
	makeAjaxCall(endpoint, 'GET', data, loadRightHTML);
}
function toggleFavPostClick() {
	logIt('edit post click');
	data = new Object();

	if ($(this).hasClass('highlightOff')) {
		onOff = 'on';
	} else {
		ofOff = 'off';
	}

	endpoint = '/admin/toggleFavorite/' + onOff + '/' + this.getAttribute('postId');

	logIt("endpoint " + endpoint);
	makeAjaxCall(endpoint, 'GET', data, handleToggleFav);
}

/***
 *                  .---.                             
 *                  |   |                             
 *                  '---'                             
 *                  .---.                             
 *                  |   |                             
 *        __        |   |    __     ____     _____    
 *     .:--.'.      |   | .:--.'.  `.   \  .'    /    
 *    / |   \ |     |   |/ |   \ |   `.  `'    .'     
 *    `" __ | |     |   |`" __ | |     '.    .'       
 *     .'.''| |     |   | .'.''| |     .'     `.      
 *    / /   | |_ __.'   '/ /   | |_  .'  .'`.   `.    
 *    \ \._,\ '/|      ' \ \._,\ '/.'   /    `.   `.  
 *     `--'  `" |____.'   `--'  `"'----'       '----' 
 *
 *                  _  _  _                   _         
 *                 | || || |                 | |        
 *       ___  __ _ | || || |__    __ _   ___ | | __ ___ 
 *      / __|/ _` || || || '_ \  / _` | / __|| |/ // __|
 *     | (__| (_| || || || |_) || (_| || (__ |   < \__ \
 *      \___|\__,_||_||_||_.__/  \__,_| \___||_|\_\|___/
 *                                                      
 *                                                      
 */

// Success callback for loading posts in middle col
function loadMiddleHTML(html) {
	scrollToTop('#search');
	if (html) {
		document.getElementById("entries").innerHTML = html;
		logIt('trying to add post clicks');
		addViewPostClick();
		addEditPostClick();
		addToggleFavPostClick();
	}
}

// Success callback for loading a post in right main area
function loadRightHTML(html) {
	scrollToTop('#topBar');
	if (html) {
		document.getElementById("contentWrapper").innerHTML = html;
		// HACK Alert! this is for FORMS not posts
		// there is no saveClick class for posts!
		addFormSaveClick();
	}
}

function handleToggleFav(response) {
	logIt('we got back ok, i guess ' + response);
	selector = '#fav-' + response;
	if ($(selector).hasClass('highlightOff')) {
		$(selector).removeClass('highlightOff');
		$(selector).addClass('highlightOn');
	} else {
		$(selector).removeClass('highlightOn');
		$(selector).addClass('highlightOff');
	}
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
function logIt(msg, status) {
	// status not null means log in prod
	if (_log == 'dev' || status == 'prod') {
		console.log(msg);
	}
}

$(document).ready(function () {

	// register the nav links to show cats
	// in middle col when clicked
	addCatClick();

	// register the prev and next buttons
	// that are top of right area
	addPrevClick();
	addNextClick();
	addShowPostCreateFormClick();
});

/***/ }),
/* 5 */
/***/ (function(module, exports) {

// removed by extract-text-webpack-plugin

/***/ })
/******/ ]);