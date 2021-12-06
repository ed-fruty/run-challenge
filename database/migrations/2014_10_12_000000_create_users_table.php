<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('surname');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->bigInteger('strava_id')->index()->nullable();
            $table->string('strava_access_token')->nullable();
            $table->string('strava_refresh_token')->nullable();
            $table->timestamp('strava_token_expires_at')->nullable();
            $table->timestamp('strava_last_synced_at')->nullable();
            $table->string('strava_scopes')->nullable();
            $table->string('photo_url')->nullable();
            $table->string('country');
            $table->string('city');
            $table->string('is_admin')->default(0);
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
