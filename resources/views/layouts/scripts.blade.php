<!-- Global -->
<script type="text/javascript" src="/{{ config('path.plugins') }}/jquery/jquery-2.2.4.min.js"></script>
<script type="text/javascript" src="/{{ config('path.plugins') }}/jquery-ui/1.12.1/jquery-ui.min.js"></script>
<script type="text/javascript" src="/{{ config('path.plugins') }}/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script type="text/javascript" src="/{{ config('path.plugins') }}/holder.js/2.9.0/holder.min.js"></script>
@yield('scripts')
@stack('scripts')
