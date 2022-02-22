<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ChatMessages extends Model
{
  	protected $fillable = [
    'sender_id',
    'receiver_id',
    'sender_name',
    'receiver_name',
    'is_group',
    'group_id',
    'message',
    'file',
    'message_type',
    'message_group_id',
    'commentId',
    'chatType',
    'message_status',
    'is_deleted',
    'file_type',
    'message_time',
  ];

  protected $primaryKey = 'message_id';

  // public function friendData()
  // {
  //   return $this->belongsTo(ChatStar::class, 'conversation_id');
  // }
  
    protected $table = 'chat_messages';
}
