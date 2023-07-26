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
        Schema::table('categories', function (Blueprint $table) {
            $table->unsignedBigInteger('icon_id')->nullable(); // El campo puede ser nullable si una categoría puede no tener un icono asociado.
            $table->foreign('icon_id')->references('id')->on('icons')->onDelete('set null'); // Esto añade la restricción de clave foránea.
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('categories', function (Blueprint $table) {
            $table->dropForeign(['icon_id']); // Elimina la restricción de clave foránea.
            $table->dropColumn('icon_id'); // Elimina la columna.
        });
    }
};
