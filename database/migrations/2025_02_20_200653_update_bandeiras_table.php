<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateBandeirasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Verifica se a coluna 'descricao' existe antes de tentar removê-la
        if (Schema::hasColumn('bandeiras', 'descricao')) {
            Schema::table('bandeiras', function (Blueprint $table) {
                $table->dropColumn('descricao');
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Se precisar reverter, adiciona a coluna 'descricao' de volta
        Schema::table('bandeiras', function (Blueprint $table) {
            $table->string('descricao')->nullable();
        });
    }
}
