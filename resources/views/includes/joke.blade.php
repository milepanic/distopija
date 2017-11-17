<div class="container">
	<div class="row">
		<div class="col-md-6 bg-warning">
			{{ $post->votedBy($user) }}
			@if($user && $post->votedBy($user)->count() > 0) Glasao @endif
			
			<p> <strong>Joke</strong>: {{ $post->content }} </p>
			<p> <strong>ID</strong>: {{ $post->id }} </p>
			<p> <strong>Original</strong>: {{ $post->original }} </p>
			<p> <strong>User</strong>: {{ $post->user->name }} </p>
			<p> <strong>Category:</strong> {{ $post->category->name }} </p>
			<p> <strong>Category ID:</strong> {{ $post->category->id }} </p>
			<p> <strong>Date</strong>: <a href="{{ url('v/' . $post->id) }}">{{ (\Carbon\Carbon::parse($post->created_at)->diffForHumans() ) }}</a> </p>
			<hr>
			<p> 
				@can('update', $post)
					<a href="{{ url('edit/' . $post->id) }}" class="btn btn-info">Edit</a><br>
					<form action="{{ url('delete/' . $post->id) }}" method="POST">
						{{ csrf_field() }}
						{{ method_field('DELETE') }}
						<button class="btn btn-danger" type="submit">Delete</button>
					</form>
				@endcan

				@cannot('update', $post)
					Can not Edit 
				@endcannot
				<br>
			<button class="btn favorite 
						@if($user && $post->favoritedBy($user)) voted @endif" 
						data-id="{{ $post->id }}">Favorite
			</button>
			</p>
	        <br>
			<button id="upvote" data-type="upvote" data-id="{{ $post->id }}"
					class="btn vote @if($user && $post->votedBy($user)->first() === 1) btn-primary @endif">
				Upvote
			</button>
			<button id="downvote" data-type="downvote" data-id="{{ $post->id }}"
					class="btn vote @if($user && $post->votedBy($user)->first() === -1) btn-danger @endif">
				Downvote
			</button>
			<br><p></p>

			<p> <a href="{{ url('k/' . $post->category->name) }}">Visit Category</a> </p>
			<p> <a href="{{ url('block/' . $post->category->id) }}">Block Category</a> </p>
			<p> NE RADI </p>
			<p> Report // napraviti u admin panelu tabelu u koju se upisuje korisnik, post i razlog </p>
			<p> Share </p>
			<p> ------- </p>
			<hr>
			<p> <strong>Upvotes</strong>: {{ $post->upvotes }} </p>
			<p> <strong>Downvotes</strong>: {{ $post->downvotes }} </p>
			<p> <strong>Favorites</strong>: {{ $post->favorites }} </p>
		</div>
	</div>
	<div class="row">
		<div class="col-md-6 bg-info">
			<form action="{{ url('comment/' . $post->id) }}" method="POST" class="form-inline">
				{{ CSRF_FIELD() }}
	            <div class="form-group">
	                <textarea name="comment" class="form-control" placeholder="Komentarisi" required></textarea>
	            </div>
	            <div class="form-group">
	                <button type="submit" class="btn btn-default">Add</button>
	            </div>
	        </form>

	        <p> Edit </p><br>
	
			{{-- EAGER LOAD THIS --}}
	        @forelse($post->comments as $comment)
				
	        	<p> Komentar: {{ $comment->comment }} </p>
	        	<p> ID: {{ $comment->id }} </p>
	        	<p> Votes: {{ $comment->votes }} </p>
	        	<p> Postavio: {{ $comment->user->name }} </p>
	        	<p> Datum: {{ \Carbon\Carbon::parse($comment->created_at)->diffForHumans() }} </p>
	        	<br>
	        	<p>
	        		<form action="{{ url('comment/' . $comment->id . '/up') }}" method="POST">
	        			{{ csrf_field() }}
	        			<button type="submit" class="btn btn-primary">Upvote</button>
	        		</form>
	        		<form action="{{ url('comment/' . $comment->id . '/down') }}" method="POST">
	        			{{ csrf_field() }}
	        			<button type="submit" class="btn btn-danger">Downvote</button>
	        		</form>
	        	</p>
	        	<p> <a href="#">Delete</a> </p>
	        	<hr>

	        @empty

	        	<p>No comment</p>

	        @endforelse

		</div>
	</div>
</div>

@section('exteral-js')
	<script type="text/javascript">
		$('.vote').click(function() {
			var vote = {
				type: $(this).data('type'),
				id: $(this).data('id')
			};

			if($(this).data('type') === 'upvote') {
				if($('#downvote').hasClass('btn-danger'))
					$('#downvote').removeClass('btn-danger');
				$(this).toggleClass('btn-primary');
			}
			else {
				if($('#upvote').hasClass('btn-primary'))
					$('#upvote').removeClass('btn-primary');
				$(this).toggleClass('btn-danger');
			}

			$.ajax({
				type: 'POST',
				url: '/post/vote',
				data: vote,
				success: function (data) {
					
				},
				error: function() {
					alert('Dogodila se greska');
				}
			});
		});

		$('.favorite').click(function() {
			var vote = {
				id: $(this).data('id')
			};

			$(this).toggleClass('voted');

			$.ajax({
				type: 'POST',
				url: '/post/favorite',
				data: vote,
				success: function (data) {
					
				},
				error: function() {
					alert('Dogodila se greska');
				}
			});
		});
	</script>
@endsection