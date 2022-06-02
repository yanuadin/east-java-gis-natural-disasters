<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('disasters', function (Blueprint $table) {
            $table->id();
            $table->foreignId('region_id')->constrained('east_java_regions');
            $table->foreignId('type_id')->constrained('type_of_disasters');
            $table->integer('year');
            $table->integer('amount');
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
        Schema::dropIfExists('disaster_models');
    }
};
