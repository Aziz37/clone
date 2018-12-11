<?php

namespace App;

use App\Card;
use App\User;
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

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function date_format($date)
    {
        $dbDate = date_create($date);
        $formattedDate = date_format($dbDate, 'M j Y');

        return $formattedDate;
    }

    public function time_format($time)
    {
        $formattedTime = date('g:i A', strtotime($time));

        return $formattedTime;
    }
}
