<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterGlucotestsNullables extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::table('glucotests', function ($table) {
            $table->boolean('insulin_types_id')->nullable()->change();
            $table->boolean('insulin_value')->nullable()->change();
            $table->boolean('food_types_id')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        //
    }

}
