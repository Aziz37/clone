<?php

namespace App;

use App\Card;
use App\Admin;
use App\Listing;
use Illuminate\Database\Eloquent\Model;

class Board extends Model
{
	public function admin()
	{
		return $this->belongsTo(Admin::class);
	}

    public function lists()
    {
    	return $this->hasMany(Listing::class);
    }

    public function cards()
    {
    	return $this->hasMany(Card::class);
    }
}
