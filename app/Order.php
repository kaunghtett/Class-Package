<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    //
    protected $table = "orders";

    protected $fillable = ['user_id','class_package_id','promocode','actual_price'];

    protected $casts = [
        'actual_price' => 'float'
    ];
}
