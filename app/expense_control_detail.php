<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class expense_control_detail extends Model
{
    protected $fillable = ['user_id', 'expense_control_id', 'expense_type_id', 'value', 'description'];

    public function expense_type()
    {
        return $this->belongsTo('App\expense_type');
    }

    public function expense_control()
    {
        return $this->hasOne('App\expense_control');
    }
}
