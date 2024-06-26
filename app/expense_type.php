<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class expense_type extends Model
{
    protected $fillable = ['name', 'code', 'user_id'];

    public function expense_control_details()
    {
        return $this->hasMany('App\expense_control_detail');
    }
}
