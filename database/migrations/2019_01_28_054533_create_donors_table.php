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
                $table->date('birthday');
                $table->string('sex');
                $table->string('address');
                $table->string('phone_number', 13); //#updated
                $table->integer('employee_id')->unsigned();
                $table->foreign('employee_id')->references('id')->on('users')->onDelete('cascade');
                
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