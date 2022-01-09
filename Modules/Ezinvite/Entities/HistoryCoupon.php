<?php

namespace Modules\Ezinvite\Entities;

use Illuminate\Database\Eloquent\Model;

class HistoryCoupon extends Model
{
    protected $fillable = [
        'user_id',
        'coupon_id',
    ];
}
