<?php


namespace App\Repositories;

use App\Models\Empresa;
use App\Repositories\Interfaces\IEmpresaRepository;
use Illuminate\Support\Facades\Log;

class EmpresaRepository extends Repository implements IEmpresaRepository
{

    function store(Array $array){
        try {
            return $this->model->create($array);
        } catch (\Exception $e){
            Log::error($e);
            return new \Exception('Error ao cadastrar Empresa');
        }
    }

    function update(Array $array, $id){

        $empresa = $this->model->find($id);
        if(!$empresa){
            return new \Exception('ID não cadastrado');
        }
        try {
            $empresa->update($array);
            return $empresa;
        } catch (\Exception $e){
            return new \Exception('Erro ao ataulizar cadastro!');
        }
    }

    function findCnpj($cnpj){
        return $this->model->where('cnpj', $cnpj)->first();
    }

    public function model(): string{
        return Empresa::class;
    }

}
