<!doctype html>
<html class="no-js" lang="">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>{{ $title }}</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <!-- Place favicon.ico and apple-touch-icon.png in the root directory -->
        <link rel="apple-touch-icon" href="apple-touch-icon.png">

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/4.2.0/normalize.min.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js"></script>

        <!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

		<!-- Optional theme -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

        <!--<link rel="stylesheet" href="css/main.css"> -->
    </head>
    <body>
        <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->

        <!-- Add your site or application content here -->
        <div class="wrapper">
	        <div class="navbar">
	        	<div class="navbar-inner">
	        		<div class="container" style="width: auto;">
	        			<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
	        				<span class="icon-bar"></span>
	        				<span class="icon-bar"></span>
	        				<span class="icon-bar"></span>
	        			</a>
	        			<a class="brand" href="#"><img src="{{ asset('images/'.$store_logo) }}"></a>
	        			<div class="nav-collapse">
	        			</div><!-- /.nav-collapse -->
	        		</div>
	        	</div><!-- /navbar-inner -->
	        </div>
	        <div class="row">
	        	<div class="col-xs-12">
	        		<h3></h3>
	        		<p>
	        			{{ Lang::get('lang.email_aprove_1') }} <pre>{{ $factura_id }}</pre> {{ Lang::get('lang.email_aprove_2') }}
	        		</p>	
	        	</div>
	        </div>
        </div>
        <script src="http://code.jquery.com/jquery-2.1.4.min.js"></script>
        <!-- Latest compiled and minified JavaScript -->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

        
    </body>
</html>