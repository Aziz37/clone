<?php

namespace App;

use App\Card;
use App\User;
use App\Admin;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    public function admin()
    {
    	return $this->belongsTo(Admin::class);
    }

    public function user()
    {
    	return $this->belongsTo(User::class);
    }

    public function card()
    {
    	return $this->belongsTo(Card::class);
    }
}
