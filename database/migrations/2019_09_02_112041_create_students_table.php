<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('admission_number')->unique();
            $table->string('ec_number');
            $table->string('first_name');
            $table->string('middle_name')->nullable();
            $table->string('last_name');
            $table->unsignedBigInteger('classroom_id')->nullable();
            $table->foreign('classroom_id')->references('id')->on('classrooms')->onDelete('set null');
            $table->unsignedBigInteger('section_id')->nullable();
            $table->foreign('section_id')->references('id')->on('sections')->onDelete('set null');
            $table->unsignedBigInteger('session_id')->nullable();
            $table->foreign('session_id')->references('id')->on('sessions')->onDelete('set null');
            $table->date('dob');
            $table->string('place_of_birth')->nullable();
            $table->enum('gender',['Male','Female','Other']);
            $table->string('religion')->nullable();
            $table->unsignedBigInteger('student_category_id')->nullable();
            $table->foreign('student_category_id')->references('id')->on('student_categories')->onDelete('set null');
            $table->string('student_uid')->nullable();
            $table->string('mother_tongue')->nullable();
            $table->string('blood_group');
            $table->string('image')->nullable();
            $table->boolean('agreement')->default(0);
            $table->enum('status',['Active','Not-Active'])->default('Active');
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
        Schema::dropIfExists('students');
    }
}
