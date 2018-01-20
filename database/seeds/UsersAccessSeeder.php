<?php

use Illuminate\Database\Seeder;

class UsersAccessSeeder extends Seeder
{
    public function __construct()
    {
        $this->roleModel        = new \App\Models\Role;
        $this->roleMenuModel    = new \App\Models\RoleMenu;
        $this->userModel        = new \App\Models\User;
        $this->menuModel        = new \App\Models\Menu;

        $this->password         = 'P@ssw0rd';

        $this->icon     = [
            'parent'    => 'fa fa-folder',
            'children'  => 'fa fa-caret-right',
        ];

        $this->prefix   = [
            'backend'   => 'admin/',
        ];
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $parent = $this->create_menu_user_access(1);
        $this->create_menu_user_access_children($parent);

        /**
         * Custom menu seeder
         */
        $product_management = $this->create_menu_product_management(1);
        $this->create_menu_product_management_children($product_management);

        $roles = [
            'admin' => 'Admin',
            'staff' => 'Staff',
        ];

        foreach ($roles as $email => $name) {
            $role = $this->create_role($name);

            $this->create_role_menu($role);

            $this->create_user($role, $name, $email);
        }
    }

    /**
     * Create roles.
     */
    public function create_role($name)
    {
        return $this->roleModel->create([
                'name' => $name
            ]);
    }

    public function create_role_menu($role)
    {
        foreach (
            $this->menuModel
                ->whereNotNull('slug')
                ->whereNotNull('controller')
                ->whereNotNull('model')
                ->get()
            as $menu
        ) {
            $this->roleMenuModel->create([
                    'role_id' => $role->id,
                    'menu_id' => $menu->id,
                    'access'  => implode(config('access.delimiter'), config('access.menu.'.$menu->slug.'.action'))
                ]);
        }
    }

    /**
     * Create users.
     */
    public function create_user($role, $name, $email)
    {
        $this->userModel->create([
                'name'      => $name,
                'email'     => $email.'@domain.com',
                'password'  => bcrypt($this->password)
            ])->user_role()->create([
                'role_id'   => $role->id
            ]);
    }

    /**
     * Create menus.
     */
    public function create_menu_user_access($sequence)
    {
        return $this->menuModel->create([
                'name'      => 'User Access',
                'icon'      => $this->icon['parent'],
                'sequence'  => $sequence
            ])->id;
    }

    public function create_menu_user_access_children($parent)
    {
        $sequence   = 0;

        $childrens  = [
            'user'  => 'User',
            'role'  => 'Role',
            'menu'  => 'Menu',
        ];

        foreach ($childrens as $slug => $name) {
            $sequence++;

            $this->menuModel->create([
                    'parent_id'     => $parent,
                    'name'          => $name,
                    'slug'          => $this->prefix['backend'].$slug,
                    'controller'    => $name.'Controller',
                    'model'         => $name,
                    'icon'          => $this->icon['children'],
                    'sequence'      => $sequence,
                ]);
        }
    }

    /**
     * Create custom menus.
     */
    public function create_menu_product_management($sequence)
    {
        return $this->menuModel->create([
                'name'      => 'Master Data',
                'icon'      => $this->icon['parent'],
                'sequence'  => $sequence
            ])->id;
    }

    public function create_menu_product_management_children($parent)
    {
        $sequence   = 0;

        $childrens  = [
            'scoring'  => 'Scoring',
        ];

        foreach ($childrens as $slug => $name) {
            $sequence++;

            $this->menuModel->create([
                    'parent_id'     => $parent,
                    'name'          => $name,
                    'slug'          => $this->prefix['backend'].$slug,
                    'controller'    => $name.'Controller',
                    'model'         => $name,
                    'icon'          => $this->icon['children'],
                    'sequence'      => $sequence,
                ]);
        }
    }
}
