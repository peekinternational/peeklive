<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddProductNameToChatFriends extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('chat_friends', function (Blueprint $table) {
            $table->string('product_name')->nullable()->after('sender_image');
            $table->string('product_id')->nullable()->after('sender_id');
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
