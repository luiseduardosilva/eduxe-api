<?php

namespace App\Services;

use App\Enums\Segmento;
use App\Enums\UnidadeFederativa;
use App\Repositories\Interfaces\IEmpresaRepository;
use App\Rules\Cnpj;
use App\Rules\Telefone;
use App\Services\Interfaces\IEmpresaService;
use App\Shared\Utils;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class EmpresaService extends Service implements IEmpresaService
{
    protected $repository;

    protected $utils;

    public function __construct(IEmpresaRepository $repository, Utils $utils)
    {
        $this->repository   = $repository;
        $this->utils        = $utils;
    }

    public function all()
    {
        return  $this->transform($this->repository->all());
    }

    function show($id){
        $empresa = $this->repository->show($id);
        return $this->transform($empresa);
    }

    public function paginate($limit = 20)
    {
        return $this->repository->paginate($limit);
    }

    function store(Request $request){

        $request['cnpj']    = $this->utils->onlyNumbers($request->cnpj);
        $request['cep']     = $this->utils->onlyNumbers($request->cep);
        $request['telefone']= $this->utils->onlyNumbers($request->telefone);

        $validator          = $this->validator($request, $this->getValidatorCreate());

        if($validator->fails()){
            return $validator->errors();
        }

        $empresa            = $request->only($this->repository->getFillable());
        $empresa            = $this->repository->store($empresa);

        if($empresa instanceof \Exception){
            return $empresa;
        }
        return  $this->transform($empresa);

    }

    function update(Request $request, $id){

        $request['cnpj']    = $this->utils->onlyNumbers($request->cnpj);
        $request['cep']     = $this->utils->onlyNumbers($request->cep);
        $request['telefone']= $this->utils->onlyNumbers($request->telefone);
        $request['id']      = $request->id;




        $validator = $this->validator($request, $this->getValidatorUpdate());

        if($validator->fails()){
            return $validator->errors();
        }

        $empresaCnpj        = $this->repository->findCnpj($request->cnpj);
        $empresa            = $this->repository->show($id);

        if($empresaCnpj && ($empresa->cnpj != $empresaCnpj->cnpj)){
            return new \Exception('Cnpj em uso');
        }

        $empresa        = $request->only($this->repository->getFillable());
        $empresa        = $this->repository->update($empresa,$id);

        return $this->transform($empresa);

    }

    function validator($request, $rules){

        $validator = Validator::make($request->all(), $rules,[
            "required"  => ":attribute é obrigatorio",
            "min"       => ":attribute requer no minimo :min caracteres",
            "max"       => ":attribute requer no maximo :max caracteres",
            "unique"    => ":attribute Já está cadastrado!",
            "exists"    => ":attribute não cadastrado",
            "in"  => ":attribute Não é validao",
        ]);

        if($this->validatorSegmento($request)){
            $validator->after(function ($validator) {
                $validator->errors()->add('inscricao_estadual', 'inscricao_estadual é obrigatorio');
            });
        }

        return $validator;
    }

    public function transform($data){

        if($data instanceof Collection){
            foreach ($data as $empresa){
                $empresa->segmento  = Segmento::SEGMENTOS[$empresa->segmento];
                $empresa->cnpj      = $this->utils->maskCnpj($empresa->cnpj);
                $empresa->telefone  = $this->utils->maskPhone($empresa->telefone);
            }
        }

        if($data instanceof Model){
            $data->segmento = Segmento::SEGMENTOS[$data->segmento];
            $data->cnpj     = $this->utils->maskCnpj($data->cnpj);
            $data->telefone = $this->utils->maskPhone($data->telefone);
        }

        return $data;
    }

    public function getValidatorCreate() {
        $unidadesFederativas = implode(',',UnidadeFederativa::UNDIADE_FEDERATIVA);
        return [
            "razao_social"          => "required",
            "cnpj"                  => ["required", "unique:empresas,cnpj", new Cnpj()],
            "nome_fantasia"         => "required",
            "cep"                   => "required|min:8|max:8",
            "logradouro"            => "required",
            "numero"                => "required",
            "telefone"              => ["required", new Telefone()],
            "email"                 => "required|email",
            "bairro"                => "required",
            "cidade"                => "required",
            "estado"                => "required|in:{$unidadesFederativas}",
            "segmento"              => "required|in:0,1,2",
            "inscricao_municipal"   => "required",
        ];
    }

    public function getValidatorUpdate() {
        $unidadesFederativas = implode(',',UnidadeFederativa::UNDIADE_FEDERATIVA);
        return [
            "id"                    => "required|exists:empresas,id",
            "razao_social"          => "required",
            "cnpj"                  => ["required", new Cnpj()],
            "nome_fantasia"         => "required",
            "cep"                   => "required|min:8|max:8",
            "logradouro"            => "required",
            "numero"                => "required",
            "telefone"              => ["required", new Telefone()],
            "email"                 => "required|email",
            "bairro"                => "required",
            "cidade"                => "required",
            "estado"                => "required|in:{$unidadesFederativas}",
            "segmento"              => "required|in:0,1,2",
            "inscricao_municipal"   => "required",
        ];
    }

    public function validatorSegmento($request) {
        if($request->segmento != 1 && empty($request->inscricao_estadual)) {// SERVIÇO
            return true;
        }
        return false;
    }
}
