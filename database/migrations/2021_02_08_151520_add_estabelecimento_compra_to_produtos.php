<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddEstabelecimentoCompraToProdutos extends Migration
{

    public function up()
    {
        Schema::table('produtos', function (Blueprint $table) {
            $table->string('estabelecimento_compra')->after('valor');
        });
    }

    public function down()
    {
        Schema::table('produtos', function (Blueprint $table) {
            $table->dropColumn('estabelecimento_compra');
        });
    }
}
