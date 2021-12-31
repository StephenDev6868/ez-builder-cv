<?php

namespace Modules\ResumeCV\Entities;

use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid;

class Resumecv extends Model
{
    protected $table = 'resumecv';

    private function generateCode()
    {
        $uuid = (string)Uuid::uuid1();
        $this->code = $uuid;
        $this->slug = $uuid;
    }

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    protected $fillable = [
        'user_id',
        'code',
        'name',
        'content',
        'style',
        'slug',
        'view_count',
        'is_publish',
        'created_at',
        'updated_at',
    ];

    public function user()
    {
        return $this->belongsTo('Modules\User\Entities\User');
    }

    protected static function boot()
    {
        parent::boot();
        static::creating(function (Resumecv $model) {
            $model->generateCode();
        });
    }
}
