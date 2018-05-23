<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('ads')) {
            Schema::create('ads', function (Blueprint $table) {
                $table->increments('id');
                
                $table->string('title', 60)->nullable();
                $table->text('description')->nullable();
                $table->string('image_filename', 100)->nullable();
                $table->integer('total_views')->unsigned()->nullable();
                $table->string('unique_display_number', 20)->nullable();

                $table->softDeletes();
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ads');
    }
}
