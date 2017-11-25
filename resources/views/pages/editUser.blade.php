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

							<button id="btn-picture" class="col-md-12 btn bg-faded">Promeni profilnu sliku</button>

							<div id="input-picture" class="hidden">
								<label>Postavite sliku</label>
								<input type="file" name="image" id="profile-img" class="form-control" accept="image/*">
								<br>
								<div class="row">
									<div class="col-md-6 img-container">
										<img id="image" class="display" 
											{{--src=" asset('images/users/' . $user->id . '.png') --}}">
									</div>
								</div>
							</div>
							
						</div>
					</div>
					<div class="form-group">
						<div class="col-md-4">
							<label>Korisnicko ime</label>
							<input type="text" name="name" class="form-control" value="{{ $user->name }}">
						</div>
					</div>
					<div class="form-group">
						<div class="col-md-4">
							<label>Email adresa</label>
							<input type="text" name="email" class="form-control" value="{{ $user->email }}">
						</div>
					</div>
					<div class="form-group">
						<div class="col-md-4">
							<label>Opis</label>
							<textarea name="description" cols="30" rows="10" class="form-control">{{ $user->description }}</textarea>
						</div>
					</div>
					<div class="form-group">
						<div class="col-md-4">
							<button type="submit" onclick="crop()" class="btn col-md-12 btn-primary">Azuriraj</button>
						</div>
					</div>
				</form>
			</div> 
		</div>
	</div>

@endsection

@section('external-js')
<script>

	// Add file input field
	$("#btn-picture").click(function (event) {
		event.preventDefault();
		$(this).addClass('hidden');
		$("#input-picture").removeClass('hidden');
	});

	$(function () {
		var image = $("#image");
		var input = $("#profile-img");

		// Display image before upload
		$("input:file").change(function() {
			if ($(this).val() != '') 
			{
				image.cropper('destroy');

				var reader = new FileReader();
				reader.readAsDataURL(this.files[0]);
				reader.onload = function (e) {

					$("#image").width("100%");
					image.attr('src', this.result);

					// Cropper options
					var options = {
						aspectRatio: 1 / 1,
						minContainerWidth: 350,
						minContainerHeight: 350,
						minCropBoxWidth: 100,
						minCropBoxHeight: 100,
						minCanvasWidth: 300,
						minCanvasHeight: 300,
						cropBoxResizable: true,
						viewMode: 2,
						responsive: true,
						strict: false,
						preview: '.ac-preview'
					};
					image.cropper(options);
				}
			}
		});
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
					console.log('Upload success');
				},
				error: function () {
					console.log('Upload error');
				}
			});
		});
	}

</script>
@endsection