<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUnitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('units', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('location_id');
            $table->string('price');
            $table->enum('type', ['apartment', 'house', 'room']);
            $table->enum('lease_type', ['full', 'sublet', 'assignment']);
            $table->integer('lease_length')->default(12);
            $table->boolean('heat_included')->default(false);
            $table->boolean('electricity_included')->default(false);
            $table->boolean('water_included')->default(false);
            $table->boolean('internet_included')->default(false);
            $table->boolean('furnished')->default(false);
            $table->boolean('air_conditioned')->default(false);
            $table->boolean('parking_available')->default(false);
            $table->boolean('laundry_onsite')->default(false);
            $table->boolean('laundry_hookup')->default(false);
            $table->boolean('accessibility_features')->default(false);
            $table->boolean('university_owned')->default(false);
            $table->boolean('affiliate_program')->default(false);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('units');
    }
}
