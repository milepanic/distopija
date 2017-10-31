@extends('layouts.master')

@section('content')

	<div class="container">
		<div class="row">
			<div class="col-md-12 col-md-offset-4">
				<form action="submit" method="POST"
					class="form-horizontal">
					{{ CSRF_field() }}
					<div class="form-group">
						<div class="col-md-4">
							<textarea name="content" cols="30" rows="10" class="form-control top-buffer" id="content" placeholder="Napisi vic..."></textarea>
						</div>
					</div>
					<div class="form-group">
						<div class="col-md-4">
							<select name="category" required class="form-control">
								<option value="" selected disabled hidden class="form-control">Izaberi kategoriju</option>
								@foreach($categories as $category)

									<option value="{{ $category->id }}" class="form-control">{{ $category->name }}</option>

								@endforeach
							</select>
						</div>
					</div>
					<div class="form-group">
						<div class="col-md-4">
							<div class="col-sm col-md-4">
						      <div class="checkbox">
						        <label class="col-md-4">
						          <input type="checkbox" name="original" value="1"> Original
						          	
						        </label>
						      </div>
						    </div>						
						</div>
					</div>
					<div class="form-group">
						<div class="col-md-4">
							<button type="submit" class="btn col-md-12 btn-primary">Postavi</button>
						</div>
					</div>
				</form>
			</div> 
		</div>
	</div>

@endsection