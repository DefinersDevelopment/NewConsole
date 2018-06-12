				<div id="mainContent">
                    <div id="content" class="view">
                        <form action="">
                        	<div class="inputContainer">
                        		<label for="">Target <span>(seperate multiple targets with commas)</span></label>
                        		<input type="text">
                        	</div>
                        	<div class="inputContainer">
                        		<label for="">Target</label>
                        		<input type="text">
                        	</div>
                        </form>
                    </div>
                    <div class="circle">
                    	<i class="fas fa-caret-up"></i>
                    </div>
                    
                    @if (isset($post))
                    Ben Makes Ugly Pages:
                    Title: {{$post->title}}<br>
                    @endif
                </div>