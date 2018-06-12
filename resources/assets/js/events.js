
		/**********************
			This file contains all event listeners for the app
		***********************/

		function addCatClick(){
			// TODO should i add a class/id hiearchy here??
			$(".catClick").on('click', getMiddleWithCategory);
		}

		function addPostClick(){
			console.log('add post click events');
			// TODO should i add a class/id hiearchy here??
			$(".postClick").on('click', getPost);
		}	