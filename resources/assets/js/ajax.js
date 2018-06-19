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
function setCatActive(that){
	$('.isCat').removeClass('active');
	$(that).closest('.isCat').addClass('active');
}
function setEntryActive(that){
	$('.entry').removeClass('active');
	$(that).closest('.entry').addClass('active');
}


function addViewPostClick(){
	// TODO should i add a class/id hiearchy here??
	addUniqueEvent(".isPost", viewPostClick);
}	
function addCatClick(){
	// TODO should i add a class/id hiearchy here??
	addUniqueEvent(".isCat", categoryClick);
	
}
function addPrevClick(){
	// TODO should i add a class/id hiearchy here??
	addUniqueEvent(".prevClick", prevClick);
	
}
function addNextClick(){
	// TODO should i add a class/id hiearchy here??
	addUniqueEvent(".nextClick", nextClick);
	
}
function addShowPostCreateFormClick(){
	// TODO should i add a class/id hiearchy here??
	addUniqueEvent(".showPostCreateFormClick", showPostCreateFormClick);
}
function addFormSaveClick(){
	// TODO should i add a class/id hiearchy here??
	addUniqueEvent(".formSaveClick", formSaveClick);
}
function addEditPostClick(){
	// TODO should i add a class/id hiearchy here??
	addUniqueEvent(".editPostClick", editPostClick);
	
}
function addToggleFavPostClick(){
	// TODO should i add a class/id hiearchy here??
	addUniqueEvent(".toggleFavPostClick", toggleFavPostClick);
}
function addGetFavsClick(){
	addUniqueEvent(".getFavsClick", getFavsClick);	
}
  
/******** END EVENT LISTNER SECTION ******************/

/*
Generic Ajax function, may not work in all cases
endPoint is a string for the URL to be called
data is a JS object
successFunc is a call back function
*/


