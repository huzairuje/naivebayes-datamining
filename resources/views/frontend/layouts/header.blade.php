<nav class="navbar navbar-default">
    <div class="container">
        <div class="navbar-header">
            <a href="{!! route('welcome') !!}" class="navbar-brand">{!! trans('app.logo') !!}</a>
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
                <i class="fa fa-bars"></i>
            </button>
        </div>
        <div class="collapse navbar-collapse">
            @if (auth()->guest())
            <ul class="nav navbar-nav navbar-right">
                <li><a href="{!! route('auth::register.get') !!}">{!! trans('button.register') !!}</a></li>
                <li><a href="{!! route('auth::login.get') !!}">{!! trans('button.login') !!}</a></li>
            </ul>
            @else
            <p class="navbar-text navbar-right">Signed in as <a href="javascript:void(0);" class="navbar-link">{!! auth()->user()->name !!}</a></p
            @endif
        </div>
    </div>
</nav>
