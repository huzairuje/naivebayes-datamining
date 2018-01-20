<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Datatables;
use Validator;

class UserController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->menu         = trans('menu.user.name');
        $this->route        = $this->routes['backend'].'user';
        $this->slug         = $this->slugs['backend'].'user';
        $this->view         = $this->views['backend'].'users';
        $this->breadcrumb   = '<li><a href="'.route($this->route.'.index').'">'.$this->menu.'</a></li>';
        # share parameters
        $this->share();
        # init model
        $this->model        = new \App\Models\User;
        $this->roleModel    = new \App\Models\Role;
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
                        $action .= '<a href="'.route($this->routes['backend'].'profile.index', ['id' => encodeids($data->id)]).'" class="btn btn-xs btn-primary" title="'.trans('label.edit').'">'.trans('icon.edit').'</a>';
                    }
                    if (check_access('activate', $this->slug) && $data->active_id==0) {
                        $action .= '<a data-href="'.route($this->route.'.activate.get', encodeids($data->id)).'" class="btn btn-xs btn-success btn-modal-action" title="'.trans('label.activate').'" data-title="'.trans('form.activate', ['menu' => $this->menu]).'" data-icon="fa fa-check fa-fw" data-background="modal-success">'.trans('icon.activate').'</a>';
                    }
                    if (check_access('deactivate', $this->slug) && $data->active_id==1) {
                        $action .= '<a data-href="'.route($this->route.'.deactivate.get', encodeids($data->id)).'" class="btn btn-xs btn-danger btn-modal-action" title="'.trans('label.deactivate').'" data-title="'.trans('form.deactivate', ['menu' => $this->menu]).'" data-icon="fa fa-ban fa-fw" data-background="modal-danger">'.trans('icon.deactivate').'</a>';
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
            return view($this->view.'.form.detail', compact('data'));
        } catch (\Exception $e) {
            abort(500);
        }
    }

    public function create()
    {
        try {
            $roles = $this->roleModel->orderBy('name')->get();
            return view($this->view.'.form.create', compact('roles'));
        } catch (\Exception $e) {
            abort(500);
        }
    }

    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'role' => 'required',
                'name' => 'required|max:255',
                'email' => 'required|max:255|email|unique:'.$this->model->table.',email,NULL,id,deleted_at,NULL',
                'password' => 'required|min:8|confirmed|regex:'.regex_password_rules(),
            ], [
                'regex' => 'The :attribute format must be contained:'.regex_password_messages()
            ]);

            if ($validator->fails()) {
                return redirect()
                    ->route($this->route.'.create')
                    ->withErrors($validator)
                    ->withInput();
            }

            $data = $this->model;
            $data->name = $request->name;
            $data->email = $request->email;
            $data->password = bcrypt($request->password);
            $data->save();

            $data->user_role()->create(['role_id' => $request->role]);

            action_message('create', $this->menu);
            return json_encode(['redirect' => route($this->route.'.index')]);
        } catch (\Exception $e) {
            abort(500);
        }
    }

    public function getActivate($id)
    {
        try {
            $id = decodeids($id);
            $data = $this->model->sql()->findOrFail($id);
            return view($this->view.'.form.activate', compact('data'));
        } catch (\Exception $e) {
            abort(500);
        }
    }

    public function postActivate($id)
    {
        try {
            $id = decodeids($id);
            $data = $this->model->findOrFail($id);
            $data->active = 1;
            $data->update();
            action_message('activate', $this->menu);
            return redirect()->route($this->route.'.index');
        } catch (\Exception $e) {
            abort(500);
        }
    }

    public function getDeactivate($id)
    {
        try {
            $id = decodeids($id);
            $data = $this->model->sql()->findOrFail($id);
            return view($this->view.'.form.deactivate', compact('data'));
        } catch (\Exception $e) {
            abort(500);
        }
    }

    public function postDeactivate($id)
    {
        try {
            $id = decodeids($id);
            $data = $this->model->findOrFail($id);
            $data->active = 0;
            $data->update();
            action_message('deactivate', $this->menu);
            return redirect()->route($this->route.'.index');
        } catch (\Exception $e) {
            abort(500);
        }
    }
}
