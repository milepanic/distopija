@extends('layouts.master')

@section('content')

	<div class="container">
		<div class="row">
			<div class="col-md-12">
				
				@include('includes.profileSidebar')

				@include('includes.profilePosts')
				
			</div>
		</div>
	</div>

@endsection