<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentGuardiansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_guardians', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('student_id');
            $table->foreign('student_id')->references('id')->on('students')->onDelete('cascade');
            $table->enum('particular',['particular-1','particular-2']);
            $table->enum('relationship',['Father','Mother','Guardian']);
            $table->string('name');
            $table->date('dob')->nullable();
            $table->string('qualification');
            $table->string('occupation')->nullable();
            $table->string('designation')->nullable();
            $table->string('name_of_company')->nullable();
            $table->string('work_location')->nullable();
            $table->string('pan_no')->nullable();
            $table->string('telephone_no')->nullable();
            $table->string('mobile_no');
            $table->string('email')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('student_guardians');
    }
}
