<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'licencia_id',
        'rol',
        'is_active'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'is_active' => 'boolean',
        ];
    }
    
    /**
     * Obtiene la licencia asociada al usuario.
     */
    public function licencia()
    {
        return $this->belongsTo(HospitalLicencia::class, 'licencia_id');
    }
    
    /**
     * Determina si el usuario tiene una licencia activa.
     *
     * @return bool
     */
    public function tieneLicenciaActiva()
    {
        return $this->licencia && $this->licencia->estaActiva();
    }
    
    /**
     * Verifica si el usuario tiene el rol especificado.
     *
     * @param string $rol
     * @return bool
     */
    public function tieneRol($rol)
    {
        return $this->rol === $rol;
    }
    
    /**
     * Verifica si el usuario es administrador.
     *
     * @return bool
     */
    public function esAdmin()
    {
        return $this->rol === 'administrador';
    }
}
