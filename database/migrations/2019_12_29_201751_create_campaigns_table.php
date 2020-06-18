<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCampaignsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::enableForeignKeyConstraints();
        Schema::create('campaigns', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
            $table->softDeletes();
            $table->dateTime('start');
            $table->dateTime('end');
            $table->string('name');
            $table->string('geo_targeting');
            $table->string('day_parting');
            $table->string('devices');
            $table->string('custom_category')->nullable();
            $table->unsignedBigInteger('ad_format_id');
            $table->string('traffic_source');
            $table->unsignedBigInteger('status_id');
            $table->unsignedBigInteger('category_id')->default(12);
            $table->unsignedBigInteger('user_id');
            $table->string('daily_budget')->nullable();
            $table->string('current_bid')->nullable();
        });

        Schema::table('campaigns', function($table) {
            $table->foreign('category_id')
                ->references('id')->on('categories');
            $table->foreign('status_id')
                ->references('id')->on('statuses');
            $table->foreign('ad_format_id')
                ->references('id')->on('ad_formats');
            $table->foreign('user_id')
                ->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('campaigns');
    }
}
