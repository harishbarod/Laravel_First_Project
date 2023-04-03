<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnSubscriptionIdToChatPaidUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('chat_paid_users', function (Blueprint $table) {
            $table->string('subscription_id')->after('user_id')->nullable();
        

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('chat_paid_users', function (Blueprint $table) {
            //
        });
    }
}
