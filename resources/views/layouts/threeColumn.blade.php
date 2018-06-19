@extends('layouts.main')
@section('body')

			<header id="navigation">

				@include('left-column.logo')
				@include('left-column.mainNav')
				@include('left-column.bottomNav')

			</header>

			<section id="middleColumn">
				<div class="middleButton">
                    <div id="toggleMiddle" class="circle">
                        <i class="fas fa-caret-left"></i>
                    </div>
                </div>
                <div class="middleSurround">
                    <div class="stabilize">

						@include('middle-column.search')
						<div id='entries'>
							@include('middle-column.entries')
						</div>

					</div>
                </div>
			</section>

			<section id="rightColumn">
				@include('right-column.topBar')
				<div id="mainContent">
					<div id="content" class="view">
						<div id="contentWrapper">
							@include('right-column.mainContent')
						</div>
					</div>
					<div id="notifier">
						
					</div>
					<div class="circle">
                    	<i class="fas fa-caret-up"></i>
                    </div>
				</div>
			</section>

@stop