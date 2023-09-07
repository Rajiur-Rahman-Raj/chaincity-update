<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterRowsToTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('manage_properties', function (Blueprint $table) {
            $table->text('video')->nullable();
//            $table->integer('is_payment')->default(1)->comment('0=manual profit return, 1=automatic profit return')->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('manage_properties', function (Blueprint $table) {
            $table->dropColumn('video');
        });

    }
}
