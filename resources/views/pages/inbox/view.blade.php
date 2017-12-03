@extends('layouts.master')

@section('content')

	@foreach($messages as $message)

		
		<div style="float: left; clear: both;">
			<hr>
			<p>From: {{ $message->pivot->user_id }}</p>
			<p>Content: {{ $message->content }}</p>
			<p>Time: {{ \Carbon\Carbon::parse($message->created_at)->diffForHumans() }}</p>
		</div>

	@endforeach

	<form action="{{ url('inbox/new') }}" method="POST" class="form-horizontal">
		{{ csrf_field() }}
		<div class="form-group">
			<div class="col-md-12">
				<input type="hidden" name="reciever" value="{{ $message->pivot->user_id }}">
				<textarea name="content"  rows="2" class="form-control top-buffer" id="content" placeholder="Odgovori" required></textarea>
			</div>
		</div>
		<button class="btn btn-primary" type="submit">Posalji</button>
	</form>

@endsection