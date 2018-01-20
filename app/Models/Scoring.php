<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Contracts\Model as ModelContracts;

class Scoring extends Model implements ModelContracts
{
    use SoftDeletes;

    public $table = 'scoring';

    protected $dates = ['created_at', 'updated_at', 'deleted_at'];

    public function sql()
    {
        return $this
            ->select(
                $this->table.'.id',
                $this->table.'.penghasilan',
                $this->table.'.pengeluaran',
                $this->table.'.pekerjaan',
                $this->table.'.status_kawin',
                $this->table.'.score'
            );
    }
}
