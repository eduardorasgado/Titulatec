<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    protected $meses = ["enero", "febrero", "marzo", "abril", "mayo", "junio",
    "julio", "agosto", "septiembre", "octubre", "noviembre", "diciembre"];

    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    private function dateInitialization($date) {
        $fechaGeneracion = $date->format("d-m-Y");
        $fechaGeneracionArray = explode("-", $fechaGeneracion);
        return $fechaGeneracionArray;
    }
    /**
     * Genera una fecha con formato en español
     */
    public function formatDateHumanSpanish($date) {

        $fecha_g_spanish = $this->dateInitialization($date)[0]." de "
            .$this->meses[Carbon::now()->month-1]." de "
            .$this->dateInitialization($date)[2];

        return $fecha_g_spanish;
    }

    /**
     * Genera una fecha de formato de ejemplo: 15 dias del mes de octubre de 2021 version 2
     */
    public function formatDateHumanSpanishForActa($date) {
        
        $fecha_g_spanish = $this->dateInitialization($date)[0]." días del mes de "
            .$this->meses[Carbon::now()->month-1]." de "
            .$this->dateInitialization($date)[2];

        return $fecha_g_spanish;
    }

    /**
     * Genera una fecha de formato de ejemplo: 15 dias del mes de octubre de 2021 version 2
     */
    public function formatDateHumanSpanishForActa2($date) {
        
        $fecha_g_spanish = $this->dateInitialization($date)[0]." del mes de "
            .$this->meses[Carbon::now()->month-1]." de "
            .$this->dateInitialization($date)[2];

        return $fecha_g_spanish;
    }
}
