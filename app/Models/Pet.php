<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use PhpParser\Node\Expr\FuncCall;

class Pet extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getCreatedAtAttribute($date)
    {
        return Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('d/m/Y');
        // return Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('Y-m-d');
    }

    public function pictures()
    {
        return $this->hasMany(Picture::class);
    }

    public function pegaimg()
    {
        if ($this->picture == null) {
            return '/uploads/pictures/user-' . $this->id . '/avatar' . '/' . $this->picture;
        }

        return '/uploads/pictures/user-' . $this->user->id . '/pet-' . $this->id . '/' . $this->picture;
    }

    public function get_sex()
    {
        if ($this->sex == '0')
        {
            return 'fêmea';
        } else {
            return 'macho';
        }
    }

    public function get_color_sex()
    {
        if ($this->sex == '0')
        {
            return 'pink';
        } else {
            return 'blue';
        }
    }

    public function get_icon()
    {
        switch ($this->type) {
            case 'dog':
                return 'fas fa-dog';
                break;
            case 'cat':
                return 'fas fa-cat';
                break;
            case 'bird':
                return 'fas fa-dove';
                break;
            case 'mice':
                return 'fas fa-otter';
                break;
            case 'reptile':
                return 'fas fa-frog';
                break;
        }
    }
}
