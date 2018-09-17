<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateBuildableTables extends Migration
{
    public function up()
    {
        Schema::create('buildingblocks', function ($table) {
            $table->increments('id');
            $table->string('type');
            $table->string('buildable_type');
            $table->integer('buildable_id')->unsigned();
            $table->mediumText('content')->nullable()->default(null);
            $table->integer('order')->unsigned()->default(0);
            $table->timestamps();
        });

        Schema::create('listitems', function ($table) {
            $table->integer('id');
            $table->string('text');
            $table->integer('buildingblock_id')->unsigned();
            $table->foreign('buildingblock_id')->references('id')->on('buildingblocks');
        });
    }

    public function down()
    {
        Schema::drop('buildingblocks');
        Schema::drop('listitems');
    }
}