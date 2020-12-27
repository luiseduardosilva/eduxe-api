<?php

namespace App\Http\Controllers\Api;

use App\Services\Interfaces\IEmpresaService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\MessageBag;

class EmpresaController extends CrudController
{
    protected $service;
//
    public function __construct(IEmpresaService $service)
    {
        $this->service = $service;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request): JsonResponse
    {
        $empresa = $this->service->store($request);

        if($empresa instanceof MessageBag){
            return new JsonResponse([
                "error"     => $empresa,
                "message"   => "Erro de validação"], 400, []
            );
        }
        if ($empresa instanceof \Exception){
            return new JsonResponse([
                "error"     => $empresa->getMessage(),
                "message"   => "Erro Interno"], 400, []
            );
        }
        return new JsonResponse([
                "message" => "Cadastro realizado com sucesso",
                "data" => $empresa], 201, []
        );
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id): JsonResponse
    {
        $empresa = $this->service->update($request, $id);

        if($empresa instanceof MessageBag){
            return new JsonResponse([
                "error"     => $empresa], 400, []
            );
        }
        if ($empresa instanceof \Exception){
            return new JsonResponse([
                "error"     => $empresa->getMessage()], 400, []
            );
        }
        return new JsonResponse([
            "message" => "Cadastro atualizado com sucesso",
            "data" => $empresa], 200, []
        );
    }
}
