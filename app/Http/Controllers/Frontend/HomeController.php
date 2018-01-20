<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->menu         = trans('menu.home.name');
        $this->route        = $this->routes['frontend'].'home';
        $this->slug         = $this->slugs['frontend'].'home';
        $this->view         = $this->views['frontend'].'home';
        # share parameters
        $this->share();
    }

    public function index()
    {
        return view($this->view.'.index');
    }
}
