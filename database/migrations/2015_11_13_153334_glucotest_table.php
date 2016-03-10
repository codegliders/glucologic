<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class GlucotestTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {


        Schema::table('sys_test_types', function ($table) {
            Schema::table('users', function ($table) {
                $table->renameColumn('description', 'description_it');
                 //$table->string('description_it', 255)->nullable()->change();
                     $table->string('description_en',255);
            });
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
