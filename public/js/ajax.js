

/*
Generic Ajax function, may not work in all cases
endPoint is a string for the URL to be called
data is a JS object
successFunc is a call back function
*/

	function makeAjaxCall(endPoint, data, successFunc){
		
		data._token = document.getElementById("token");
		
		$.ajax({
			method: 'GET',
			url:    endPoint,
			data: data,
			beforeSend: function(){	
				
			},
			complete: function(){
				
			},
			success: function(response){

				temp = JSON.parse(response);
				successFunc(response);
			},
			error: function(jqXHR, textStatus, errorThrown){
				console.log("Ajax Error");
				console.log(JSON.stringify(jqXHR));
				console.log("AJAX error: " + textStatus + ' : ' + errorThrown);
				/* TODO show user a nice error code somewhere */
			}
		});
	}

	// the AJAX call will have stripped out
	// response codes and such and just passes html to here
	function loadMiddleHTML(html){
		
	}

	// Function that is run when a category is clicked
	function getMiddleWithCategory(){
		
		data = new Object;
		makeAjaxCall('/a/getMiddleByCat/1',data, loadMiddle);

	}

	$(document).ready(function() { 
		
		getMiddleWithCategory();

	 });

	
