<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->id();
            $table->foreignId('user_id')->comment('id of director');
            $table->string('first');
            $table->string('last');
            $table->smallInteger('grade');
            $table->foreignId('ensemble_id');
            $table->foreignId('voicepart_id');
            $table->string('guardian_first');
            $table->string('guardian_last');
            $table->string('guardian_email');
            $table->string('guardian_phone1');
            $table->string('guardian_phone2');
            $table->string('mp3');
            $table->boolean('contract')->default(0);
            $table->timestamps();
            $table->softDeletes();
            $table->index('user_id','ensemble_id');
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
