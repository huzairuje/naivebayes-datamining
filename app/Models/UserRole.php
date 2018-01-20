<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Contracts\Model as ModelContracts;

class UserRole extends Model implements ModelContracts
{
    public $table = 'user_role';

    protected $dates = ['created_at', 'updated_at'];

    protected $fillable = ['user_id', 'role_id'];

    public function sql()
    {
        //
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function role()
    {
        return $this->belongsTo(Role::class);
    }
}
