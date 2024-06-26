<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class expense_control extends Model
{
    protected $fillable = ['user_id', 'initialDate', 'finalDate', 'limit', 'saving', 'active', 'spent'];
//    protected $guarded = [];
    protected $dates = ['initialDate', 'finalDate'];

    public function expense_control_details()
    {
        return $this->hasMany('App\expense_control_detail')
            ->orderby('created_at', 'desc');
    }
}
