<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDonorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(! Schema::hasTable('donors')) {
            Schema::create('donors', function (Blueprint $table) {
                $table->increments('id');
                $table->string('name');
                $table->string('blood_type');
                $table->string('gender');
                $table->integer('weight');
                $table->date('birthday');
                $table->integer('age');
                $table->integer('contact_number');

                $table->date('last_donation')->nullable();
                $table->string('details_information')->nullable();

                $table->timestamps();
                $table->softDeletes();

                $table->index(['deleted_at']);
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
        Schema::dropIfExists('donors');
    }
}
