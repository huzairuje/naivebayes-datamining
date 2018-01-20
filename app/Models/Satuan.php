<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Contracts\Model as ModelContracts;

class Satuan extends Model implements ModelContracts
{
    use SoftDeletes;

    public $table = 'uoms';

    protected $dates = ['created_at', 'updated_at', 'deleted_at'];

    protected $fillable = ['name'];

    public function sql()
    {
        return $this
            ->select(
                $this->table.'.id',
                $this->table.'.name'
            )->orderBy(
                $this->table.'.name'
            );
    }
}
