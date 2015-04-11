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
    <div id="content">
        <form class="login-form" method="POST">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="form-group">
                <input type="text" class="form-control login-field" value="" placeholder="Enter your name" name="username">
                <label class="login-field-icon fui-user" for="login-name"></label>
            </div>

            <div class="form-group">
                <input type="password" class="form-control login-field" value="" placeholder="Password" name="password">
                <label class="login-field-icon fui-lock" for="login-pass"></label>
            </div>

            <button type="submit" class="btn btn-primary btn-lg btn-block">Log in</button>
        </form>
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
