<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBloodRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(! Schema::hasTable('blood_requests')) {
            Schema::create('blood_requests', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('quantity')->default(1);
                $table->string('hospital');
                $table->string('component');
                $table->string('blood_type');
                $table->string('status');

                // $table->unsignedInteger('patient_id');
                // $table->foreign('patient_id')->references('id')->on('patients');

                // $table->unsignedInteger('donor_id');
                // $table->foreign('donor_id')->references('id')->on('patients');

                $table->unsignedInteger('employee_id');
                $table->foreign('employee_id')->references('id')->on('users');

                $table->timestamps();
        });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('blood_requests');
    }
}
