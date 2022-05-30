<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGoalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('goals', function (Blueprint $table) {
            $table->id();
            $table->string('goal_name');
            $table->text('goal_process');
            $table->string('goal_status');
            $table->string('supervisor_status');
            $table->string('reviewer_status');
            $table->string('hr_status');
            $table->string('bh_status');
            $table->text('employee_summary');
            $table->text('supervisor_summary');
            $table->string('goal_unique_code');
            $table->string('created_by');
            $table->string('created_by_name');
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
        Schema::dropIfExists('goals');
    }
}
