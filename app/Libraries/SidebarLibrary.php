<?php

namespace App\Libraries;

class SidebarLibrary extends TreeLibrary
{
    public function sidebar($slug)
    {
        $menu = (new \App\Models\Menu)->where('slug', $slug);
        $menu = $menu->count() ? $menu->firstOrFail()->id : null ;
        $tree = (new \App\Models\Menu)->where('sidebar', 1)->orderBy('sequence')->get()->toArray();
        $tree = $this->arrayTree($tree);
        $tree = $this->treeSidebar($tree, $menu);
        return $tree;
    }

    public function treeSidebarIds($menu)
    {
        $tree = (new \App\Models\Menu)->where('sidebar', 1)->select('id','parent_id')->orderBy('sequence')->get()->toArray();
        $tree = $this->arrayTreeIds($tree);
        $tree = is_array($this->arrayTreeSearch($tree, $menu)) ? $this->arrayTreeSearch($tree, $menu) : [];
        $tree = $this->arrayTreeKeys($tree);
        return $tree;
    }

    public function treeSidebar(array $array, $menu, &$html = null)
    {
        foreach ($array as $value) {
            $children = false;

            if (isset($value['children']) && sizeof($value['children']) > 0) {
                $children = true;
            }

            if ($children) {
                $html .= '<li class="treeview'.(in_array($value['id'], $this->treeSidebarIds($menu)) ? ' active' : '').'">';
            } else {
                if ($value['slug'] != null && $value['controller'] != null && $value['model'] != null) {
                    $index = config('access.menu.'.$value['slug'].'.index');
                    if (check_access($index, $value['slug'])) {
                        $html .= '<li'.(in_array($value['id'], $this->treeSidebarIds($menu)) ? ' class="active"' : '').'>';
                    } else {
                        $html .= '<li class="hidden'.(in_array($value['id'], $this->treeSidebarIds($menu)) ? ' active' : '').'">';
                    }
                } else {
                    $html .= '<li class="hidden'.(in_array($value['id'], $this->treeSidebarIds($menu)) ? ' active' : '').'">';
                }
            }

            if ($value['slug'] != null) {
                $html .= '<a href="'. url($value['slug']) .'">';
            } else {
                $html .= '<a href="javascript:void(0)">';
            }

            if ($value['icon'] != null) {
                $html .= print_icon($value['icon']);
            }

            $html .= '<span>'. $value['name'] .'</span>';

            if ($children) {
                $html .= '<span class="pull-right-container">';
                    $html .= '<i class="fa fa-angle-left pull-right"></i>';
                $html .= '</span>';
            }

            $html .= '</a>';

            if ($children) {
                $html .= '<ul class="treeview-menu">';
                    $this->treeSidebar($value['children'], $menu, $html);
                $html .= '</ul>';
            }

            $html .= '</li>';
        }

        return $html;
    }
}
