<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>

<a href="#" id="login-btn">Log in with Facebook</a>
{{--<script>--}}
{{--    window.fbAsyncInit = function() {--}}
{{--        FB.init({--}}
{{--            appId      : '1125732181473704',--}}
{{--            xfbml      : true,--}}
{{--            version    : 'v15.0'--}}
{{--        });--}}
{{--        FB.AppEvents.logPageView();--}}
{{--    };--}}

{{--    (function(d, s, id){--}}
{{--        var js, fjs = d.getElementsByTagName(s)[0];--}}
{{--        if (d.getElementById(id)) {return;}--}}
{{--        js = d.createElement(s); js.id = id;--}}
{{--        js.src = "https://connect.facebook.net/en_US/sdk.js";--}}
{{--        fjs.parentNode.insertBefore(js, fjs);--}}
{{--    }(document, 'script', 'facebook-jssdk'));--}}
{{--</script>--}}
<script>
    window.fbAsyncInit = function() {
        FB.init({
            appId            : '1125732181473704',
            autoLogAppEvents : true,
            xfbml            : true,
            version          : 'v15.0'
        });
    };
</script>
<script type="text/javascript">
    document.getElementById('login-btn').onclick = function() {
        FB.login(function(response) {
            console.log('FB.login response', response);
        }, {scope: 'email,user_likes,pages_manage_metadata, pages_messaging'});
        return false;
    }
</script>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js"></script>
</body>
</html>
