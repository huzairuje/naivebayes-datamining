<!-- Global -->
<link rel="stylesheet" type="text/css" href="/{{ config('path.css') }}/fonts.css">
<link rel="stylesheet" type="text/css" href="/{{ config('path.plugins') }}/jquery-ui/1.12.1/jquery-ui.min.css">
<link rel="stylesheet" type="text/css" href="/{{ config('path.plugins') }}/bootstrap/3.3.7/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="/{{ config('path.plugins') }}/font-awesome/4.7.0/css/font-awesome.min.css">
@yield('styles')
@stack('styles')
