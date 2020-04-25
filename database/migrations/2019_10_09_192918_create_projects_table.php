<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('user_id');
            $table->string('name');
            $table->string('description')->nullable();
            $table->enum('type', ['Professionnal', 'Personal', 'TP', 'other']);
            $table->enum('category', ['Software', 'Website', 'Web app', 'Mobile app', 'Other']);
            $table->integer('step');
            $table->string('client');
            $table->date('date_start')->nullable();
            $table->date('date_end')->nullable();
            $table->date('deadline');
            $table->enum('status', ['Pending', 'In process', 'Finished']);
            $table->string('version');
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
        Schema::dropIfExists('projects');
    }
}
