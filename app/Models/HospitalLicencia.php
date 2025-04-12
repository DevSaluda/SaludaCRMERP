<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HospitalLicencia extends Model
{
    use HasFactory;
    
    /**
     * La tabla asociada con el modelo.
     *
     * @var string
     */
    protected $table = 'licencias';
    
    /**
     * Los atributos que son asignables masivamente.
     *
     * @var array
     */
    protected $fillable = [
        'nombre_hospital', 
        'direccion', 
        'logo', 
        'telefono', 
        'email', 
        'sitio_web', 
        'codigo_licencia', 
        'fecha_inicio', 
        'fecha_vencimiento', 
        'estado', 
        'notas',
        'es_principal'
    ];
    
    /**
     * Los atributos que deben convertirse a tipos nativos.
     *
     * @var array
     */
    protected $casts = [
        'fecha_inicio' => 'date',
        'fecha_vencimiento' => 'date',
        'es_principal' => 'boolean',
    ];
    
    /**
     * Determina si la licencia está actualmente activa
     *
     * @return bool
     */
    public function estaActiva()
    {
        return $this->estado === 'activa' && now()->lessThanOrEqualTo($this->fecha_vencimiento);
    }
    
    /**
     * Determina si la licencia está vencida
     *
     * @return bool
     */
    public function estaVencida()
    {
        return now()->greaterThan($this->fecha_vencimiento);
    }
    
    /**
     * Obtiene la licencia principal del sistema
     *
     * @return \App\Models\HospitalLicencia|null
     */
    public static function obtenerLicenciaPrincipal()
    {
        return static::where('es_principal', true)->first();
    }
    
    /**
     * Usuarios asociados a esta licencia
     */
    public function usuarios()
    {
        return $this->hasMany(User::class, 'licencia_id');
    }
}
