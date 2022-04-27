<!-- <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script> -->
<script>
    $.widget.bridge('uibutton', $.ui.button)
</script>
<script src="{{ asset('/admin/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script> -->
<!-- <script src="{{ asset('/admin/plugins/morris/morris.min.js')}}"></script> -->
<!-- <script src="{{ asset('/admin/plugins/sparkline/jquery.sparkline.min.js')}}"></script> -->
<!-- <script src="{{ asset('/admin/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js')}}"></script> -->
<!-- <script src="{{ asset('/admin/plugins/jvectormap/jquery-jvectormap-world-mill-en.js')}}"></script> -->
<!-- <script src="{{ asset('/admin/plugins/knob/jquery.knob.js')}}"></script> -->
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.2/moment.min.js"></script> -->
<script src="{{ asset('/admin/plugins/daterangepicker/daterangepicker.js')}}"></script>
<!-- <script src="{{ asset('/admin/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js')}}"></script> -->
<!-- <script src="{{ asset('/admin/plugins/slimScroll/jquery.slimscroll.min.js')}}"></script> -->
<!-- <script src="{{ asset('/admin/plugins/fastclick/fastclick.js')}}"></script> -->
<!-- <script src="{{ asset('/admin/plugins/ionslider/ion.rangeSlider.min.js')}}"></script> -->
<!-- AdminLTE App -->
<script src="{{asset('/admin/dist/js/adminlte.js')}}"></script>
<!-- OPTIONAL SCRIPTS -->
<!-- <script src="{{asset('/admin/dist/js/demo.js')}}"></script> -->
<!-- AdminLTE App -->
<!-- <script src="{{asset('/admin/dist/js/pages/dashboard.js')}}"></script> -->
<!-- <script src="{{asset('/admin/dist/js/pages/dashboard2.js')}}"></script> -->
<!-- <script src="{{asset('/admin/dist/js/pages/dashboard3.js')}}"></script> -->
<!-- <script src="{{asset('/admin/plugins/chart.js/Chart.min.js')}}"></script> -->
<script src="{{asset('/admin/plugins/select2/select2.full.js')}}"></script>
<script src="{{asset('/admin/plugins/jQuery-Toast-Message-Plugin/build/toastr.min.js')}}"></script>
<!-- AdminLTE App -->


<!-- <script src="https://unpkg.com/ionicons@5.2.3/dist/ionicons.js"></script> -->
<script src="{{ asset('/admin/plugins/font-awesome/js/all.js') }}"></script>
<!-- <script src="{{ asset('/admin/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js') }}"></script> -->


<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<!-- AdminLTE for demo purposes -->

<script src="{{ asset('js/admin.js') }}"></script>
<script src="{{ asset('/admin/plugins/datepicker/persian-date.min.js')}}"></script>
<script src="{{ asset('/admin/plugins/datepicker/persian-datepicker.min.js')}}"></script>

@yield('script')
<!-- AdminLTE App -->
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<!-- AdminLTE for demo purposes -->




<script>
    $(document).ready(function() {
        toastr.options = {
            "closeButton": true,
            "debug": false,
            "newestOnTop": false,
            "progressBar": true,
            "positionClass": "toast-top-left",
            "preventDuplicates": false,
            "onclick": null,
            "showDuration": "300",
            "hideDuration": "1000",
            "timeOut": "30000",
            "extendedTimeOut": "30000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        }
        @if($errors->any())
        @foreach($errors -> all() as $error)
        var error = '{{ $error }}';
        toastr["error"](error);
        @endforeach
        @endif

        @foreach(['success', 'error', 'info', 'warning'] as $msgType)
        @if(session()->has($msgType))
        var msgType = '{{ $msgType }}';
        var msgText = '{{ session($msgType) }}';
        toastr[msgType](msgText);
        @endif
        @endforeach
    });
</script>

<button class='btn-loading-black invisible'></button>
<button class='btn-loading-white invisible'></button>