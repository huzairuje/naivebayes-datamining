<!-- Plugins -->
<script type="text/javascript" src="/{{ config('path.plugins') }}/datatables/1.10.12/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="/{{ config('path.plugins') }}/datatables/1.10.12/js/dataTables.bootstrap.min.js"></script>
<script type="text/javascript" src="/{{ config('path.plugins') }}/moment.js/2.15.1/moment.min.js"></script>
<script type="text/javascript" src="/{{ config('path.plugins') }}/datetimepicker/4.17.42/js/bootstrap-datetimepicker.min.js"></script>
<script type="text/javascript" src="/{{ config('path.plugins') }}/daterangepicker/2.1.24/daterangepicker.js"></script>
<script type="text/javascript" src="/{{ config('path.plugins') }}/datepicker/1.6.1/js/bootstrap-datepicker.min.js"></script>
<script type="text/javascript" src="/{{ config('path.plugins') }}/timepicker/0.5.2/js/bootstrap-timepicker.min.js"></script>
<script type="text/javascript" src="/{{ config('path.plugins') }}/fastclick/1.0.6/fastclick.min.js"></script>
<script type="text/javascript" src="/{{ config('path.plugins') }}/icheck/1.0.2/icheck.min.js"></script>
<script type="text/javascript" src="/{{ config('path.plugins') }}/inputmask/3.3.4/jquery.inputmask.bundle.min.js"></script>
<script type="text/javascript" src="/{{ config('path.plugins') }}/select2/4.0.3/js/select2.min.js"></script>
<script type="text/javascript" src="/{{ config('path.plugins') }}/slimscroll/1.3.8/jquery.slimscroll.min.js"></script>

<!-- Themes -->
<script type="text/javascript" src="/{{ config('path.themes.backend') }}/js/app.min.js"></script>

<!-- Scripts -->
<script type="text/javascript" src="/{{ config('path.js') }}/scripts.js"></script>

<!-- CSRF Token -->
<script type="text/javascript">
$(function(){
    window.Laravel = <?php echo json_encode(['csrfToken' => csrf_token()]) ?>;
});
</script>
