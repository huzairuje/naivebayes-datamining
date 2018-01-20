<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Contracts\Model as ModelContracts;

class Menu extends Model implements ModelContracts
{
    use SoftDeletes;

    public $table = 'menus';

    protected $dates = ['created_at', 'updated_at', 'deleted_at'];

    protected $fillable = ['parent_id', 'name', 'slug', 'controller', 'model', 'icon', 'sequence', 'sidebar', 'description'];

    protected $casts = ['sidebar' => 'boolean'];

    public function sql()
    {
        return $this
            ->leftJoin($this->table.' AS parent', 'parent.id', '=', $this->table.'.parent_id')
            ->select(
                $this->table.'.id',
                'parent.name AS parent',
                $this->table.'.name',
                $this->table.'.slug',
                $this->table.'.icon',
                $this->table.'.sequence',
                $this->table.'.sidebar',
                $this->table.'.description'
            )->orderBy(
                $this->table.'.name'
            );
    }

    public function role_menu()
    {
        return $this->hasMany(RoleMenu::class);
    }
}
