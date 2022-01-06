<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateScoredefinitionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('scoredefinitions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('scorecategory_id')->constrained();
            $table->foreignId('scorecomponent_id')->constrained();
            $table->tinyInteger('order_by')->default(1);
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
        Schema::dropIfExists('scoredefinitions');
    }
}
