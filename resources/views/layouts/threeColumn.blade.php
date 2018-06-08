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

				@include('middle-column.search')
				@include('middle-column.entries')

			</section>

			<section id="rightColumn">
				@include('right-column.topBar')
				@include('right-column.mainContent')
			</section>

@stop