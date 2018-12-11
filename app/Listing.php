<?php

namespace App;

use App\Card;
use App\Board;
use Illuminate\Database\Eloquent\Model;

class Listing extends Model
{

	public function board()
	{
		return $this->belongsTo(Board::class);
	}

    public function cards()
    {
    	return $this->hasMany(Card::class);
    }
}
