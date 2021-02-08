<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class JobHistory extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('job_history', function (Blueprint $table) {
            $table->id('job_history_id');
            $table->date('start_date');
            $table->date('end_date')->nullable();
            $table->bigInteger('employee_id');
            $table->bigInteger('job_id');
            $table->bigInteger('department_id');

            $table->foreign('employee_id')->references('employee_id')->on('employees');
            $table->foreign('job_id')->references('job_id')->on('jobs');
            $table->foreign('department_id')->references('department_id')->on('departments');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('job_history');
    }
}
