<div class="container">
	<div class="row">
		<div class="col-md-6 bg-warning">			
			<p> <strong>Joke</strong>: {{ $post->content }} </p>
			@if($post->original) <p> <strong>Original</strong> </p> @endif
 			<p> <strong>User</strong>: <a href="{{ url('profile/' . $post->user->slug) }}"> {{ $post->user->name }} </a> </p>
			<p> <strong>Category:</strong> <a href="{{ url('k/' . $post->category->name) }}"> {{ $post->category->name }} </a> </p>
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
				<br>
			<button class="btn favorite 
						@if($user && $post->favorites->contains($user)) voted @endif"
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
			<br><br>
			<p> <a href="{{ url('block/' . $post->category->id) }}">Block Category</a> </p>
			<p> Report // napraviti u admin panelu tabelu u koju se upisuje korisnik, post i razlog </p>
			<p> Share </p>
			<p> ------- </p>
			<p> <strong>Upvotes</strong>: {{ $post->upvotes_count }}</p>
			<p> <strong>Downvotes</strong>: {{ $post->downvotes_count }}</p>
			<p> <strong>Favorites</strong>: {{ $post->favorites_count }}</p>
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
	        </form><br><br>
	
	        @forelse($post->comments as $comment)
				
	        	<div class="comment-div">
	        		<div class="comment-box">
	        			<p data-id="{{ $comment->id }}" class="comment">{{ $comment->comment }}</p>
	        		</div><br>
		        	<p> Postavio: {{ $comment->user->name }} </p>
		        	<p> Datum: {{ \Carbon\Carbon::parse($comment->created_at)->diffForHumans() }} </p>
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
		        	@can('edit', $comment)
		        		<a class="edit" href="#">Edit</a>
			        	<a class="delete" href="#">Delete</a>
			        @endcan
		        	<hr>
	        	</div>

	        @empty

	        	<p>No comment</p>

	        @endforelse

		</div>
	</div>
</div>