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
<script src="https://js.pusher.com/3.0/pusher.min.js"></script>
<script src="/js/common.js"></script>
<script src="/js/module.js"></script>
</body>
</html>