<?php

namespace Database\Seeders;

use App\Models\HospitalLicencia;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HospitalLicenciaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Crear licencia principal
        DB::table('licencias')->insert([
            'nombre_hospital' => 'SALUDA Centro Médico Familiar',
            'direccion' => 'Calle Principal #123, Mérida, Yucatán',
            'telefono' => '999-123-4567',
            'email' => 'contacto@saludamedica.com',
            'sitio_web' => 'www.saludamedica.com',
            'codigo_licencia' => 'SALUDA-HQ-2025',
            'fecha_inicio' => now(),
            'fecha_vencimiento' => now()->addYears(1),
            'estado' => 'activa',
            'notas' => 'Licencia principal del Centro Médico Familiar SALUDA',
            'es_principal' => true,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        
        // Crear sucursal norte
        DB::table('licencias')->insert([
            'nombre_hospital' => 'SALUDA Norte',
            'direccion' => 'Av. García Lavín #456, Mérida, Yucatán',
            'telefono' => '999-987-6543',
            'email' => 'norte@saludamedica.com',
            'sitio_web' => 'www.saludamedica.com/norte',
            'codigo_licencia' => 'SALUDA-NORTE-2025',
            'fecha_inicio' => now(),
            'fecha_vencimiento' => now()->addYear(),
            'estado' => 'activa',
            'notas' => 'Sucursal norte del Centro Médico Familiar SALUDA',
            'es_principal' => false,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        
        // Crear sucursal sur
        DB::table('licencias')->insert([
            'nombre_hospital' => 'SALUDA Sur',
            'direccion' => 'Calle 42 Sur #789, Mérida, Yucatán',
            'telefono' => '999-456-7890',
            'email' => 'sur@saludamedica.com',
            'sitio_web' => 'www.saludamedica.com/sur',
            'codigo_licencia' => 'SALUDA-SUR-2025',
            'fecha_inicio' => now(),
            'fecha_vencimiento' => now()->addYear(),
            'estado' => 'activa',
            'notas' => 'Sucursal sur del Centro Médico Familiar SALUDA',
            'es_principal' => false,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
