<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function formatDateHumanSpanish($date) {
        $meses = ["enero", "febrero", "marzo", "abril", "mayo", "junio",
            "julio", "agosto", "septiembre", "octubre", "novimbre", "diciembre"];

        $fechaGeneracion = $date->format("d-m-Y");
        $fechaGeneracionArray = explode("-", $fechaGeneracion);
        $fecha_g_spanish = $fechaGeneracionArray[0]." de "
            .$meses[Carbon::now()->month-1]." de "
            .$fechaGeneracionArray[2];

        return $fecha_g_spanish;
    }
}
