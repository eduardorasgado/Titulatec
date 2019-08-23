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

    public function scopeDivisionEstudios($query) {
        //
        $users = $query->with('role')
            ->where('id_role', Role::$ROLE_JEFE_DIVISION)
            ->orWhere('id_role', Role::$ROLE_SECRETARIA_DIVISION)
            ->orderBy("id_role", "desc");
        return $users;
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

    public function scopeJefesAndMaestrosWithAcademia($query) {
        $query->with('maestro.academia')
            ->where('id_role', Role::$ROLE_JEFE_ACADEMIA)
            ->orWhere('id_role', Role::$ROLE_MAESTRO)
            ->orderBy('id_role');
        return $query;
    }
}
