<!--   Core JS Files   -->
<script src="{{ url("assets/js/core/jquery.js") }}"></script>
<script src="{{ url("assets/js/core/popper.min.js") }}"></script>
<script src="{{ url("assets/js/core/bootstrap.min.js") }}"></script>


<script src="{{ url('assets/lib/toastr/toastr.js') }}"></script>
<script src="{{ url('assets/lib/toastr/toastr.min.js') }}"></script>

<script>
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

