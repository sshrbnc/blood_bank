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
                $table->string('status')->default('Pending');

                $table->string('transaction_code');
                $table->boolean('urgent')->default(false);
                $table->unsignedInteger('patient_id');
                $table->foreign('patient_id')->references('id')->on('patients')->onDelete('cascade');

                $table->unsignedInteger('employee_id');
                $table->foreign('employee_id')->references('id')->on('users')->onDelete('cascade');

                $table->unsignedInteger('blood_id')->nullable();
                $table->foreign('blood_id')->references('id')->on('bloods')->onDelete('cascade');

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
