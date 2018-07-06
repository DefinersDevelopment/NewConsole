
                 <nav id="mainNav">
                    <ul>

                    @foreach ($navCats as $parent)
                        <li>
                            <span class="toggleNav">
                                <span class="icon">
                                    <i class="fas fa-circle"></i>
                                </span>
                                <span class="text">
                                    {{$parent->name}}
                                </span>
                            </span>
                            <?php $children = $parent->getChildren(); ?>
                            <ul>
                        @foreach ($children as $child)
                            <li class="isCat" catId='{{$child->id}}'>
                                    <span>
                                        <span class="icon">
                                            <i class="fas fa-circle"></i>
                                        </span>
                                        <span class="text">
                                            {{$child->name}}
                                        </span>
                                        <a href="test.com">
                                            <span class="unreadNumber" title="{{$child->name}} has {{$child->unread_count}} unreads" id='unreadCat-{{$child->id}}'>{{$child->unread_count}}</span>
                                        </a>
                                    </span>
                            </li>
                        @endforeach {{-- end child loop--}}
                            </ul> {{-- end child loop UL--}}
                        </li>{{-- end parent loop --}}            

                    @endforeach {{-- end parent loop --}}
                    </ul>{{-- end parent loop --}}

                    {{--
                        <li>
                            <span class="toggleNav">
                                <span class="icon">
                                    <i class="fas fa-circle"></i>
                                </span>
                                <span class="text">
                                    News
                                </span>
                                <span class="unreadNumber">50</span>
                            </span>
                            <ul>
                                <li class="isCat" catId='4'>
                                    <span>
                                        <span class="icon">
                                            <i class="fas fa-circle"></i>
                                        </span>
                                        <span class="text">
                                            Politics
                                        </span>
                                        <span class="unreadNumber">50</span>
                                    </span>
                                </li>
                                <li class="isCat" catId='5'>
                                    <span>
                                        <span class="icon">
                                            <i class="fas fa-circle"></i>
                                        </span>
                                        <span class="text">
                                            Technology
                                        </span>
                                        <span class="unreadNumber">50</span>
                                    </span>
                                </li>
                                <li class="isCat" catId='6'>
                                    <span>
                                        <span class="icon">
                                            <i class="fas fa-circle"></i>
                                        </span>
                                        <span class="text">
                                            Business
                                        </span>
                                        <span class="unreadNumber">50</span>
                                    </span>
                                </li>
                                <li class="isCat" catId='7'>
                                    <span>
                                        <span class="icon">
                                            <i class="fas fa-circle"></i>
                                        </span>
                                        <span class="text">
                                            Education
                                        </span>
                                        <span class="unreadNumber">50</span>
                                    </span>
                                </li>
                                <li class="isCat" catId='8'>
                                    <span>
                                        <span class="icon">
                                            <i class="fas fa-circle"></i>
                                        </span>
                                        <span class="text">
                                            Health
                                        </span>
                                        <span class="unreadNumber">50</span>
                                    </span>
                                </li>
                                <li class="isCat" catId='9'>
                                    <span>
                                        <span class="icon">
                                            <i class="fas fa-circle"></i>
                                        </span>
                                        <span class="text">
                                            Energy
                                        </span>
                                        <span class="unreadNumber">50</span>
                                    </span>
                                </li>
                                <li class="isCat" catId='10'>
                                    <span>
                                        <span class="icon">
                                            <i class="fas fa-circle"></i>
                                        </span>
                                        <span class="text">
                                            International
                                        </span>
                                        <span class="unreadNumber">50</span>
                                    </span>
                                </li>
                            </ul>
                        </li>
                        <li class="isCat" catId='2'>
                            <span>
                                <span class="icon">
                                    <i class="fas fa-circle"></i>
                                </span>
                                <span class="text">
                                   News Analysis
                                </span>
                                <span class="unreadNumber">50</span>
                            </span>
                        </li>
                        <li class="" catId='3'>
                            <span class="toggleNav">
                                <span class="icon">
                                    <i class="fas fa-circle"></i>
                                </span>
                                <span class="text">
                                   Opinion
                                </span>
                                <span class="unreadNumber">50</span>
                            </span>
                            <ul>
                                <li class="isCat" catId='11'>
                                    <span>
                                        <span class="icon">
                                            <i class="fas fa-circle"></i>
                                        </span>
                                        <span class="text">
                                            Domestic Policy
                                        </span>
                                        <span class="unreadNumber">50</span>
                                    </span>
                                </li>
                                <li class="isCat" catId='12'>
                                    <span>
                                        <span class="icon">
                                            <i class="fas fa-circle"></i>
                                        </span>
                                        <span class="text">
                                            Foreign Policy
                                        </span>
                                        <span class="unreadNumber">50</span>
                                    </span>
                                </li>
                                <li class="isCat" catId='13'>
                                    <span>
                                        <span class="icon">
                                            <i class="fas fa-circle"></i>
                                        </span>
                                        <span class="text">
                                            Point-Counter Point
                                        </span>
                                        <span class="unreadNumber">50</span>
                                    </span>
                                </li>

                            </ul>
                        </li>
                    </ul>
                    --}}
                </nav> 