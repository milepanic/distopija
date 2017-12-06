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
			</ul><br>
		</div>
	</div>

	<div id="jokes">
		@include('includes.jokes')
	</div>

@endsection

@section('main-js')
	<script>

		$(".nav-tabs li a").click(function(e) {
			e.preventDefault();
			var type = $(this).data('type');

			window.location.pathname = '/' + type;
			
			$.ajax({
				type: 'GET',
				url: '/' + type,
				data: type,
				success: function(data) {
					$(this).parent().addClass('active');
					$("#jokes").html(data);
				},
				error: function() {
					/* Act on the event */
				}
			});
		});

	</script>
@endsection