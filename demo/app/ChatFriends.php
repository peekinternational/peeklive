<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ChatFriends extends Model
{
  	protected $fillable = [
    'sender_id',
    'receiver_id',
    'product_id',
    'receiver_name',
    'sender_name',
    'sender_email',
    'receiver_email',
    'receiver_image',
    'sender_image',
    'product_name',
    'message_group_id',
    'message_id',
    'updatedByMsg',
    'message_status',
    'star_by_sender',
    'star_by_receiver',
    'sender_archive',
    'receiver_archive',
    'sender_delete',
    'receiver_delete',
  ];
  protected $primaryKey = 'friend_id';
  // public function senderInfo()
  // {
  //   return $this->belongsTo(User::class, 'sender_id');
  // }
  // public function receiverInfo()
  // {
  //   return $this->belongsTo(User::class, 'receiver_id');
  // }
  public function messageData()
  {
    return $this->belongsTo(ChatMessages::class, 'message_id');
  }

  public function starData()
  {
    return $this->hasMany(ChatStar::class, 'friend_id');
  }
  public function archiveData()
  {
    return $this->hasMany(ArchivedChat::class, 'friend_id');
  }
  public function deleteData()
  {
    return $this->hasMany(DeleteChat::class, 'friend_id');
  }
  public function unreadData()
  {
    return $this->hasMany(UnreadChat::class, 'friend_id');
  }
    protected $table = 'chat_friends';
}
