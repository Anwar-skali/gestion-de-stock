<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::table('produits', function (Blueprint $table) {
        $table->integer('quantite')->default(0); // Ajoutez la colonne quantite
    });
}

public function down()
{
    Schema::table('produits', function (Blueprint $table) {
        $table->dropColumn('quantite'); // Supprimez la colonne quantite si la migration est annulée
    });
}
};
