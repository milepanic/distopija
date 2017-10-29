@extends('layouts.master')

@section('content')

	@foreach($posts as $post)

		<div class="container">
			<div class="row">
				<div class="col-md-6 bg-warning">
					<p> <strong>Joke</strong>: {{ $post->content }} </p>
					<p> <strong>Original</strong>: {{ $post->original }} </p>
					<p> <strong>User</strong>: {{ $post->user->name }} </p>
					<p> <strong>Dates</strong>: {{ \Carbon\Carbon::parse($post->created_at)->diffForHumans() }} </p>
					<hr>
					{{-- @if(Auth::check()) --}}
					<p> 
						@can('update', $post)
							<a href="#">Edit</a><br>
							<a href="delete/{{ $post->id }}">Delete</a>
						@endcan

						@cannot('update', $post)
							Can not Edit 
						@endcannot
					{{-- @endif --}}
					</p>
			        <br>
					<p> Upvote </p>
					<p> Downvote </p>
					<p> Favorite </p>
					<p> Visit Category </p>
					<p> Block Category </p>
					<p> Report </p>
					<p> Share </p>
					<hr>
					<p> <strong>Upvotes</strong>: {{ $post->upvotes }} </p>
					<p> <strong>Downvotes</strong>: {{ $post->downvotes }} </p>
					<p> <strong>Favorites</strong>: {{ $post->favorites }} </p>
				</div>
			</div>
			<div class="row">
				<div class="col-md-6 bg-info">
					<form action="comment/{{ $post->id }}" method="POST" class="form-inline">
						{{ CSRF_FIELD() }}
			            <div class="form-group">
			                <textarea name="comment" class="form-control" placeholder="Komentarisi" required></textarea>
			            </div>
			            <div class="form-group">
			                <button type="submit" class="btn btn-default">Add</button>
			            </div>
			        </form>

			        <p> Edit </p>
			        <p> Delete </p><br>

			        @forelse($post->comments as $comment)

			        	<p> Komentar: {{ $comment->comment }} </p>
			        	<p> Postavio: {{ $comment->user->name }} </p>
			        	<p> Datum: {{ \Carbon\Carbon::parse($comment->created_at)->diffForHumans() }} </p>
			        	<hr>

			        @empty

			        	<p>No comment</p>

			        @endforelse

				</div>
			</div>
		</div>

		<hr>

	@endforeach

@endsection