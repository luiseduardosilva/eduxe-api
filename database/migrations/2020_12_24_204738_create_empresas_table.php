<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmpresasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('empresas', function (Blueprint $table) {
            $table->id();
            $table->string('cnpj',14)->unique();
            $table->string('razao_social');
            $table->string('nome_fantasia');
            $table->string('cep',8);
            $table->string('logradouro');
            $table->string('numero');;
            $table->string('telefone',11);
            $table->string('email');
            $table->string('complemento')->nullable();
            $table->string('bairro')->nullable();
            $table->string('cidade')->nullable();
            $table->string('estado',2)->nullable();
            $table->integer('segmento');
            $table->string('inscricao_municipal');
            $table->string('inscricao_estadual')->nullable();
            $table->softDeletes();
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
        Schema::dropIfExists('empresas');
    }
}
