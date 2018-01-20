<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->menu         = trans('menu.dashboard.name');
        $this->route        = $this->routes['backend'].'dashboard';
        $this->slug         = $this->slugs['backend'].'dashboard';
        $this->view         = $this->views['backend'].'dashboard';
        $this->breadcrumb   = '<li><a href="'.route($this->route.'.index').'">'.$this->menu.'</a></li>';
        # share parameters
        $this->share();
    }

    public function index()
    {
        try {
            $breadcrumb = $this->breadcrumbs($this->breadcrumb.'<li class="active">'.trans('label.view').'</li>');
            return view($this->view.'.index', compact('breadcrumb'));
        } catch (\Exception $e) {
            abort(500);
        }
    }
}
