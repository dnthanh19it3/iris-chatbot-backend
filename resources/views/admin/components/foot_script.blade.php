<!-- ./wrapper -->

<!-- jQuery -->
<script src="{{ asset("plugins/jquery/jquery.min.js") }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset("plugins/bootstrap/js/bootstrap.bundle.min.js") }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset("dist/js/adminlte.min.js") }}"></script>
<!-- AdminLTE for demo purposes -->
{{--<script src="../../dist/js/demo.js"></script>--}}
<!-- Faceook login sdk -->
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
