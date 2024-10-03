<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('project_name');
            $table->text('project_description');
            $table->enum('project_type', ['Small', 'Medium', 'Large', 'Enterprise']);
            $table->string('duration');
            $table->date('start_time');
            $table->integer('team_size');
            $table->bigInteger('user_id')->nullable();
            $table->enum('priority', ['High', 'Medium', 'Low']);
            $table->enum('contract_type', ['Fixed', 'Hourly']);
            $table->enum('status', ['Open', 'To Do', 'Pending', 'In Progress', 'Testing', 'Deployment', 'Suspended', 'Delivered', 'Closed']);
            $table->string('reference')->nullable();
            $table->string('attachment')->nullable();
            $table->string('git_repo')->nullable();
            $table->string('client_name');
            $table->enum('level', ['Entry Level', 'Intermediate', 'Experienced']);
            $table->string('project_management_tool');
            $table->string('ticket_id')->nullable();
            $table->enum('sdlc_model', ['Waterfall', 'Agile', 'Prototype', 'V Model', 'Iterative Model']);
            $table->integer('total_sprint')->nullable();
            $table->enum('project_location', ['Remote', 'Onsite']);
            $table->enum('community', ['Slack', 'Skype', 'WhatsApp', 'Telegram', 'Trello', 'JIRA Connect', 'Teams', 'Google Meet']);
            $table->string('client_contact_number')->nullable();
            $table->string('client_email_address')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};