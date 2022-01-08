<?php

namespace Modules\Ezinvite\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Coupon extends Model
{
    use SoftDeletes;

    public $timestamps = true;

    protected $fillable = [
        'code',
        'credit',
        'limit',
        'expiration_date',
    ];
}
