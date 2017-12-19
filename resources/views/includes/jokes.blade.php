@foreach($posts as $post)

	@include('includes.joke')

	<hr>

@endforeach

{{ $posts->links() }}

<script>
	// Check if user is logged in and prevent guests from voting etc.
	var user = {!! json_encode(Auth::check()) !!}
	if(!user) {
		$('.vote, .favorite, .block-category, .add-comment').addClass('guest');

		$('.guest').on('click', function(e) {
			e.preventDefault();

			var conf = confirm('Da bi izvrsili ovu akciju morate da se prijavite\n');
			if(conf) {
				window.location.replace('login');
			}
		});
	}
</script>