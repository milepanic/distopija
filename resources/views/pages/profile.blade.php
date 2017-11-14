@extends('layouts.master')

@section('content')

	<div class="container">
		<div class="row">
			<div class="col-md-12">

				

				<div class="col-md-4">
					<img src="{{ asset('images/users/' . $user->id) }}" alt="">
					<p>Ime: {{ $user->name }}</p>
					<p>Opis: {{ $user->description }}</p>
					<p>Bodovi: {{ $user->points }}</p>
					<br>
					<p>Statistika</p>
					<p>Registrovan: {{ \Carbon\Carbon::parse($user->created_at)->diffForHumans() }}</p>
					poslednja aktivnost
					zbir glasova
					komentari

					@if(Auth::check() && Auth::user()->id === $user->id)
						<p><a href="{{ url('profile/edit/' . $user->slug) }}">Promijeni osobine</a></p>
					@endif

				</div>
				<div class="col-md-6">
					<ul class="nav nav-tabs">
						<li class="active"><a href="#">Vicevi ({{ $user->posts->count() }})</a></li>
						<li><a href="#">Originalni vicevi (000)</a></li>
						<li><a href="#">Omiljeni vicevi (000)</a></li>
					</ul>

					@foreach($posts as $post)
						
						@include('includes.joke')

					@endforeach
				</div>
				
			</div>
		</div>
	</div>

@endsection