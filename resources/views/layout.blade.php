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
<script src="https://fb.me/react-0.13.1.js"></script>
<script src="https://fb.me/JSXTransformer-0.13.1.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="https://js.pusher.com/3.0/pusher.min.js"></script>
<script src="/js/app.js" type="text/javascript"></script>
<script src="/js/common.js"></script>
<script src="/js/module.js"></script>
</body>
</html>