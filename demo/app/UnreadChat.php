<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UnreadChat extends Model
{
    protected $fillable = [
    	'message_group_id',
    	'friend_id',
    	'unread_by',
    	'status',
	];
	public function friendData()
	{
	  return $this->belongsTo(ChatFriends::class, 'friend_id');
	}
}
