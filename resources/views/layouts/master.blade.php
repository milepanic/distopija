<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

	<!-- Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <!-- Bootstrap CSS -->
    {{-- <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.css') }}"> --}}

    <!-- Theme Styles CSS -->
    {{-- <link rel="stylesheet" type="text/css" href="{{ asset('css/theme-styles.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/blocks.css') }}"> --}}

    <!-- JQuery -->
    <script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
    
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">

	<!-- Font Awesome -->
    <script src="https://use.fontawesome.com/94a3cab706.js"></script>

    <!-- CSRF Token for AJAX -->
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    @yield('external-include')

    <title>Vicoteka</title>
</head>
<body>

	<div class="row">
		@include('includes.header')

		<div class="container">
            <div class="row">
                @yield('content')
            </div>      
        </div>

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
    
    @yield('main-js')
    @yield('external-js')
</body>
</html>