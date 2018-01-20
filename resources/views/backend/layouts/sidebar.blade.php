<aside class="main-sidebar">
    <section class="sidebar">
        <div class="user-panel">
            <div class="pull-left image">
                <img class="img-circle" alt="User Avatar" {!! auth()->user()->avatar ? 'src="'.asset(auth()->user()->avatar).'"' : 'data-src="holder.js/100x100?text=Avatar"' !!}>
            </div>
            <div class="pull-left info">
                <p>{!! auth()->user()->name !!}</p>
                <a href="javascript:void(0);"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>
        <!-- <form action="javascript:void(0);" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" class="form-control" name="q" placeholder="Search...">
                <span class="input-group-btn">
                    <button type="submit" class="btn btn-flat" name="search">
                        {!! trans('icon.search') !!}
                    </button>
                </span>
            </div>
        </form> -->
        <ul class="sidebar-menu">
            <li class="header">MAIN NAVIGATION</li>
            <li{!! request()->is('admin/dashboard') ? ' class="active"' : '' !!}><a href="{!! route('backend::dashboard.index') !!}"><i class="fa fa-home"></i><span>Dashboard</span></a></li>
            {!! (new \App\Libraries\SidebarLibrary)->sidebar($slug, auth()->user()->user_role()->firstOrFail()->role_id) !!}
        </ul>
    </section>
</aside>
