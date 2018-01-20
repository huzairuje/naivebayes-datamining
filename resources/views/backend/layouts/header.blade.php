<header class="main-header">
    <a href="{!! route('welcome') !!}" class="logo">
        <span class="logo-mini">{!! trans('app.logo_mini') !!}</span>
        <span class="logo-lg">{!! trans('app.logo') !!}</span>
    </a>
    <nav class="navbar navbar-static-top">
        <a href="javascript:void(0);" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </a>
        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <li class="dropdown user user-menu">
                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown">
                        <img class="user-image" alt="User Avatar" {!! auth()->user()->avatar ? 'src="'.asset(auth()->user()->avatar).'"' : 'data-src="holder.js/100x100?text=Avatar"' !!}>
                        <span class="hidden-xs">{!! auth()->user()->name !!}</span>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="user-header">
                            <img class="img-circle" alt="User Avatar" {!! auth()->user()->avatar ? 'src="'.asset(auth()->user()->avatar).'"' : 'data-src="holder.js/100x100?text=Avatar"' !!}>
                            <p>{!! auth()->user()->name !!} <small>Member since {!! \Carbon\Carbon::parse(auth()->user()->created_at)->format('M Y') !!}</small></p>
                        </li>
                        <li class="user-footer">
                            <div class="pull-left">
                                <a href="{!! route('backend::profile.index') !!}" class="btn btn-primary btn-block">{!! trans('button.profile') !!}</a>
                            </div>
                            <div class="pull-right">
                                <a href="{!! route('auth::logout.get') !!}" class="btn btn-primary btn-block">{!! trans('button.logout') !!}</a>
                            </div>
                        </li>
                    </ul>
                </li>
                <!--
                <li>
                    <a href="javascript:void(0);" data-toggle="control-sidebar">{!! trans('icon.settings') !!}</a>
                </li>
                -->
            </ul>
        </div>
    </nav>
</header>
