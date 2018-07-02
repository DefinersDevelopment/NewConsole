                <nav id="bottomNav">
                    <ul>
                        <li title="Approve Posts">
                            <span>
                                <i class="far fa-thumbs-up"></i>
                            </span>
                        </li>
                        <li title="See the Posts you have created">
                            <span>
                                <i class="fas fa-sticky-note"></i>
                            </span>
                        </li>
                        <li title="View your Favorite alerts">
                            <span>
                                <i class="fas fa-heart getFavsClick" aria-hidden="true"></i>
                            </span>
                        </li>
                        <li title="Log out">
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>
                            
                            <span class='logoutClick'>
                                <i class="fas fa-sign-out-alt" aria-hidden="true"></i>
                            </span>
                        
                        </li>
                    </ul>
                </nav>