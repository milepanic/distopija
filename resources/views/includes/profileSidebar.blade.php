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
	<h3><a href="{{ url('profile/' . $user->slug) }}">{{ $user->name }}</a></h3>
	<p>Opis: {{ $user->description }}</p>
	<p>Bodovi: {{ $user->points }}</p>
	<p><a href="{{ url('inbox/compose/' . $user->id) }}">Posalji poruku</a></p>
	<br>
	<p>Registrovan: {{ \Carbon\Carbon::parse($user->created_at)->diffForHumans() }}</p>
	<div  data-slug="{{ $user->slug }}">
		Broj ljudi koje prati: 
		<a class="subscribed-to" href="{{ url('profile/' . $user->slug . '/subscribed') }}">
			{{ $user->subscription_count }}
		</a>
		<br>
		Broj ljudi koji ga prate:
		<a class="subscribers" href="{{ url('profile/' . $user->slug . '/subscribers') }}">
			{{ $user->subscribers_count }}
		</a>
	</div>
	<br>
	poslednja aktivnost
	zbir glasova
	komentari

	@if(Auth::check() && Auth::id() === $user->id)
		<p><a href="{{ url('profile/edit/' . $user->slug) }}">Promijeni osobine</a></p>
		<p><a href="{{ url('profile/' . $user->slug . '/blocked') }}">Blocked categories</a></p>
	@endif

</div>