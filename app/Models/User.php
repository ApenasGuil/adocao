<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
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
        'email_verified_at' => 'datetime',
    ];

    public function isAdmin()
    {
        if ($this->role_id == '1') {
            return true;
        }
        return false;
    }

    public function pets()
    {
        return $this->hasMany(Pet::class);
    }

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function get_avatar()
    {
        if($this->avatar == 'default.png')
        {
            return '/uploads/pictures/default/default.png';
        }

        return '/uploads/pictures/user-' . $this->id . '/avatar'. '/' . $this->avatar;
    }

    public function get_user_avatar()
    {
        if ($this->avatar == 'default.png')
            return 'uploads/pictures/default/default.png';
        else
            return $this->get_avatar();
    }
}
