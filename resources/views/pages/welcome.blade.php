@extends('layouts.master')

@section('content')
	<div class="container">
		<div class="row">
			<ul class="nav nav-tabs">
				<li class="{{ Request::is('trending') ? 'active' : '' }}">
					<a class="tab" data-type="trending" href="#">Trending</a>
				</li>
				<li class="{{ Request::is('new') ? 'active' : '' }}">
					<a class="tab" data-type="new" href="#">Novo</a>
				</li>
				<li class="{{ Request::is('top') ? 'active' : '' }}">
					<a class="tab" data-type="top" href="#">Top</a>
				</li>
				<li class="{{ Request::is('original') ? 'active' : '' }}">
					<a class="tab" data-type="original" href="#">Original</a>
				</li>
				@if($user)
				<li class="{{ Request::is('subscriptions') ? 'active' : '' }}">
					<a class="tab" data-type="subscriptions" href="#">Subscriptions</a>
				</li>
				@endif
			</ul><br>
		</div>
	</div>

	<div id="jokes">
		@include('includes.jokes')
	</div>

@endsection