<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDirectorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('directors', function (Blueprint $table) {
            $table->foreignId('user_id')->primary();
            $table->string('first');
            $table->string('last');
            $table->string('address1');
            $table->string('address2');
            $table->string('city');
            $table->string('state_abbr');
            $table->string('postal_code');
            $table->string('country')->default('US');
            $table->string('phone');
            $table->string('membership');
            $table->string('membership_card');
            $table->string('school');
            $table->string('saddress1');
            $table->string('saddress2');
            $table->string('scity');
            $table->string('sstate_abbr');
            $table->string('spostal_code');
            $table->string('scountry')->default('US');
            $table->string('judging_day');
            $table->string('rehearsal_day');
            $table->string('festival_day');
            $table->unsignedInteger('elem_student_count')->default(0);
            $table->unsignedInteger('jhs_student_count')->default(0);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('directors');
    }
}
