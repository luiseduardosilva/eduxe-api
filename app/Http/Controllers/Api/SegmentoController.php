<?php

namespace App\Http\Controllers\Api;

use App\Enums\Segmento;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;

class SegmentoController extends Controller
{
    public function index(): JsonResponse
    {
        for($i = 0; $i < count(Segmento::SEGMENTOS);$i++){
            $segmentos [] = ["id" => $i, "nome" => Segmento::SEGMENTOS[$i]];
        }
        return new JsonResponse(["data" => $segmentos], 200, []);
    }
}
