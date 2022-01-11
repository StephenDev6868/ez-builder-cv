<?php

namespace Modules\Ezinvite\Entities;

use Illuminate\Database\Eloquent\Model;

class HistoryInvite extends Model
{
    protected $fillable = [
        'user_id',
        'new_user_id',
    ];
}
