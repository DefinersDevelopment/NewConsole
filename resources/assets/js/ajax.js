
/*********************************
Event Listeners
**********************************/
function addPostClick(){
	console.log('add post click events');
	// TODO should i add a class/id hiearchy here??
	$(".postClick").on('click', getPost);
}	

function addCatClick(){
	// TODO should i add a class/id hiearchy here??
	$(".catClick").on('click', getMiddleWithCategory);
}






/*
Generic Ajax function, may not work in all cases
endPoint is a string for the URL to be called
data is a JS object
successFunc is a call back function
*/

	function makeAjaxCall(endPoint, method, data, successFunc){
		

		data._token = document.getElementById("token");
		
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
				//console.log(temp.data);
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

	

	// Function that is run when a category is clicked
	function getMiddleWithCategory(){
		data = new Object;
		//console.log("my object: %o", this);
		endPoint = '/a/getMiddleByCat/' + this.getAttribute('catId');
		console.log("this is endpoint " + endPoint)
		makeAjaxCall(endPoint,'GET',data, loadMiddleHTML);
	}
	// the AJAX call will have stripped out
	// response codes and such and just passes html to here
	function loadMiddleHTML(html){
		if (html){
			document.getElementById("entries").innerHTML = html;
			console.log('trying to add post clicks'); 
			addPostClick();
		}
	}


	// Function that is run when a post is clicked in middle col
	// to populate the right area
	function getPost(){
		data = new Object;
		endPoint = '/a/getPost/' + this.getAttribute('postId');
		console.log("this is endpoint " + endPoint)	
		makeAjaxCall(endPoint, 'GET',data, loadRightHTML);
	}
	// the AJAX call will have stripped out
	// response codes and such and just passes html to here
	function loadRightHTML(html){
		if (html){
			document.getElementById("mainContent").innerHTML = html;
		}
	}

	$(document).ready(function() { 

		// register the nav links to show cats
		// in middle col when clicked
		addCatClick();

	 });

	
