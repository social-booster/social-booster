<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddManyColsConceptsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('concepts', function (Blueprint $table) {
            $table->unsignedBigInteger('votes')->after('user_id');
            $table->unsignedBigInteger('additional_votes')->after('votes');
            $table->unsignedTinyInteger('additional_votes_ratio')->after('additional_votes');
            $table->unsignedBigInteger('actions')->after('additional_votes_ratio');
            $table->unsignedTinyInteger('actions_ratio')->after('actions');
            $table->unsignedBigInteger('start_rate')->after('actions_ratio');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('concepts', function (Blueprint $table) {
            //
        });
    }
}
