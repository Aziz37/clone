<?php

namespace App;

use App\File;
use App\User;
use App\Admin;
use App\Board;
use App\Comment;
use App\Listing;
use Illuminate\Database\Eloquent\Model;

class Card extends Model
{
    public function admins()
    {
        return $this->belongsToMany(Admin::class);
    }

    public function board()
    {
        return $this->belongsTo(Board::class);
    }

    public function list()
    {
    	return $this->belongsTo(Listing::class, 'listing_id');
    }

    public function files()
    {
        return $this->hasMany(File::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class)->orderBy('created_at','DESC');
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
