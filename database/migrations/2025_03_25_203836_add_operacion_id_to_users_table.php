<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            //Añadimos el fk operacions_id a la tabla users ya que cada usuario esta asociado a una operación
            $table->unsignedBigInteger('operacion_id')->nullable()->after('email');
            //Se define la llave foranea que hace referencia a el id de la tabla operaciones
            $table->foreign('operacion_id')->references('id')->on('operaciones')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign('operacion_id');
            $table->dropColumn('operacion_id');
        });
    }
};
