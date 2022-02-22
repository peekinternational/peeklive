<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChatFriendsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chat_friends', function (Blueprint $table) {
            $table->id('friend_id');
            $table->integer('sender_id');
            $table->integer('receiver_id');
            $table->string('receiver_name')->nullable();
            $table->string('sender_name')->nullable();
            $table->longText('receiver_image')->nullable();
            $table->longText('sender_image')->nullable();
            $table->longText('message_group_id')->nullable();
            $table->longText('message_id')->nullable();
            $table->longText('updatedByMsg')->nullable();
            $table->longText('message_status')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('chat_friends');
    }
}
