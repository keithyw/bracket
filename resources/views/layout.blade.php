<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <title>
        @section('title')
        @show
    </title>
    <link href="/css/main.css" rel="stylesheet" type="text/css" media="screen"/>
</head>
<body>
<div id="content" class="content">
    @yield('content')
</div>
<?php $key = Config::get('services.google_maps') ?>
<script async defer src="https://maps.googleapis.com/maps/api/js"></script>
<script src="/js/common.js"></script>
<script src="/js/module.js"></script>
</body>
</html>