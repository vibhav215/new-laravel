<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tasks', function (Blueprint $table) {

            $table->id();
            $table->string('user_name');
            $table->string('taskInfo');
            $table->string('startTime');
            $table->string('endTime');
            $table->string('totalTime');
            $table->string('vedio_uniqueFileName')->nullable();
            $table->integer('project_id');
            $table->integer('user_id');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};