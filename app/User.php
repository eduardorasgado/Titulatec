<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nombre', 'email', 'apellidos', 'password', 'is_enable', 'id_role'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function role() {
        return $this->belongsTo(Role::class, 'id_role');
    }

    public function alumno() {
        return $this->hasOne(Alumno::class, 'id_user');
    }

    public function maestro() {
        return $this->hasOne(Maestro::class, 'id_user');
    }

    //scopes

    public function scopeJefeDivision($query) {
        $jefe = $query->where('id_role', Role::$ROLE_JEFE_DIVISION);
        return $jefe;
    }

    public function scopeCoordinadorApoyoTitulacionDivision($query) {
        $coordinador = $query->where('id_role', Role::$ROLE_COORDINADORA_APOYO_TITULACION);
        return $coordinador;
    }

    public function scopeDivisionEstudios($query) {
        //
        $users = $query->with('role')
            ->where('id_role', Role::$ROLE_JEFE_DIVISION)
            ->orWhere('id_role', Role::$ROLE_SECRETARIA_DIVISION)
            ->orWhere('id_role', Role::$ROLE_COORDINADORA_APOYO_TITULACION)
            ->orderBy("id_role", "desc");
        return $users;
    }

    public function scopeFindByJefeAcademia($query, $idAcademia) {
        $jefe = $query->with('maestro')
            ->where('id_role', Role::$ROLE_JEFE_ACADEMIA)
            ->whereHas('maestro', function ($query) use ($idAcademia) {
                $query->where('id_academia', $idAcademia);
            });
        return $jefe;
    }

    public function scopeServiciosEscolares($query) {
        return $query->where('id_role', '=', Role::$ROLE_SERVICIOS_ESCOLARES);
    }

    public function scopeJefesWithMaestroAndAcademia($query) {
        return $query->with('maestro.academia')
            ->where('id_role', Role::$ROLE_JEFE_ACADEMIA);
    }

    public function scopeMaestrosWithMaestroAndAcademia($query) {
        return $query->with('maestro.academia')
            ->where('id_role', Role::$ROLE_MAESTRO);
    }

    public function scopeMaestrosWithMaestroAndAcademiaByAcademia($query,
            $idAcademia
        ) {
        return $query->with('maestro.academia')
            ->where('id_role', Role::$ROLE_MAESTRO)
            ->whereHas('maestro', function($query) use ($idAcademia) {
                $query->where('id_academia', $idAcademia);
            });
    }

    public function scopeMaestrosAndJefeAcademiaWithMaestroAndAcademiaByAcademia(
        $query,
        $idAcademia
    ) {
        return $query->with('maestro.academia')
            ->where(function($query) {
                // explicacion:
                // https://stackoverflow.com/questions/40898789/laravel-orwhere-not-working-as-expected?rq=1
                $query->where('id_role', Role::$ROLE_MAESTRO)
                    ->orWhere('id_role', Role::$ROLE_JEFE_ACADEMIA);
            })
            ->whereHas('maestro', function($query) use ($idAcademia) {
                $query->where('id_academia', $idAcademia);
            });
    }

    public function scopeJefesAndMaestrosWithAcademia($query) {
        $query->with('maestro.academia')
            ->where('id_role', Role::$ROLE_JEFE_ACADEMIA)
            ->orWhere('id_role', Role::$ROLE_MAESTRO)
            ->orderBy('id_role');
        return $query;
    }

    public function scopeAlumnoWithCarrera($query, $id) {
        return $query->with('alumno.carrera')->where("id", $id);
    }

    public function scopeWithFullDEData($query) {
        return $query
            ->with([
                'alumno.proyecto',
                'alumno.procesoTitulacion',
                'alumno.carrera.especialidad'])
            ->where('id_role', Role::$ROLE_ALUMNO);
    }

    public function scopeFindByIdAlumno($query, $idAlumno) {
        return $query->with('alumno')
            ->whereHas('alumno', function($query) use ($idAlumno) {
                $query->where('id', $idAlumno);
            });
    }

    public function scopeAlumnoWithAsesoresfindByidAlumno($query, $idAlumno) {
        return $query->with([
            'alumno',
            'alumno.procesoTitulacion.asesores'
        ])
            ->whereHas('alumno', function($query) use ($idAlumno) {
                $query->where('id', $idAlumno);
            });
    }

    public function scopeFindByNumeroControl($query, $num_control) {
        return $query->with('alumno')
            ->whereHas('alumno', function($query) use ($num_control) {
                $query->where('numero_control', $num_control);
            });
    }
}
