<div class="container">
	<div class="row">
		<div class="col-md-6 bg-warning" data-id="{{ $post->id }}">
			<p> <strong>Joke</strong>: {{ $post->content }} </p>
			@if($post->original) <p> <strong>Original</strong> </p> @endif
 			<p> <strong>User</strong>: <a href="{{ url('profile/' . $post->user->slug) }}"> {{ $post->user->name }} </a> </p>
			<p> <strong>Category:</strong> <a href="{{ url('k/' . $post->category->name) }}"> {{ $post->category->name }} </a> </p>
			<p> <strong>Date</strong>: <a href="{{ url('v/' . $post->id) }}">{{ (\Carbon\Carbon::parse($post->created_at)->diffForHumans() ) }}</a> </p>
			<hr>
			@can('update', $post)
				<a href="{{ url('edit/' . $post->id) }}">Edit</a><br>
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
			<button id="upvote" data-type="upvote" data-id="{{ $post->id }}"
					class="btn vote 
					@if($user && $post->votes->where('id', $user->id)->first() 
							&& $post->votes->where('id', $user->id)->first()->pivot->vote === 1) 
						btn-primary 
					@endif">
				Upvote

			</button>
			<button id="downvote" data-type="downvote" data-id="{{ $post->id }}"
					class="btn vote 
					@if($user && $post->votes->where('id', $user->id)->first() 
							&& $post->votes->where('id', $user->id)->first()->pivot->vote === -1) 
						btn-danger 
					@endif">
				Downvote
			</button>
			<br><br>
			<p> <a class="block-category" href="{{ url('block/' . $post->category->id) }}">Blokiraj kategoriju</a> </p>
			<a href="#" class="report-post">Report</a>
			<p> Share </p>
			<p> ------- </p>
			<p> <strong>Upvotes</strong>: {{ $post->upvotes_count }}</p>
			<p> <strong>Downvotes</strong>: {{ $post->downvotes_count }}</p>
			<p> <strong>Favorites</strong>: {{ $post->favorites_count }}</p>
			<a class="comments-icon" href="#"> <strong>Comments</strong>: {{ $post->comments_count }}</a>
		</div>
	</div>
	<div class="row comments-container hidden">
		<div class="col-md-6 bg-info">
			<form action="{{ url('comment/' . $post->id) }}" method="POST" class="form-inline">
				{{ CSRF_FIELD() }}
	            <div class="form-group">
	                <textarea name="comment" class="form-control" placeholder="Komentarisi" required></textarea>
	            </div>
	            <div class="form-group">
	                <button type="submit" class="btn btn-default add-comment">Add</button>
	            </div>
	        </form>
	        <div class="row comments-box"><!-- Comments show here --></div>
		</div>
	</div>
</div>