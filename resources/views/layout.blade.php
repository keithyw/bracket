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
<div id="content" >
    @yield('content')
</div>
<script>
    window.twttr = (function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0],
                t = window.twttr || {};
        if (d.getElementById(id)) return t;
        js = d.createElement(s);
        js.id = id;
        js.src = "https://platform.twitter.com/widgets.js";
        fjs.parentNode.insertBefore(js, fjs);

        t._e = [];
        t.ready = function(f) {
            t._e.push(f);
        };

        return t;
    }(document, "script", "twitter-wjs"));
</script>
<script src="https://js.pusher.com/3.0/pusher.min.js"></script>
<script src="/js/common.js"></script>
<script src="/js/module.js"></script>
</body>
</html>