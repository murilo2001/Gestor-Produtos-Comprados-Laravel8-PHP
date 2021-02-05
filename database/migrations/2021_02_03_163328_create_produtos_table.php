<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProdutosTable extends Migration
{
    public function up()
    {
        Schema::create('produtos', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('nome');
            $table->string('categoria');
            $table->decimal('valor', 10, 2);
            $table->date('data_compra');
            $table->integer('tempo_garantia_meses');
            $table->text('observacao')->nullable();
            $table->foreignId('user_id')->constrained();
            $table->unsignedBigInteger('categoria_id');
            $table->foreign('categoria_id')->references('id')->on('categorias');
        });
    }

    public function down()
    {
        Schema::dropIfExists('produtos');
    }
}
