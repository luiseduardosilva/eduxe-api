<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;


class EmpresaTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this->assertTrue(true);
    }


    public function testIndexCompanyStatus(){
        $response = $this->get('/api/v1/empresas');
        $response->assertStatus(200);
    }

    public function testCreateCompany(){
        $response = $this->post('/api/v1/empresas',[
            "nome_fantasia" => "LUIS LTDA",
            "razao_social" => "LUIS LTDA",
            "cnpj" => "11.493.710/0001-17",
            "estado" => "PB",
            "segmento" => 1,
            "cep" => "58071570",
            "telefone" => "(83)99623901",
            "email" => "luissilva7991@gmail.com",
            "logradouro" => "Rua",
            "numero" => 333,
            "bairro" => "Cristo",
            "cidade" => "joao",
            "inscricao_municipal" => "22222",
            "inscricao_estadual" => ""
        ]);
        $response->assertStatus(201);
    }
}
