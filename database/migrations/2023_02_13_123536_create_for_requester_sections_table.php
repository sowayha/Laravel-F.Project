<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('for_requester_sections', function (Blueprint $table) {
            $table->id();
            $table->text('description')->nullable();
            $table->string('title1')->nullable();
            $table->text('description1')->nullable();
            $table->string('title2')->nullable();
            $table->text('description2')->nullable();
            $table->string('title3')->nullable();
            $table->text('description3')->nullable();
            $table->string('title4')->nullable();
            $table->text('description4')->nullable();
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
        Schema::dropIfExists('for_requester_sections');
    }
};
