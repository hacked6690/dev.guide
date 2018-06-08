<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class BookingMigrations extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('bookings', function (Blueprint $table) {
            $table->collation = 'utf8_general_ci';
            $table->charset = 'utf8';
            $table->increments('id');
            $table->integer('guide_id');
            $table->integer('creator_id');
             $table->integer('lang_id');
            $table->string('active',30);
            $table->string('icon',30);
            $table->string('color',30);
            $table->string('title', 100);
            $table->string('description', 255);
            $table->date('start');
            $table->date('end');
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
        //
         Schema::dropIfExists('bookings');
    }
}
