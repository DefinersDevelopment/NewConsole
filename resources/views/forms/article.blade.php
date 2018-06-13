

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
		<input type="textarea" name='body' value='{{$post->body or ""}}'>
	</div>
	<div class="inputContainer">
		<div class='formError'>{{$theErrors['category'] or ""}}</div>
		<label for="category">Categories:</label><br>
		<input type="checkbox" name='category' value='4'>Polotics<br>
		<input type="checkbox" name='category' value='5'> Technology
	</div>

	<div class='formSaveClick'>
		push this thing over -----><i class="fas fa-save"></i>
	</div>
</form>