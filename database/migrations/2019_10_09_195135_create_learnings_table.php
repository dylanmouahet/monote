<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLearningsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('learnings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('user_id');
            $table->string('name');
            $table->string('description')->nullable();
            $table->enum('type', ['Video', 'Audio', 'PDF', 'Online', 'Other']);
            $table->string('category');
            $table->integer('chapter');
            $table->string('teacher')->nullable();
            $table->string('source')->nullable();
            $table->string('url')->nullable();
            $table->enum('status', ['Pending', 'In process', 'Finished']);
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
        Schema::dropIfExists('learnings');
    }
}
