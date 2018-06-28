<div id="logo">
	<a href="">
		<?php 
			$route = Route::currentRouteName(); 
			$routeArray = ['login', 'register'];
		?>
		@if ($route == $routeArray[0] || $route == $routeArray[1])
			<img src="/images/{{env('APP_THEME')}}-color.svg" alt="{{env('APP_THEME')}}">
		@else
			<img src="/images/{{env('APP_THEME')}}.svg" alt="{{env('APP_THEME')}}">
		@endif
	</a>
</div>