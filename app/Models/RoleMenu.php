<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Contracts\Model as ModelContracts;

class RoleMenu extends Model implements ModelContracts
{
    public $table = 'role_menu';

    protected $dates = ['created_at', 'updated_at'];

    protected $fillable = ['role_id', 'menu_id', 'access'];

    public function sql()
    {
        //
    }

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function menu()
    {
        return $this->belongsTo(Menu::class);
    }
}
