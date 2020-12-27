<?php

namespace App\Repositories\Interfaces;

interface IEmpresaRepository extends IRepository
{
    public function findCnpj($cnpj);

}
