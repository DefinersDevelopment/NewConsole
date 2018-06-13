
/*********************************
Event Listeners

    ______                 __      
   / _____   _____  ____  / /______
  / __/ | | / / _ \/ __ \/ __/ ___/
 / /___ | |/ /  __/ / / / /_(__  ) 
/_____/ |___/\___/_/ /_/\__/____/  
                                   

**********************************/
function addPostClick(){
	console.log('add post click events');
	// TODO should i add a class/id hiearchy here??
	$(".isPost").on('click', postClick);
}	
function addCatClick(){
	// TODO should i add a class/id hiearchy here??
	$(".isCat").on('click', categoryClick);
}
function addPrevClick(){
	// TODO should i add a class/id hiearchy here??
	$(".prevClick").on('click', prevClick);
}
function addNextClick(){
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
				//console.log(temp);
				if (temp.error > 0){
					// TODO handle this better
					console.log('we got a graceful error from the system');
				}

				successFunc(temp.data);
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
		//console.log("my object: %o", this);
		endPoint = '/a/getMiddleByCat/' + this.getAttribute('catId');
		console.log("this is endpoint " + endPoint)
		makeAjaxCall(endPoint,'GET',data, loadMiddleHTML);
		document.getElementById('currentContext').setAttribute('value', 'categoryBrowse');
	}

	// Success callback for loading posts in middle col
	function loadMiddleHTML(html){
		if (html){
			document.getElementById("entries").innerHTML = html;
			console.log('trying to add post clicks'); 
			addPostClick();
		}
	}

	// Function that is run when a post is clicked in middle col
	// to populate the right area
	function postClick(){
		data = new Object;
		postId = this.getAttribute('postId');
		endPoint = '/a/getPost/' + postId;
		console.log("this is endpoint " + endPoint)	
		makeAjaxCall(endPoint, 'GET',data, loadRightHTML);
		setCurrentPostId(postId);
	}
	// Success callback for loading a post in right main area
	function loadRightHTML(html){
		if (html){
			document.getElementById("mainContent").innerHTML = html;
		}
	}

	/*
	finds current active post and loads the next one in the div of entries
	*/
	function nextClick(){

		console.log('next clicked');
		
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

		console.log('prev clicked');
		
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

/*********************************************
Helpers
                                                  
,--.  ,--.       ,--.                             
|  '--'  | ,---. |  | ,---.  ,---. ,--.--. ,---.  
|  .--.  || .-. :|  || .-. || .-. :|  .--'(  .-'  
|  |  |  |\   --.|  || '-' '\   --.|  |   .-'  `) 
`--'  `--' `----'`--'|  |-'  `----'`--'   `----'  
                     `--'                         

*********************************************/

function getCurrentPostId(){
	return document.getElementById('currentPost').getAttribute('value');
}

function setCurrentPostId(postId){
	document.getElementById('currentPost').setAttribute('value', postId);	
}


	$(document).ready(function() { 

		// register the nav links to show cats
		// in middle col when clicked
		addCatClick();

		// register the prev and next buttons
		// that are top of right area
		addPrevClick();
		addNextClick();

	 });

	
