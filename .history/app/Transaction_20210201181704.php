<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    //
    protected $table = 'transactions';
    $protected $fillable = ['order_id','paid_amount','balance','payment_method','user_i']
}
