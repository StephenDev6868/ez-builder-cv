<?php

namespace Modules\ResumeCV\Entities;

use Illuminate\Database\Eloquent\Model;

class Resumecvtemplate extends Model
{
    protected $table = 'resumecvtemplates';
    
    protected $dates = [
        'created_at',
        'updated_at',
    ];

    protected $fillable = [
        'category_id',
        'name',
        'thumb',
        'content',
        'style',
        'active',
        'is_premium',
        'created_at',
        'updated_at',
    ];
   
    protected $casts = [
        'is_premium' => 'boolean',
        'active' => 'boolean',
    ];

    public function scopeActive($query)
    {
        return $query->where('active', '=', 1);
    }

    public function category()
    {
        return $this->belongsTo('Modules\ResumeCV\Entities\Resumecvcategory', 'category_id');
    }
}