function makeAjaxCall(endPoint, method, data, successFunc){
	
	data._token = document.getElementById("token").getAttribute('value');

	$.ajax({
		method: method,
		url:    endPoint,
		data: data,
		beforeSend: function(){	
			
		},
		complete: function(){
			
		},
		success: function(response){
			// TODO check error code here!
			temp = JSON.parse(response);
			//logIt(temp.data);

			if (temp.error > 0){
				// TODO handle this better
				logIt('we got a graceful error from the system');
				if (temp.message){
					logIt(temp.message);
				}
			}
			//logIt(temp.data);

			successFunc(temp);
		},
		error: function(jqXHR, textStatus, errorThrown){
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
function categoryClick(){		
	data = new Object;
	setCatActive(this);
	//console.log("my object: %o", this);
	endPoint = '/a/getMiddleByCat/' + this.getAttribute('catId');
	console.log("this is endpoint " + endPoint)
	makeAjaxCall(endPoint,'GET',data, loadMiddleHTML);
	document.getElementById('currentContext').setAttribute('value', 'categoryBrowse');
}


// Function that is run when a post is clicked in middle col
// to populate the right area
function viewPostClick(){
	data = new Object;
	postId = this.getAttribute('postId');
	setEntryActive(this);
	endPoint = '/a/getPost/' + postId;
	logIt("this is endpoint " + endPoint)	
	makeAjaxCall(endPoint, 'GET',data, loadRightHTML);
	setCurrentPostId(postId);
}


/*
finds current active post and loads the next one in the div of entries
*/
function nextClick(){

	logIt('next clicked');
	
	// TODO make this a function getCurPostId();
	curPostId = getCurrentPostId();

	// if there is no active post, do nothing
	// TODO, is this good logic
	if (! curPostId){ return; }

	allPosts = $('.isPost');

	foundIndex = -1;
	for (i = 0; i < allPosts.length; i++) { 
			if (curPostId == allPosts[i].getAttribute('postId')){
				foundIndex = i;
				break;
			}
	}
	// if cur not found (technically not possible)
	// or cur value is last in array
	// then there is no next, do nothing
	if (foundIndex == -1 || foundIndex == allPosts.length){
		return;
	} else {
		nextPost = allPosts[foundIndex +1];
	}

	nextPost.click();
}


function prevClick(){
	logIt('prev clicked');
	
	// TODO make this a function getCurPostId();
	curPostId = getCurrentPostId();

	// if there is no active post, do nothing
	// TODO, is this good logic
	if (! curPostId){ return; }

	allPosts = $('.isPost');

	foundIndex = -1;
	for (i = 0; i < allPosts.length; i++) { 
			if (curPostId == allPosts[i].getAttribute('postId')){
				foundIndex = i;
				break;
			}
	}
	// if cur not found (technically not possible)
	// or cur value is index 0
	// then there is no previous, do nothing
	if (foundIndex == -1 || foundIndex == 0){
		return;
	} else {
		prevPost = allPosts[foundIndex -1];
	}

	prevPost.click();
}

function showPostCreateFormClick(){
	logIt('show form clicked');
	data = new Object;
	endPoint = '/admin/showForm/article' ;
	logIt("this is endpoint " + endPoint)	
	makeAjaxCall(endPoint, 'GET',data, loadRightHTML);
}



function formSaveClick(){
	logIt('form save click ' + this.getAttribute('name'));
	//dump(this);
	// TODO, make this dynamic not hard coded form
	// name
	data = new Object;
	data.formData = $("#theForm").serializeArray();
	//logIt(data); return;
	makeAjaxCall('/admin/savePost', 'POST',data, loadRightHTML);
}


function editPostClick(){
	logIt('edit post click');
	setEntryActive(this);
	// TODO, make this dynamic not hard coded form
	// name
	data = new Object;
	//logIt(data); return;
	postId = this.getAttribute('postId'); // edit button in middle col
	
	logIt('this is post id in edit ' + postId);

	if (! postId) {
		postId = getCurrentPostId(); // edit bttn on top bar
	}

	if (! postId) { 
		logIt('edit could not find any post ID'); 
		return; 
	}
	endpoint = '/admin/editPost/' + postId;
	logIt("endpoint " + endpoint);
	makeAjaxCall(endpoint, 'GET',data, loadRightHTML);
}

function toggleFavPostClick(){
	logIt('edit post click');
	data= new Object;
	
	if ($(this).hasClass('far')){
		onOff = 'on';
	} else {
		onOff = 'off'
	}
	endpoint = '/admin/toggleFavorite/' + onOff +'/' + this.getAttribute('postId');
	logIt("endpoint " + endpoint);
	makeAjaxCall(endpoint, 'GET',data, handleToggleFav);		 
}

	function getFavsClick(){
		logIt('get favs click');
		data= new Object;
		endpoint = '/a/getFavorites/';
		logIt("endpoint " + endpoint);
		makeAjaxCall(endpoint, 'GET',data, loadMiddleHTML);
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

function loadMiddleHTML(response){
	scrollToTop('#search');
	if (response.data){
		document.getElementById("entries").innerHTML = response.data;
		logIt('trying to add post clicks'); 
		addViewPostClick();
		addEditPostClick();
		addToggleFavPostClick();
	}
}


// Success callback for loading a post in right main area
function loadRightHTML(response){
	scrollToTop('#topBar'); 
	if (response.data){
		document.getElementById("contentWrapper").innerHTML = response.data;
		// HACK Alert! this is for FORMS not posts
		// there is no saveClick class for posts!
		logIt('adding formSaveClick listener from load right')
		addFormSaveClick();
	} 

	if (response.postId){
		logIt('load right setting cur post id ' + response.postId);
		setCurrentPostId(response.postId);
	}
}



function handleToggleFav (response){
	logIt('we got back ok, i guess ' + response.data);
	if (response.error == 0){
		selector = '#fav-'+response.data;
		toggleFontAwesome(selector);
	} else {
		// TODO alert user of error
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

function toggleFontAwesome(selector){

	if ($(selector).hasClass('far')){
		$(selector).removeClass('far');
		$(selector).addClass('fas');
	} else {
		$(selector).removeClass('fas');
		$(selector).addClass('far');
	}
}
function getCurrentPostId(){
	return document.getElementById('currentPost').getAttribute('value');
}

function setCurrentPostId(postId){
	logIt('IN FUNC  set cur post =  ' + postId);
	document.getElementById('currentPost').setAttribute('value', postId);	
}

function logIt(msg,status){
	// status not null means log in prod
	if (_log == 'dev' || status == 'prod'){
		console.log(msg);
	}
}

function dump(obj) {
    var out = '';
    for (var i in obj) {
        out += i + ": " + obj[i] + "\n";
    }
    logIt("This is Obect Dump!!");
    logIt(out);
}

function addUniqueEvent(className,func){
		temps = $(className);
	for (i = 0; i < temps.length; i++) {

		if ($(temps[i]).hasClass('hasClickEvent')){
			// do nothing
		} else {
			$(temps[i]).on('click', func);
			$(temps[i]).addClass('hasClickEvent');
		}
	}

}

$(document).ready(function() { 

	// register the nav links to show cats
	// in middle col when clicked
	addCatClick();

	// register the prev and next buttons
	// that are top of right area
	addPrevClick();
	addNextClick();

	addShowPostCreateFormClick();
	addEditPostClick();
	// fav bttn in bottom nav
	addGetFavsClick();
});
	
