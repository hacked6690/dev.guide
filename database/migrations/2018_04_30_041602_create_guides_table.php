n<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGuidesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('guides', function (Blueprint $table) {
            $table->collation = 'utf8_general_ci';
            $table->charset = 'utf8';
            $table->increments('id');
            $table->string('code', 45);
            $table->string('id_card', 255);
            $table->date('dob');
            $table->string('profile');
            $table->date('date_in_service');
            $table->tinyInteger('status');
            $table->integer('number_comments');
            $table->integer('number_bookings');
            $table->integer('guide_type_id');
            $table->integer('nationality_id');
            $table->date('issued_date');
            $table->date('expired_date');
            $table->integer('generation');
            $table->tinyInteger('guide_certified');
            $table->tinyInteger('domicile_certified');
            $table->tinyInteger('behaviour_certified');
            $table->tinyInteger('cv_provided');
            $table->tinyInteger('new_renew');
            $table->integer('number_visitors');
            $table->integer('number_group_visitors');
            $table->integer('initial_number_bookings');
            $table->float('global_rate', 8, 2);
            $table->integer('rate_one');
            $table->integer('rate_two');
            $table->integer('rate_three');
            $table->integer('rate_four');
            $table->integer('rate_five');
            $table->integer('user_id');
            $table->integer('partner_id');
            $table->tinyInteger('is_recommended');
            $table->string('certificate_number', 255);
            $table->dateTime('deleted_at');
            $table->integer('number_view');
        
          /*  $table->string('code', 45);
            $table->string('id_card', 255);
            $table->date('dob');
            $table->string('profile');
            $table->date('date_in_service');
            $table->tinyInteger('status',2);
            $table->integer('number_comments',11);
            $table->integer('number_bookings',11);
            $table->integer('guide_type_id',11);
            $table->integer('nationality_id',11);
            $table->date('issued_date');
            $table->date('expired_date');
            $table->integer('generation',11);
            $table->tinyInteger('guide_certified',1);
            $table->tinyInteger('domicile_certified',1);
            $table->tinyInteger('behaviour_certified',1);
            $table->tinyInteger('cv_provided',1);
            $table->tinyInteger('new_renew',2);
            $table->integer('number_visitors',11);
            $table->integer('number_group_visitors',11);
            $table->integer('initial_number_bookings',11);
            $table->float('global_rate', 8, 2);
            $table->integer('rate_one',11);
            $table->integer('rate_two',11);
            $table->integer('rate_three',11);
            $table->integer('rate_four',11);
            $table->integer('rate_five',11);
            $table->integer('user_id',11);
            $table->integer('partner_id',11);
            $table->tinyInteger('is_recommended',1);
            $table->string('certificate_number', 255);
            $table->dateTime('deleted_at');
            $table->integer('number_view',11);*/




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
        Schema::dropIfExists('guides');
    }
}
