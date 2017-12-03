@extends('layouts.master')

@section('content')

	<div class="container">
		<div class="row">
			<div class="col-md-12 col-md-offset-4">
				<form action="{{ url('inbox/new') }}" method="POST" class="form-horizontal">
					{{ csrf_field() }}
					<div class="form-group">
						<div class="col-md-4">
							<input type="text" name="reciever" placeholder="To..." value="{{ $id }}" 
							required class="form-control">
						</div>
					</div>
					<div class="form-group">
						<div class="col-md-4">
							<textarea name="content" required class="form-control" cols="30" rows="10" placeholder="Message"></textarea>
						</div>
					</div>
					<div class="form-group">
						<div class="col-md-4">
							<button class="btn btn-primary" type="submit">Posalji</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>

@endsection