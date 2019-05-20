<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDonationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(! Schema::hasTable('donations')) {
            Schema::create('donations', function (Blueprint $table) {
                $table->increments('id');
                $table->date('date_donated');
                $table->integer('donor_id')->unsigned();
                $table->foreign('donor_id')->references('id')->on('donors')->onDelete('cascade');
                $table->string('trans_code')->nullable();
                $table->integer('weight');
                $table->integer('blood_count');
                $table->string('result');
                $table->string('details_information')->nullable();
                $table->string('status');
                $table->string('flag')->default('Green');
                $table->integer('employee_id')->unsigned();
                $table->foreign('employee_id')->references('id')->on('users')->onDelete('cascade');
                $table->string('processed', 5);

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
        Schema::dropIfExists('donations');
    }
}
