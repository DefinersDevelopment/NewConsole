

<div class='formError'>{{$theErrors['topMessage'] or ''}}</div>
<form id='theForm'>
	<input type='hidden' name='id' value='{{$post->id or ''}}'>
	<div class="inputContainer">
		<div class='formError'>{{$theErrors['title'] or ""}}</div>
		<label for="headline">Headline</label>
		<input type="text" name='title' value='{{$post->title or ""}}'>
	</div>

	<div class="inputContainer">
		<label for="byline">ByLine</label>
		<input type="text" name='short_description'  value='{{$post->short_description or ""}}'>
	</div>

	<div class="inputContainer">
		<label for="author">Author</label>
		<input type="text" name='author' value='{{$post->author or ""}}'>
	</div>

	<div class="inputContainer">
		<label for="author_bio">Bio</label>
		<input type="text" name='author_bio' value='{{$post->author_bio or ""}}'>
	</div>
	<div class="inputContainer">
		<label for="publication">Publication</label>
		<input type="text" name='publication' value='{{$post->publication or ""}}'>
	</div>


	<div class="inputContainer">
		<label for="article">Article</label>
		<textarea name='body'>{{$post->body or ""}}</textarea>
	</div>
	<div class="inputContainer">
		<div class='formError'>{{$theErrors['category'] or ""}}</div>
	</div>
	<h2 for="category">Categories:</h2>
		@if (!isset($postCats))
			<?php $postCats = []; ?>
		@endif

		@if (isset($allCats))
			@foreach ($allCats as $cat)
				@if ($cat->postable == 1)
				<h3>{{ $cat->name }}</h3>
				<div class="columns">
					<div class="inputContainer">
						<label>
							<input type='checkbox' name='category' value='{{$cat->id}}' @if (in_array($cat->id,$postCats)) CHECKED @endif>
							<span>{{$cat->name}}</span>
						</label>
					</div>
				</div>
				@else
					<h3>{{ $cat->name }}</h3>
				@endif 
					<?php 
					$children = $cat->getChildren(); 
					?>
					@if(isset($children) && $cat->postable != 1)
						<div class="columns">
						@foreach($children as $child)
							
							<div class="inputContainer">
								<label>
							@if ($child->postable == 1)
									<input type='checkbox' name='category' value='{{$child->id}}' @if (in_array($child->id,$postCats)) CHECKED @endif>
							@else
								--
							@endif 
									<span>{{ $child->name }}</span>
								</label>
							</div>
						@endforeach
						</div>
					@endif
			@endforeach
		@endif

	<div>
	
	</div>
</form>