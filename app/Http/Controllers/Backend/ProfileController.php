<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Image;
use Validator;

class ProfileController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->menu         = trans('menu.profile.name');
        $this->route        = $this->routes['backend'].'profile';
        $this->slug         = $this->slugs['backend'].'profile';
        $this->view         = $this->views['backend'].'profiles';
        $this->breadcrumb   = '<li><a href="'.route($this->route.'.index').'">'.$this->menu.'</a></li>';
        view()->share([
            'menu'          => $this->menu,
            'route'         => $this->route,
            'slug'          => $this->slug,
            'view'          => $this->view,
        ]);
        # model
        $this->model        = new \App\Models\User;
        $this->roleModel    = new \App\Models\Role;
    }

    public function index($id = null)
    {
        try {
            $id = (!empty($id)) ? decodeids($id) : auth()->user()->id ;
            $breadcrumb = $this->breadcrumbs($this->breadcrumb.'<li class="active">'.trans('label.view').'</li>');
            $user = $this->model->findOrFail($id);
            $roles = $this->roleModel->orderBy('name')->get();
            return view($this->view.'.index', compact('breadcrumb', 'user', 'roles'));
        } catch (\Exception $e) {
            abort(500);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $id = decodeids($id);
            $active = $request->tab=='change-password' ? '?active=change-password' : null ;
            $redirect = ($id!=auth()->user()->id) ? ['id' => encodeids($id).$active] : $active ;

            $validator = Validator::make($request->all(), [
                'role' => 'required_if:tab,profile',
                'name' => 'required_if:tab,profile|max:255',
                'email' => 'required_if:tab,profile|max:255|email|unique:'.$this->model->table.',email,'.$id.',id,deleted_at,NULL',
                'avatar' => 'mimes:jpeg,jpg,png',
                'password_old' => 'required_if:tab,change-password|password_old:'.$id,
                'password' => 'required_if:tab,change-password|min:8|confirmed|regex:'.regex_password_rules(),
            ], [
                'required_if' => 'The :attribute field is required.',
                'regex' => 'The :attribute format must be contained:'.regex_password_messages()
            ]);

            if ($validator->fails()) {
                return redirect()
                    ->route($this->route.'.index', $redirect)
                    ->withErrors($validator)
                    ->withInput();
            }

            $data = $this->model->findOrFail($id);
            if ($request->tab=='profile') {
                if ($request->hasFile('avatar')) {
                    $avatar = null;
                    if ($request->file('avatar')->isValid()) {
                        $pathname = check_dir(config('path.uploads.avatars'));
                        $filename = time() . '.' . $request->file('avatar')->getClientOriginalExtension();
                        $uploaded = Image::make($request->file('avatar'))->resize(250, 250)->save($pathname.'/'.$filename);
                        $avatar = $uploaded->dirname.'/'.$uploaded->filename.'.'.$uploaded->extension;
                        if (!empty($request->avatar_old)) {
                            unlink($request->avatar_old);
                        }
                    }
                } else {
                    $avatar = !empty($request->avatar_old) ? $request->avatar_old : null ;
                }

                $data->name = $request->name;
                $data->email = $request->email;
                $data->avatar = $avatar;
                $data->user_role()->delete();
                $data->user_role()->create(['role_id' => $request->role]);

                action_message('save', $this->menu);
            } elseif ($request->tab=='change-password') {
                $data->password = bcrypt($request->password) ;

                action_message('change', trans('label.password'));
            }
            $data->update();

            return redirect()->route($this->route.'.index', $redirect);
        } catch (\Exception $e) {
            abort(500);
        }
    }
}
