<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBloodsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(! Schema::hasTable('bloods')) {
            Schema::create('bloods', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('donor_id')->unsigned();
                $table->foreign('donor_id')->references('id')->on('donors')->onDelete('cascade');
                $table->string('blood_type');
                $table->string('component');
                $table->date('date_donated');
                $table->date('exp_date');
                $table->string('status')->nullable();
                $table->integer('employee_id')->unsigned();
                $table->foreign('employee_id')->references('id')->on('users')->onDelete('cascade');

                $table->timestamps();
                $table->softDeletes();
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
        Schema::dropIfExists('bloods');
    }
}
