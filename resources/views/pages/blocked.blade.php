@extends('layouts.master')

@section('content')

	<div class="container">
		<div class="row">
			<h3>Vase blokirane kategorije (nece se pojavljivati na pocetnoj)</h3>
			@forelse($blocked as $category)
				<p>{{ $category->name }} - <a href="{{ url('unblock/' . $category->id) }}">odblokiraj</a></p>
			@empty
				<p>Nemate blokiranih kategorija</p>
			@endforelse
		</div>
	</div>

@endsection