<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Automaat</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="{{asset("assets/css/vendor/bootstrap.min.css")}}" rel="stylesheet">
    <link href="{{asset("assets/css/flat-ui.min.css")}}" rel="stylesheet">
    <link href="{{asset("assets/css/app.css")}}" rel="stylesheet">

    <link rel="shortcut icon" href="img/favicon.ico">
</head>
<body>
<div class="container">
    <nav class="navbar navbar-inverse navbar-embossed" role="navigation">
        <div class="navbar-header">
            <a class="navbar-brand" href="{{Request::root()}}">Automaat</a>
        </div>

        <ul class="nav navbar-nav navbar-left">
            <li><a href="{{route('overview')}}">Overview</a></li>
            <li><a href="#fakelink">Status</a></li>
            <li><a href="{{route('tickets')}}">Tickets</a></li>
        </ul>
    </nav><!-- /navbar -->
    <div id="content">
    @yield('content')
    </div>
</div>
<!-- /.container -->


<!-- jQuery (necessary for Flat UI's JavaScript plugins) -->
<script src="{{asset("assets/js/vendor/jquery.min.js")}}"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="{{asset("assets/js/vendor/video.js")}}"></script>
<script src="{{asset("assets/js/flat-ui.min.js")}}"></script>

</body>
</html>
