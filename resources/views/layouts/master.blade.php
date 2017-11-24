<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <!-- JQuery -->
    <script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
    
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">

	<!-- Font Awesome -->
    <script src="https://use.fontawesome.com/94a3cab706.js"></script>

    <!-- Cropper JS -->
    <link  href="{{ asset('assets/cropper/cropper.css') }}" rel="stylesheet">
    <script src="{{ asset('assets/cropper/cropper.js') }}"></script>

    <!-- CSRF Token for AJAX -->
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <title>Vicoteka</title>
</head>
<body>

	<div class="row">
		@include('includes.header')

		@yield('content')

		@include('includes.footer')
	</div>

    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>

    <!-- Bootstrap Core JavaScript -->
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>

    @yield('external-js')
</body>
</html>