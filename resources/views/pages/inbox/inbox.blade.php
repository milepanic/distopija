@extends('layouts.master')

@section('content')

	<div class="container">
		<div class="row">
			<div class="col-md-8 col-md-offset-2">
				<div class="row">
					<a href="{{ url('inbox/compose') }}" class="btn btn-info">Compose new</a>
				</div>

				@foreach($messages as $message)
					<div class="row">
						<div class="col-md-12">
							<p>From: {{ $message->pivot->user_id }}</p>
							<p>Content: {{ $message->content }}</p>
							<p>Time: {{ \Carbon\Carbon::parse($message->created_at)->diffForHumans() }}</p>
							<p><a href="{{ url('inbox/view/' . $message->pivot->user_id) }}">Idi u poruke</a></p>
							<hr>
						</div>
					</div>
				@endforeach

			</div>
		</div>
	</div>

@endsection