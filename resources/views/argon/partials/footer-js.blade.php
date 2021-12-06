<!--   Core JS Files   -->
<script src="/argon-design-system/assets/js/core/jquery.min.js" type="text/javascript"></script>
<script src="/argon-design-system/assets/js/core/popper.min.js" type="text/javascript"></script>
<script src="/argon-design-system/assets/js/core/bootstrap.min.js" type="text/javascript"></script>
<script src="/argon-design-system/assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>
<!--  Plugin for Switches, full documentation here: http://www.jque.re/plugins/version3/bootstrap.switch/ -->
<script src="/argon-design-system/assets/js/plugins/bootstrap-switch.js"></script>
<!--  Plugin for the Sliders, full documentation here: http://refreshless.com/nouislider/ -->
<script src="/argon-design-system/assets/js/plugins/nouislider.min.js" type="text/javascript"></script>
<script src="/argon-design-system/assets/js/plugins/moment.min.js"></script>
<script src="/argon-design-system/assets/js/plugins/datetimepicker.js" type="text/javascript"></script>
<script src="/argon-design-system/assets/js/plugins/bootstrap-datepicker.min.js"></script>
<!-- Control Center for Argon UI Kit: parallax effects, scripts for the example pages etc -->
<script src="/argon-design-system/assets/js/argon-design-system.min.js?v=1.2.2" type="text/javascript"></script>
<script src="//cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js" type="text/javascript"></script>


@section('js')
    <script>
        $(document).ready( function () {
            $('.datatable').DataTable({
                language: {
                    url: "http://cdn.datatables.net/plug-ins/1.10.20/i18n/Russian.json"
                },
                "info":     false,
                "paging":   false,
            });
        } );
    </script>
@show
