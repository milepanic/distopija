@extends('layouts.master')

@section('content')

	<div class="container">
		<div class="row">
			<div class="col-md-12 col-md-offset-4">
				<form action="create" method="POST"
					class="form-horizontal">
					{{ CSRF_field() }}

					<div class="form-group">
						<div class="col-md-4">
							<input type="text" name="name" placeholder="Category name" required class="form-control">
						</div>
					</div>
					<div class="form-group">
						<div class="col-md-4">
							<div class="col-sm col-md-4">
						      <div class="checkbox">
						        <label class="col-md-4">
						          <input type="checkbox" name="nsfw" value="1"> NSFW
						        </label>
						      </div>
						    </div>						
						</div>
					</div>
					<div class="form-group">
						<div class="col-md-6">
							<div class="col-sm col-md-6">
						      <div class="checkbox">
						        <label class="col-md-6">
						          <input type="checkbox" name="cover_box" value="1"> Cover box
						        </label>
						      </div>
						    </div>						
						</div>
					</div>
					<div class="form-group">
						<div class="col-md-4">
							<div class="col-sm col-md-4">
						      <div class="checkbox">
						        <label class="col-md-4">
						          <input type="checkbox" name="pictures" value="1"> Pictures
						        </label>
						      </div>
						    </div>						
						</div>
					</div>
					<div class="form-group">
						<div class="col-md-4">
							<div class="col-sm col-md-4">
						      <div class="checkbox">
						        <label class="col-md-4">
						          <input type="checkbox" name="videos" value="1"> Videos
						        </label>
						      </div>
						    </div>						
						</div>
					</div>
					<div class="form-group">
						<div class="col-md-4">
							<div class="col-sm col-md-4">
						      <div class="checkbox">
						        <label class="col-md-4">
						          <input type="checkbox" name="mods_only" value="1"> <p>Mods only - ne radi</p>
						        </label>
						      </div>
						    </div>						
						</div>
					</div>
					<div class="form-group">
						<div class="col-md-4">
							<button type="submit" class="btn col-md-12 btn-primary">Napravi kategoriju</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>

@endsection