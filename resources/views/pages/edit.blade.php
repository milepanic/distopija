@extends('layouts.master')

@section('content')

	<div class="container">
		<div class="row">
			<div class="col-md-12 col-md-offset-4">
				<form action="update/{{ $post->id }}" method="POST"
					class="form-horizontal">

					{{ CSRF_field() }}
					{{ method_field('PUT') }}

					<div class="form-group">
						<div class="col-md-4">
							<textarea name="content" cols="30" rows="10" 
							class="form-control top-buffer" id="content">{{ $post->content }}</textarea>
						</div>
					</div>
					<div class="form-group">
						<div class="col-md-4">
							<div class="col-sm col-md-4">
						      <div class="checkbox">
						        <label class="col-md-4">
						          <input type="checkbox" @if($post->original) checked @endif name="original" value="1"> Original
						        </label>
						      </div>
						    </div>						
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