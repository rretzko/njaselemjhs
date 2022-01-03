<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEnsembleEventTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ensemble_event', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ensemble_id')->constrained();
            $table->foreignId('event_id')->constrained();
            $table->timestamps();
            $table->unique(['ensemble_id','event_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ensemble_event');
    }
}
