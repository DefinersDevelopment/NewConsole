                <div class="middleSurround">
                    <div class="stabilize">
                        <form action="">
                            <div id="search">
                                <div class="top">
                                    <input type="text">
                                    <div class="btn search" title="Search">
                                        <i class="fas fa-search"></i>
                                    </div>
                                    <div class="btn" title="Keyword Search Assistant">
                                        <i class="fas fa-question"></i>
                                    </div>
                                    <div class="btn yellow" title="Close Search">
                                        <i class="fas fa-chevron-circle-left"></i>
                                    </div>
                                </div>
                                <div class="bottom">
                                    <div class="left" id="openAdvancedSearch" title="Open Advanced Search">
                                        <i class="fas advanced fa-chevron-circle-down"></i><span>Advanced Search</span>
                                    </div>
                                    <div class="right">
                                        <i class="fas fa-exclamation-circle"></i><span>You are logged in!</span>
                                    </div>
                                </div>
                            </div>
                            <div id="advancedSearch">
                                <div class="scroll">
                                    
                                </div>
                            </div>
                        </form>
                        @if (isset($posts) && count($posts) > 0)

                        <div id="entries">
                            <div class="entryGroup">
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
                                    
                            </div>
                        </div>
                            
                       
                        @else 
                        "No Articles Found"
                        @endif
                    </div>
                </div>