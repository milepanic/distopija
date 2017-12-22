@forelse($comments as $comment)
	<div class="comment-div">
		<div class="comment-box">
			<p data-id="{{ $comment->id }}" class="comment">{{ $comment->comment }}</p>
		</div><br>
		<p> Postavio: {{ $comment->user->name }} </p>
		<p> Datum: {{ \Carbon\Carbon::parse($comment->created_at)->diffForHumans() }} </p>
		<form action="{{ url('comment/' . $comment->id . '/up') }}" method="POST">
			{{ csrf_field() }}
			<button type="submit" class="btn btn-primary">Upvote</button>
		</form>
		<form action="{{ url('comment/' . $comment->id . '/down') }}" method="POST">
			{{ csrf_field() }}
			<button type="submit" class="btn btn-danger">Downvote</button>
		</form>
		@can('edit', $comment)
			<a class="edit" href="#">Edit</a>
	    	<a class="delete" href="#">Delete</a>
	    @endcan
		<hr>
	</div>
@empty

	<p>Nema komentara</p>

@endforelse