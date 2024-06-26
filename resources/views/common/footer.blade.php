<!--   Core JS Files   -->
<!--   Core JS Files   -->
<script src="{{ url('assets/js/core/jquery.js') }}"></script>
<script src="{{ url('assets/js/core/popper.min.js') }}"></script>
<script src="{{ url('assets/lib/toastr/toastr.js') }}"></script>
<script src="{{ url('assets/lib/toastr/toastr.min.js') }}"></script>
<script src="{{ url('assets/js/core/bootstrap.min.js') }}"></script>
<script src="{{ url('assets/js/plugins/perfect-scrollbar.min.js') }}"></script>
<script src="{{ url('assets/js/plugins/smooth-scrollbar.min.js') }}"></script>

<script src="{{ url('assets/lib/sweetalert2/sweetalert2.js') }}"></script>
<!--  Chart -->
{{-- <script src="../assets/js/plugins/chartjs.min.js"></script> --}}

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
<script src="{{ url('assets/js/material-dashboard.min.js?v=3.1.0') }}"></script>
<script>
    function sweet_alert_cancel() {
        Swal.fire({
            title: 'Cancelled',
            text: 'Cancelled Deletion :)',
            icon: 'error',
            customClass: {
                confirmButton: 'btn btn-success'
            }
        });
    }

    function sweet_alert_confirm(str_text, title) {
        Swal.fire({
            icon: 'success',
            title: title,
            text: str_text,
            customClass: {
                confirmButton: 'btn btn-success'
            }
        });
    }

    function success_toastr(msg) {
        toastr['success'](msg, '', {
            timeOut: 1500
        });
    }

    function error_toastr(msg) {
        toastr['error'](msg, '', {
            timeOut: 2500
        });
    }
</script>
