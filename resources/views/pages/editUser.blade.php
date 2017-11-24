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

<div class="row">
	<div class="col-md-6">
	<img id="image" src="{{ asset('images/users/' . $user->id . '.png') }}" alt="">
</div>
</div>
<div class="row">
<button onclick="crop()">Crop</button>
</div>



			</div> 
		</div>
	</div>

@endsection

@section('external-js')

<script>

	$(function() {
		// Cropper options
		var options = {
			aspectRatio: 1 / 1,
			minContainerWidth: 350,
			minContainerHeight: 350,
			minCropBoxWidth: 300,
			minCropBoxHeight: 300,
			minCanvasWidth: 300,
			minCanvasHeight: 300,
			cropBoxResizable: true,
			viewMode: 1,
			responsive: true,
			background: false
		};

		// Show cropper on existing image
		var image = $("#image");
		var cropper = image.cropper(options);
	});

	// Send cropped image to server
	function crop() {
		$("#image").cropper('getCroppedCanvas').toBlob(function (blob) {
			var formData = new FormData();

			formData.append('croppedImage', blob);

			$.ajax('/profile/edit/cropper', {
				method: "POST",
				data: formData,
				processData: false,
				contentType: false,
				success: function () {
					alert('Upload success');
				},
				error: function () {
					alert('Upload error');
				}
			});
		});
	}

</script>

<style>
	.cropper-crop {
		display: none;
	}
</style>

@endsection