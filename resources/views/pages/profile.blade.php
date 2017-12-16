@extends('layouts.master')

@section('content')

	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="col-md-4">
					<img src="{{ asset('images/users/' . $user->id . '.png') }}" alt="">
					@if(Auth::user() && $user->id !== Auth::id())
					<form action="{{ url('subscribe/' . $user->id) }}" method="POST">
						{{ csrf_field() }}
						@if(Auth::user()->subscription->contains($user->id)) 
							<button class="btn btn-danger col-md-12" type="submit">Unubscribe</button>
						@else
							<button class="btn btn-warning col-md-12" type="submit">Subscribe</button>
						@endif
						
					</form>
					@endif
					<p>Ime: {{ $user->name }}</p>
					<p>Opis: {{ $user->description }}</p>
					<p>Bodovi: {{ $user->points }}</p>
					<p><a href="{{ url('inbox/compose/' . $user->id) }}">Posalji poruku</a></p>
					<br>
					<p>Statistika</p>
					<p>Registrovan: {{ \Carbon\Carbon::parse($user->created_at)->diffForHumans() }}</p>
					<a href="#">Pretplate: {{ $user->subscription_count }}</a>
					<br>
					poslednja aktivnost
					zbir glasova
					komentari

					@if(Auth::check() && Auth::id() === $user->id)
						<p><a href="{{ url('profile/edit/' . $user->slug) }}">Promijeni osobine</a></p>
						<p><a href="{{ url('profile/' . $user->slug . '/blocked') }}">Blocked categories</a></p>
					@endif

				</div>
				<div class="col-md-6">
					<ul class="nav nav-tabs">
						<li class="{{ Request::is('profile/' . $user->slug) ? 'active' : '' }}">
							<a class="tab" data-type="{{ 'profile/' . $user->slug }}" href="#">
								Vicevi ({{ $user->posts_count }})
							</a>
						</li>
						<li class="{{ Request::is('profile/' . $user->slug . '/original') ? 'active' : '' }}">
							<a class="tab" data-type="{{ 'profile/' . $user->slug . '/original' }}" href="#">
								Original ({{ $user->original_count }})
							</a>
						</li>
						<li class="{{ Request::is('profile/' . $user->slug . '/favorites') ? 'active' : '' }}">
							<a class="tab" data-type="{{ 'profile/' . $user->slug . '/favorites' }}" href="#">
								Favorites ({{ $user->favorite_count }})
							</a>
						</li>
					</ul>
						@include('includes.jokes')
				</div>
			</div>
		</div>
	</div>

@endsection