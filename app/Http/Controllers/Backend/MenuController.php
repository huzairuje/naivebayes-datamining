<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Validator;

class MenuController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->menu         = trans('menu.menu.name');
        $this->route        = $this->routes['backend'].'menu';
        $this->slug         = $this->slugs['backend'].'menu';
        $this->view         = $this->views['backend'].'menus';
        $this->breadcrumb   = '<li><a href="'.route($this->route.'.index').'">'.$this->menu.'</a></li>';
        # share parameters
        $this->share();
        # init model
        $this->model        = new \App\Models\Menu;
        $this->menuLibrary  = new \App\Libraries\MenuLibrary;
    }

    public function index()
    {
        try {
            $breadcrumb = $this->breadcrumbs($this->breadcrumb.'<li class="active">'.trans('label.view').'</li>');
            $treemenu = $this->menuLibrary->menu();
            return view($this->view.'.index', compact('breadcrumb', 'treemenu'));
        } catch (\Exception $e) {
            abort(500);
        }
    }

    public function detail($id)
    {
        try {
            $id = decodeids($id);
            $data = $this->model->sql()->findOrFail($id);
            return view($this->view.'.form.detail', compact('data'));
        } catch (\Exception $e) {
            abort(500);
        }
    }

    public function create()
    {
        try {
            $parents = $this->model->where([['slug', null],['controller', null],['model', null]])->get();
            return view($this->view.'.form.create', compact('parents'));
        } catch (\Exception $e) {
            abort(500);
        }
    }

    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required|max:255',
                'sequence' => 'required|integer',
                'sidebar' => 'required',
            ]);

            if ($validator->fails()) {
                return redirect()
                    ->route($this->route.'.create')
                    ->withErrors($validator)
                    ->withInput();
            }

            $data = $this->model;
            $data->parent_id = empty($request->parent) ? null : $request->parent ;
            $data->name = $request->name;
            $data->icon = 'fa fa-folder';
            $data->sequence = $request->sequence;
            $data->sidebar = $request->sidebar;
            $data->description = $request->description;
            $data->save();

            action_message('create', $this->menu);
            return json_encode(['redirect' => route($this->route.'.index')]);
        } catch (\Exception $e) {
            abort(500);
        }
    }

    public function edit($id)
    {
        try {
            $id = decodeids($id);
            $data = $this->model->findOrFail($id);
            $parents = $this->model->where([['slug', null],['controller', null],['model', null],['id', '!=', $id]])->get();
            return view($this->view.'.form.edit', compact('data', 'parents'));
        } catch (\Exception $e) {
            abort(500);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $id = decodeids($id);
            $data = $this->model->findOrFail($id);

            $validator = Validator::make($request->all(), [
                'name' => 'required|max:255',
                'sequence' => 'required|integer',
                'sidebar' => 'required',
            ]);

            if ($validator->fails()) {
                return redirect()
                    ->route($this->route.'.edit', encodeids($id))
                    ->withErrors($validator)
                    ->withInput();
            }

            $data->parent_id = empty($request->parent) ? null : $request->parent ;
            $data->name = $request->name;
            $data->sequence = $request->sequence;
            $data->sidebar = $request->sidebar;
            $data->description = $request->description;
            $data->update();

            action_message('update', $this->menu);
            return json_encode(['redirect' => route($this->route.'.index')]);
        } catch (\Exception $e) {
            abort(500);
        }
    }

    public function delete($id)
    {
        try {
            $id = decodeids($id);
            $data = $this->model->sql()->findOrFail($id);
            return view($this->view.'.form.delete', compact('data'));
        } catch (\Exception $e) {
            abort(500);
        }
    }

    public function destroy($id)
    {
        try {
            $id = decodeids($id);
            $data = $this->model->findOrFail($id);
            $data->delete();
            action_message('delete', $this->menu);
            return redirect()->route($this->route.'.index');
        } catch (\Exception $e) {
            abort(500);
        }
    }
}
