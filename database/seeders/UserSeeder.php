<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\HospitalLicencia;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Obtener las licencias creadas
        $licenciaPrincipal = HospitalLicencia::where('es_principal', true)->first();
        $licenciaNorte = HospitalLicencia::where('codigo_licencia', 'SALUDA-NORTE-2025')->first();
        $licenciaSur = HospitalLicencia::where('codigo_licencia', 'SALUDA-SUR-2025')->first();
        
        // Crear usuario administrador general
        User::create([
            'name' => 'Administrador General',
            'email' => 'admin@saludamedica.com',
            'password' => Hash::make('admin123'),
            'licencia_id' => $licenciaPrincipal->id ?? null,
            'rol' => 'administrador',
            'is_active' => true,
        ]);
        
        // Crear usuario para sucursal principal
        User::create([
            'name' => 'Recepción SALUDA Principal',
            'email' => 'recepcion@saludamedica.com',
            'password' => Hash::make('saluda2025'),
            'licencia_id' => $licenciaPrincipal->id ?? null,
            'rol' => 'recepcion',
            'is_active' => true,
        ]);
        
        // Crear usuario para sucursal norte
        User::create([
            'name' => 'Recepción SALUDA Norte',
            'email' => 'norte@saludamedica.com',
            'password' => Hash::make('norte2025'),
            'licencia_id' => $licenciaNorte->id ?? null,
            'rol' => 'recepcion',
            'is_active' => true,
        ]);
        
        // Crear usuario para sucursal sur
        User::create([
            'name' => 'Recepción SALUDA Sur',
            'email' => 'sur@saludamedica.com',
            'password' => Hash::make('sur2025'),
            'licencia_id' => $licenciaSur->id ?? null,
            'rol' => 'recepcion',
            'is_active' => true,
        ]);
        
        // Crear varios médicos de ejemplo
        User::create([
            'name' => 'Dr. Carlos Mendoza',
            'email' => 'dr.mendoza@saludamedica.com',
            'password' => Hash::make('drcarlos2025'),
            'licencia_id' => $licenciaPrincipal->id ?? null,
            'rol' => 'medico',
            'is_active' => true,
        ]);
        
        User::create([
            'name' => 'Dra. Laura Sánchez',
            'email' => 'dra.sanchez@saludamedica.com',
            'password' => Hash::make('dralaura2025'),
            'licencia_id' => $licenciaNorte->id ?? null,
            'rol' => 'medico',
            'is_active' => true,
        ]);
    }
}
