<?php

namespace Modules\ResumeCV\Entities;

use Illuminate\Database\Eloquent\Model;

class Resumecvcategory extends Model
{
    protected $table = 'resumecvcategories';
    protected $dates = [
        'created_at',
        'updated_at',
    ];

    protected $fillable = [
        'name',
        'thumb',
        'color',
        'created_at',
        'updated_at',
    ];

    public function templates()
    {
        return $this->hasMany('Modules\ResumeCV\Entities\Resumecvtemplate','category_id');
    }
}
