<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Empresa extends Model
{
    use SoftDeletes;

    protected $fillable = [
        "nome_fantasia",
        "razao_social",
        "cnpj",
        "estado",
        "cep",
        "segmento",
        "telefone",
        "email",
        "logradouro",
        "numero",
        "bairro",
        "cidade",
        "inscricao_municipal",
        "inscricao_estadual",
        "complemento"
    ];

    protected $hidden = ["created_at", "updated_at", "deleted_at"];
}
