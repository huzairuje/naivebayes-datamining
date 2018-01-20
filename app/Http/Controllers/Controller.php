<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function __construct()
    {
        $this->routes = [
            'frontend'  => 'frontend::',
            'backend'   => 'backend::',
        ];
        $this->slugs = [
            'frontend'  => '',
            'backend'   => 'admin/',
        ];
        $this->views = [
            'frontend'  => 'frontend.',
            'backend'   => 'backend.',
        ];
    }

    public function breadcrumbs($children = null)
    {
        $breadcrumb = null;
        if (!empty($children)) {
            $breadcrumb .= '<ol class="breadcrumb">';
            $breadcrumb .= '<li><a href="'.route($this->routes['backend'].'welcome').'"><i class="fa fa-home fa-fw"></i>'.trans('label.admin').'</a></li>';
            $breadcrumb .= $children;
            $breadcrumb .= '</ol>';
        }
        return $breadcrumb;
    }

    public function share()
    {
        view()->share([
            'menu'  => $this->menu,
            'route' => $this->route,
            'slug'  => $this->slug,
            'view'  => $this->view,
        ]);
    }
}
