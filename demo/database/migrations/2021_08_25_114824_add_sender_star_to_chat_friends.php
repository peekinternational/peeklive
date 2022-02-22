<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSenderStarToChatFriends extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('chat_friends', function (Blueprint $table) {
            $table->integer('sender_star')->nullable()->after('message_status');
            $table->integer('receiver_star')->nullable()->after('sender_star');
            $table->integer('sender_archive')->nullable()->after('receiver_star');
            $table->integer('receiver_archive')->nullable()->after('sender_archive');
            $table->integer('sender_delete')->nullable()->after('receiver_archive');
            $table->integer('receiver_delete')->nullable()->after('sender_delete');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('chat_friends', function (Blueprint $table) {
            //
        });
    }
}
