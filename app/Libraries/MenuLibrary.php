<?php

namespace App\Libraries;

class MenuLibrary extends TreeLibrary
{
    public function menu()
    {
        $tree = (new \App\Models\Menu)->orderBy('sequence')->get()->toArray();
        $tree = $this->arrayTree($tree);

        $html  = '<ul class="list-group">';
            $html .= $this->treeMenu($tree);
        $html .= '</ul>';

        return $html;
    }

    public function treeMenu(array $array, &$html = null)
    {
        foreach ($array as $value) {
            $children = false;

            if (isset($value['children']) && sizeof($value['children']) > 0) {
                $children = true;
            }

            $html .= '<li class="list-group-item">';

            if ($value['icon'] != null) {
                $html .= print_icon($value['icon']);
            }

            $html .= '&nbsp;'.$value['name'];

            $html .= '<ul class="action">';
            if (check_access('detail', 'admin/menu')) {
                $html .= '<li><a data-href="'.route('backend::menu.detail', encodeids($value['id'])).'" class="btn btn-xs btn-success btn-modal-action" title="'.trans('label.detail').'" data-title="'.trans('form.detail', ['menu' => trans('menu.menu.name')]).'" data-icon="fa fa-search fa-fw" data-background="modal-primary">'.trans('icon.detail').'</a></li>';
            }
            if (check_access('update', 'admin/menu')) {
                $html .= '<li><a data-href="'.route('backend::menu.edit', encodeids($value['id'])).'" class="btn btn-xs btn-primary btn-modal-form" title="'.trans('label.edit').'" data-title="'.trans('form.edit', ['menu' => trans('menu.menu.name')]).'" data-icon="fa fa-edit fa-fw" data-background="modal-primary">'.trans('icon.edit').'</a></li>';
            }
            if (check_access('delete', 'admin/menu') && ! $children && $value['slug']==null && $value['controller']==null && $value['model']==null) {
                $html .= '<li><a data-href="'.route('backend::menu.delete', encodeids($value['id'])).'" class="btn btn-xs btn-danger btn-modal-action" title="'.trans('label.delete').'" data-title="'.trans('form.delete', ['menu' => trans('menu.menu.name')]).'" data-icon="fa fa-trash-o fa-fw" data-background="modal-danger">'.trans('icon.delete').'</a></li>';
            }
            $html .= '</ul>';

            $html .= '</li>';

            if ($children) {
                $html .= '<li class="list-group-item children">';
                    $html .= '<ul class="list-group">';
                        $this->treeMenu($value['children'], $html);
                    $html .= '</ul>';
                $html .= '</li>';
            }
        }

        return $html;
    }
}
