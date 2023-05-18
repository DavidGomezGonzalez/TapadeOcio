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
        Schema::create('banners', function (Blueprint $table) {
            $table->id();
            $table->longText('image')->nullable();
            $table->string('title');
            $table->text('content');
            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('province');
            $table->unsignedBigInteger('municipality');
            $table->string('latitud');
            $table->string('longitud');
            $table->dateTime('start_time');
            $table->dateTime('end_time');
            $table->string('place');
            $table->timestamps();

            $table->foreign('category_id')->references('id')->on('categories');
            $table->foreign('province')->references('id')->on('provincias');
            $table->foreign('municipality')->references('id')->on('municipios');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('banners');
    }
};
