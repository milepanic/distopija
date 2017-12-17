@extends('layouts.master')

@section('content')

	@include('includes.profileSidebar')
	
	<div class="col-md-6">
		@foreach($subscribed as $user)
			<div class="row">
				<img src="{{ asset('images/users/' . $user->id . '.png') }}" alt="{{ $user->name }}'s image">
				<h4><a href="{{ url('profile/' . $user->slug) }}">{{ $user->name }}</a></h4>
				<p>{{ $user->description }}</p>
				<hr>
			</div>
		@endforeach

		{{ $subscribed->links() }}
	</div>
@endsection