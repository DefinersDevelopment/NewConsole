                
                        @if (isset($posts) && count($posts) > 0)


                            {{-- <div class="entryGroup"> --}}
                                @foreach ($posts as $p)
                               {{--  <div class="entryGroupTitle">
                                    <span>Alerts from 1 Days Ago</span>
                                </div> --}}
                                <div class="entry postContainer" >
                                    <div class="entryContent">
                                        <h2 class="isPost" postId="{{$p->id}}" id="{{$p->id}}">{{$p->title}}</h2>
                                    </div>
                                    <div class="bar">
                                        <span class="text">Updated: {{$p->updated_at}}</span>
                                        <span class="buttons">
                                            <span class="button" title="">
                                                <i class="fas fa-trash"></i>
                                            </span>
                                            <span class="button" title="">
                                                <i class="fas fa-thumbs-up"></i>
                                            </span>
                                            <span class="button" title="">
                                                <i class="fas fa-envelope"></i>
                                            </span>
                                            <span class="button" title="">
                                                <i class="fas fa-heart"></i>
                                            </span>
                                            <span class="button" title="">
                                                <i class="fas fa-check-circle"></i>
                                            </span>
                                        </span>
                                    </div>
                                </div>
                                @endforeach
                                
                            {{-- </div> --}}
                            
                       
                        @else 
                        "No Articles Found"
                        @endif
                 

                             

           
