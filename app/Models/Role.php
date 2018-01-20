<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Contracts\Model as ModelContracts;

class Role extends Model implements ModelContracts
{
    use SoftDeletes;

    public $table = 'roles';

    protected $dates = ['created_at', 'updated_at', 'deleted_at'];

    protected $fillable = ['name', 'description'];

    public function sql()
    {
        return $this
            ->select(
                $this->table.'.id',
                $this->table.'.name',
                $this->table.'.description'
            )->orderBy(
                $this->table.'.name'
            );
    }

    public function role_menu()
    {
        return $this->hasMany(RoleMenu::class);
    }

    public function user_role()
    {
        return $this->hasMany(UserRole::class);
    }
}
