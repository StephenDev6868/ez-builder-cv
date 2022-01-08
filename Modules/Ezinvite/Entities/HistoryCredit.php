<?php

namespace Modules\Ezinvite\Entities;

use Illuminate\Database\Eloquent\Model;

class HistoryCredit extends Model
{
    protected $fillable = [
        'user_id',
        'amount',
        'type',
        'done_at',
    ];
}
