<?php

namespace Modules\User\Entities;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Modules\User\Notifications\QueuedResetPassword;

class User extends Authenticatable
{
    use Notifiable;

    protected $dates = [
        'email_verified_at',
        'package_ends_at',
        'created_at',
        'updated_at',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'mobile_phone',
        'gender',
        'high_school_name',
        'grade',
        'role',
        'name',
        'email',
        'email_verified_at',
        'password',
        'remember_token',
        'settings',
        'package_id',
        'package_ends_at',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'settings' => 'array'
    ];
    
    public function scopeUser($query)
    {
        return $query->where('role', '=', 'user');
    }

    public function resumecvs()
    {
        return $this->hasMany('Modules\ResumeCV\Entities\Resumecv');
    }
    
    public function payments()
    {
        return $this->hasMany('Modules\Saas\Entities\Payment');
    }

    public function package()
    {
        return $this->belongsTo('Modules\Saas\Entities\Package')->withDefault();
    }

    public function subscribed()
    {
        if (is_null($this->package_ends_at)) {
            return false;
        }
        return $this->package_ends_at->isFuture();
    }
    public function checkRemoveBrand()
    {
        if (!$this->subscribed()) {
            # code...
            if (config('saas.remove_branding') == true) {
                return true;
            }
            return false;
        }
        else{
            if ($this->package->remove_branding == true) {
                return true;
            }
            return false;
        }
    }

    public function checkDownloadPDF()
    {
        if (!$this->subscribed()) {
            # code...
            if (config('saas.download_pdf') == true) {
                return true;
            }
            return false;
        }
        else{
            if ($this->package->remove_branding == true) {
                return true;
            }
            return false;
        }
    }

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new QueuedResetPassword($token));
    }

    public static function boot() {
        parent::boot();
        static::deleting(function($user) {
            $user->resumecvs()->delete();
       });
    }
    
}
