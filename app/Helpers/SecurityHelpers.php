<?php

if (! function_exists('check_access')) {
    function check_access($action, $slug = null)
    {
        $return = false;

        $slug = empty($slug) ? request()->path() : $slug ;
        $menu = (new \App\Models\Menu)->where(['slug' => $slug]);

        $access = [];

        if ($menu->count() > 0) {
            $roleIds = array_flatten(auth()->user()->user_role()->select('role_id')->get()->toArray());
            foreach ($menu->first()->role_menu()->whereIn('role_id', $roleIds)->get() as $role_menu) {
                $access[] = explode(config('access.delimiter'), $role_menu->access);
            }
        }

        if (in_array($action, array_collapse($access))) {
            $return = true;
        }

        return $return;
    }
}

if (! function_exists('regex_password_rules')) {
    function regex_password_rules()
    {
        $regex  = null;
        $regex .= '/^';
        $regex .= '(?=.*[A-Z])';
        $regex .= '(?=.*[a-z])';
        $regex .= '(?=.*[0-9])';
        $regex .= '(?=.*[#?!@$%^&*-])';
        $regex .= '.';
        $regex .= '{8,}';
        $regex .= '$/';
        return $regex;
    }
}

if (! function_exists('regex_password_messages')) {
    function regex_password_messages()
    {
        $message  = null;
        $message .= '<ul>';
        $message .= '<li>At least one uppercase letter</li>';
        $message .= '<li>At least one lowercase letter</li>';
        $message .= '<li>At least one digit</li>';
        $message .= '<li>At least one special character</li>';
        $message .= '</ul>';
        return $message;
    }
}

if (! function_exists('check_password')) {
    function check_password($password, $id = null)
    {
        $userId = !empty($userId) ? $userId : auth()->user()->id ;
        $user = (new \App\Models\User)->findOrFail($userId);
        return \Hash::check($password, $user->password);
    }
}

if (! function_exists('encodeids')) {
    function encodeids($plaintext = null)
    {
        $hashids = new \Hashids\Hashids(env('app.key'), config('encryption.hashids.length'), config('encryption.hashids.format'));
        $ciphertext = $hashids->encode($plaintext);
        return $ciphertext;
    }
}

if (! function_exists('decodeids')) {
    function decodeids($ciphertext = null)
    {
        $hashids = new \Hashids\Hashids(env('app.key'), config('encryption.hashids.length'), config('encryption.hashids.format'));
        $plaintext = (sizeof($hashids->decode($ciphertext))==1) ? $hashids->decode($ciphertext)[0] : null ;
        return $plaintext;
    }
}
