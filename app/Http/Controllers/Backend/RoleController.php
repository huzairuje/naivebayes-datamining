<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Datatables;
use Validator;

class RoleController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->menu         = trans('menu.role.name');
        $this->route        = $this->routes['backend'].'role';
        $this->slug         = $this->slugs['backend'].'role';
        $this->view         = $this->views['backend'].'roles';
        $this->breadcrumb   = '<li><a href="'.route($this->route.'.index').'">'.$this->menu.'</a></li>';
        # share parameters
        $this->share();
        # init model
        $this->model        = new \App\Models\Role;
        $this->menuModel    = new \App\Models\Menu;
        $this->roleLibrary  = new \App\Libraries\RoleLibrary;
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

    public function datatables()
    {
        try {
            $data = numrows($this->model->sql()->get());
            return Datatables::of($data)
                ->addColumn('action', function ($data) {
                    $action  = null;
                    if (check_access('detail', $this->slug)) {
                        $action .= '<a data-href="'.route($this->route.'.detail', encodeids($data->id)).'" class="btn btn-xs btn-success btn-modal-action" title="'.trans('label.detail').'" data-title="'.trans('form.detail', ['menu' => $this->menu]).'" data-icon="fa fa-search fa-fw" data-background="modal-primary">'.trans('icon.detail').'</a>';
                    }
                    if (check_access('update', $this->slug)) {
                        $action .= '<a data-href="'.route($this->route.'.edit', encodeids($data->id)).'" class="btn btn-xs btn-primary btn-modal-form" title="'.trans('label.edit').'" data-title="'.trans('form.edit', ['menu' => $this->menu]).'" data-icon="fa fa-edit fa-fw" data-background="modal-primary">'.trans('icon.edit').'</a>';
                    }
                    if (check_access('delete', $this->slug)) {
                        $action .= '<a data-href="'.route($this->route.'.delete', encodeids($data->id)).'" class="btn btn-xs btn-danger btn-modal-action" title="'.trans('label.delete').'" data-title="'.trans('form.delete', ['menu' => $this->menu]).'" data-icon="fa fa-trash-o fa-fw" data-background="modal-danger">'.trans('icon.delete').'</a>';
                    }
                    return $action;
                })
                ->make(true);
        } catch (\Exception $e) {
            abort(500);
        }
    }

    public function detail($id)
    {
        try {
            $id = decodeids($id);
            $data = $this->model->sql()->findOrFail($id);
            $treerole = $this->roleLibrary->role($id, true);
            return view($this->view.'.form.detail', compact('data', 'treerole'));
        } catch (\Exception $e) {
            abort(500);
        }
    }

    public function create()
    {
        try {
            $treerole = $this->roleLibrary->role();
            return view($this->view.'.form.create', compact('treerole'));
        } catch (\Exception $e) {
            abort(500);
        }
    }

    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required|max:255',
            ]);

            if ($validator->fails()) {
                return redirect()
                    ->route($this->route.'.create')
                    ->withErrors($validator)
                    ->withInput();
            }

            $data = $this->model;
            $data->name = $request->name;
            $data->description = $request->description;
            $data->save();

            foreach ($request->access as $menu => $access) {
                $access = implode(config('access.delimiter'), $access);
                $data->role_menu()->create([
                        'menu_id' => $menu,
                        'access' => $access
                    ]);
            }

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
            $treerole = $this->roleLibrary->role($id);
            return view($this->view.'.form.edit', compact('data', 'treerole'));
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
            ]);

            if ($validator->fails()) {
                return redirect()
                    ->route($this->route.'.edit', encodeids($id))
                    ->withErrors($validator)
                    ->withInput();
            }

            $data->name = $request->name;
            $data->description = $request->description;
            $data->update();

            $data->role_menu()->delete();

            foreach ($request->access as $menu => $access) {
                $access = implode(config('access.delimiter'), $access);
                $data->role_menu()->create([
                        'menu_id' => $menu,
                        'access' => $access
                    ]);
            }

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
            $treerole = $this->roleLibrary->role($id, true);
            return view($this->view.'.form.delete', compact('data', 'treerole'));
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
