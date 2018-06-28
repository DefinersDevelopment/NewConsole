
                    
                        
                        @if (isset($post))
                              <h1>{{$post->title}}</h1>
                              <p class="meta">
                                    {{$post->publication}} | {{$post->author}} | {{date_format($post->updated_at, "F j, Y - g:iA")}}
                                    <br>
                                    {{-- TODO this is shit --}}
                                    Posted in Categories<br> @foreach($post->getCatIds() as $cat) {{$cat->name}}<br> @endforeach
                              </p>
                             
                             
                             
                              <p><a href="{{$post->url}}"><i class="fas fa-external-link-square-alt"></i> View Source</a></p>
                              {!!$post->body!!}
                              {{-- TODO do not hard code --}}
                              <?php $url = env('APP_URL'); $user_id=1;?>
                              <span style='display:none;'><img src ="{{$url}}/t/image?t={{$user_id}}-{{$post->id}}"></span>
                        @else
                              {{-- TODO john please remove --}}
                        <div style='background-color: lightblue; padding: 50px; '> 
                              <img src="/images/{{env('APP_THEME')}}.svg" alt="">
                        </div>
                        @endif
                        
                         
                    
                    
                    
                    


