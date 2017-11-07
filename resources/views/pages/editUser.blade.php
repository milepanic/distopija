@extends('layouts.master')

@section('content')

	<div class="container">
		<div class="row">
			<div class="col-md-12 col-md-offset-4">
				<form action="{{ url('profile/edit/' . $user->id) }}" method="POST"
					class="form-horizontal" enctype="multipart/form-data">

					{{ CSRF_field() }}
					{{ method_field('PUT') }}

					<div class="form-group">
						<div class="col-md-4">
							<input type="file" name="image" class="form-control">
						</div>
					</div>
					<div class="form-group">
						<div class="col-md-4">
							<input type="text" name="name" class="form-control" value="{{ $user->name }}">
						</div>
					</div>
					<div class="form-group">
						<div class="col-md-4">
							<input type="text" name="email" class="form-control" value="{{ $user->email }}">
						</div>
					</div>
					<div class="form-group">
						<div class="col-md-4">
							<textarea name="description" cols="30" rows="10" class="form-control">{{ $user->description }}</textarea>
						</div>
					</div>
					<div class="form-group">
						<div class="col-md-4">
							<button type="submit" class="btn col-md-12 btn-primary">Izmeni</button>
						</div>
					</div>
				</form>
			</div> 
		</div>
	</div>

@endsection