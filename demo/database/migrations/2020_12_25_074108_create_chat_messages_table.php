<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChatMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chat_messages', function (Blueprint $table) {
            $table->id('message_id');
            $table->integer('sender_id');
            $table->integer('receiver_id')->nullable();
            $table->string('sender_name');
            $table->string('receiver_name')->nullable();
            $table->integer('is_group');
            $table->integer('group_id');
            $table->longText('message');
            $table->longText('file');
            $table->string('message_type');
            $table->string('message_group_id')->nullable();
            $table->string('message_status')->nullable();
            $table->longText('sender_info')->nullable();
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
        Schema::dropIfExists('chat_messages');
    }
}
