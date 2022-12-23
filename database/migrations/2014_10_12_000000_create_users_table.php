<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Hash;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nik')->nullable();
            $table->string('fullname');
            $table->date('birth_date')->nullable();
            $table->string('password')->default(Hash::make('promedika'));
            $table->string('profile')->default('default.jpg');
            $table->string('gender')->nullable();
            $table->string('religion')->nullable();
            $table->string('marital_status')->nullable();
            $table->string('education_level')->nullable();
            $table->date('join_date')->nullable();
            $table->string('employment_status')->nullable();
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->string('length_of_service')->nullable();
            $table->string('jabatan')->nullable();
            $table->string('organization_unit')->nullable();
            $table->string('job_title')->nullable();
            $table->string('job_status')->nullable();
            $table->integer('level')->nullable();
            $table->string('address')->nullable();
            $table->integer('grade_category')->nullable();
            $table->string('work_location')->nullable();
            $table->string('employee_status')->nullable();
            $table->string('direct_supervisor')->nullable();
            $table->string('immediate_manager')->nullable();
            $table->date('termination_date')->nullable();
            $table->string('terminate_reason')->nullable();
            $table->string('resignation')->nullable();
            $table->integer('area')->nullable();
            $table->integer('kota')->nullable();
            $table->integer('division')->nullable();
            $table->integer('department')->nullable();
            $table->string('function')->nullable();
            $table->string('phone')->nullable();
            $table->string('salary')->nullable();
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
