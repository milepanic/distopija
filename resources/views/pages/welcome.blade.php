@extends('layouts.master')

@section('content')
	
	<div class="container">
		<div class="row">
			<ul class="nav nav-tabs">
				<li><a href="#">NE RADI ---></a></li>
				<li class="active"><a href="#">Hot</a></li>
				<li><a href="#">New</a></li>
				<li><a href="#">Top</a></li>
				<li><a href="#">Original</a></li>
			</ul><br>
		</div>
	</div>

	@foreach($posts as $post)

		@include('includes.joke')

		<hr>

	@endforeach

	{{ $posts->links() }}

@endsection