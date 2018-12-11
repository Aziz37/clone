<?php

namespace App;

use App\Card;
use App\File;
use App\Board;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function files()
    {
        return $this->hasMany(File::class);
    }

    public function cards()
    {
        return $this->belongsToMany(Card::class);
    }

    public function boards()
    {
        return $this->belongsToMany(Board::class);
    }
}
