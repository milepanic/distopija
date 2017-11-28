@extends('layouts.master')

@section('content')
	
	<div class="container">
		<div class="row">
			{{-- <ul class="nav nav-tabs">
				<li {{ Request::is('trending') ? 'active' : '' }}>
					<a class="tab" data-type="trending" href="{{ url('trending') }}">Trending</a>
				</li>
				<li {{ Request::is('new') ? 'active' : '' }}>
					<a class="tab" data-type="new" href="{{ url('new') }}">Novo</a>
				</li>
				<li {{ Request::is('top') ? 'active' : '' }}>
					<a class="tab" data-type="top" href="{{ url('top') }}">Top</a>
				</li>
				<li {{ Request::is('original') ? 'active' : '' }}>
					<a class="tab" data-type="original" href="{{ url('original') }}">Original</a>
				</li>
			</ul><br> --}}
			<ul class="nav nav-tabs">
				<li data-type="trending"><a href="#">Trending</a></li>
				<li data-type="novo"><a href="#">Novo</a></li>
				<li data-type="top"><a href="#">Top</a></li>
				<li data-type="original"><a href="#">Originalni</a></li>
			</ul>
		</div>
	</div>

	@foreach($posts as $post)

		@include('includes.joke')

		<hr>

	@endforeach

	{{ $posts->links() }}

@endsection

{{-- @section('main-js')
	<script>
		
		$(".nav-tabs li").click(function(e) {
			var type = $(this).data('type');
			

			$.ajax({
				type: 'GET',
				url: '/',
				data: type,
				success: function() {
					$(this).addClass('active');
				},
				error: function() {
					/* Act on the event */
				}
			});

		});

	</script>
@endsection --}}