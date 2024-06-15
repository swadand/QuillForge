<!--   Core JS Files   -->
<!--   Core JS Files   -->
<script src="{{ url("assets/js/core/jquery.js") }}"></script>
<script src="{{ url("assets/js/core/popper.min.js") }}"></script>
<script src="{{ url("assets/js/core/bootstrap.min.js") }}"></script>
<script src="{{ url("assets/js/plugins/perfect-scrollbar.min.js") }}"></script>
<script src="{{ url("assets/js/plugins/smooth-scrollbar.min.js") }}"></script>

<!--  Chart -->
<!-- <script src="../assets/js/plugins/chartjs.min.js"></script> -->

<script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
        var options = {
            damping: '0.5'
        }
        Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
</script>
<!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
<script src="{{ url("assets/js/material-dashboard.min.js?v=3.1.0") }}"></script>