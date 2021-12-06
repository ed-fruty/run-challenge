<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActivitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('activities', function (Blueprint $table) {
            $table->id();
            $table->integer('distance');
            $table->timestamp('start_date')->index();
            $table->integer('user_id')->index();
            $table->string('source')->index();
            $table->tinyInteger('status')->index();
            $table->string('speed_meters_in_sec')->nullable();
            $table->string('image')->nullable();

            $table->bigInteger('strava_id')->index()->nullable();
            $table->bigInteger('strava_athlete_id')->index()->nullable();
            $table->timestamp('strava_start_date')->nullable();
            $table->timestamp('strava_start_date_local')->nullable();
            $table->string('strava_timezone')->nullable();
            $table->integer('strava_utc_offset')->nullable();
            $table->integer('strava_moving_time')->nullable();

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
        Schema::dropIfExists('activities');
    }
}
