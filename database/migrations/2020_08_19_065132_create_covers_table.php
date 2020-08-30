<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoversTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('covers', function (Blueprint $table) {
            $table->char('id', 26)->primary();
            $table->uuid('user_id')->nullable();
            $table->char('upper_concept_id', 26);
            $table->char('lower_concept_id', 26);
            $table->timestamps();
            $table->foreign('upper_concept_id')->references('id')->on('concepts')->onDelete('cascade');
            $table->foreign('lower_concept_id')->references('id')->on('concepts')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('covers');
    }
}
