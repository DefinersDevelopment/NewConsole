
                    
                        
                        @if (isset($post))
                              <h1>{{$post->title}}</h1>
                              <p class="meta">
                                    {{$post->publication}} | {{$post->author}} | {{date_format($post->updated_at, "F j, Y - g:iA")}}
                              </p>
                              <p><a href="{{$post->url}}"><i class="fas fa-external-link-square-alt"></i> View Source</a></p>
                              {!!$post->body!!}
                              
                        @else
                              {{-- TODO john please remove --}}
                        <div style='background-color: lightblue; padding: 50px; '> 
                              <img src="/images/{{env('APP_THEME')}}.svg" alt="">
                        </div>
                        @endif
                        
                         
                    
                    
                    
                    


