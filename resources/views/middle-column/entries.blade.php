                        <?php use App\Helpers\Html; ?>
                        
                        @if (isset($posts) && count($posts) > 0)

                            {{-- <div class="entryGroup"> --}}
                                @foreach ($posts as $p)
                               {{--  <div class="entryGroupTitle">
                                    <span>Alerts from 1 Days Ago</span>
                                </div> --}}
                                <div class="entry postContainer" id='postContainer-{{$p->id}}'>
                                    <div class="entryContent">
                                        <h2 class="isPost" postId="{{$p->id}}" id="{{$p->id}}">{{$p->title}}</h2>
                                        <p><?php echo word_limiter($p->short_description, 15)."..."; ?></p>
                                    </div>
                                    <div class="bar">
                                        <span class="text">Updated: {{$p->updated_at}}</span>
                                        <span class="text" id='unreadPost-{{$p->id}}' isUnread='@if($p->unread == 'U')1 @endif'>
                                            @if ($p->unread == 'U') unread @endif </span>

                                        <span class="buttons">
                                            <span class="button deletePostClick" postId='{{$p->id}}' title="">
                                                <i class="fas fa-trash"></i>
                                            </span>
                                            {{-- 
                                                <span class="button" title="">
                                                    <i class="fas fa-thumbs-up"></i>
                                                </span> 
                                            --}}
                                            <span class="button" title="">
                                                <i class="fa-heart toggleFavPostClick 
                                                    @if($p->favorite == 'F')  fas @else far @endif
                                                    "        
                                                    id='fav-{{$p->id}}' 
                                                    postId='{{$p->id}}'></i>
                                            </span>
                                            <span class="button editPostClick" postId='{{$p->id}}' title="">
                                                <i class="fas fa-edit"></i>
                                            </span>
                                        </span>
                                    </div>
                                </div>
                                @endforeach
                                
                            {{-- </div> --}}
                            
                       
                        @else 
                        <div class="noEntries">"No Articles Found"</div>
                        @endif
                 

                             

           
