@foreach($posts as $post)

	@include('includes.joke')

	<hr>

@endforeach

{{ $posts->links() }}