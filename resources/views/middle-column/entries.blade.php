                
                        @if (isset($posts) && count($posts) > 0)


                            {{-- <div class="entryGroup"> --}}
                                @foreach ($posts as $p)
                               {{--  <div class="entryGroupTitle">
                                    <span>Alerts from 1 Days Ago</span>
                                </div> --}}
                                <div class="entry">
                                    <div class="entryContent">

                                        <a href="/show/{{$p->id}}">
                                            <h2>{{$p->title}}</h2>
                                        </a>
                                    </div>
                                    <div class="bar">
                                        <span class="text">Updated: {{$p->updated_at}}</span>
                                        <span class="buttons">
                                            <span class="button" title="Delete Entry">
                                                <i class="fas fa-trash"></i>
                                            </span>
                                            <span class="button" title="Approved | True/False">
                                                <i class="fas fa-thumbs-up"></i>
                                            </span>
                                            <span class="button" title="Emailed | True/False">
                                                <i class="fas fa-envelope"></i>
                                            </span>
                                            <span class="button" title="Favorite this Entry">
                                                <i class="fas fa-heart"></i>
                                            </span>
                                            <span class="button" title="Mark Entry as Read/Unread">
                                                <i class="fas fa-check-circle"></i>
                                            </span>
                                        </span>
                                    </div>

                                </div>
                                @endforeach
                                    
                            {{-- </div> --}}
                            
                       
                        @else 
                        <span class="noEntries textCenter">"No Articles Found"</span>
                        @endif
                 

                             

           
