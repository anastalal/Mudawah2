<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddExtraFieldsToAppointmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('appointments', function (Blueprint $table) {
            $table->dateTime('date');
            $table->integer('user_id2');
            $table->integer('doctor_id2')->nullable();
            $table->integer('clinic_id2')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('appointments', function (Blueprint $table) {
            $table->dropColumn('date');
            $table->dropColumn('user_id');
            $table->dropColumn('doctor_id');
            $table->dropColumn('clinic_id');
        });
    }
}
