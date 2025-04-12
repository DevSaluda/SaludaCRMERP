<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\HospitalLicencia;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    /**
     * Muestra el formulario de login
     */
    public function showLoginForm(Request $request)
    {
        // Obtener la licencia principal del sistema para mostrar información
        $licenciaPrincipal = HospitalLicencia::obtenerLicenciaPrincipal();
        
        // Capturar el módulo seleccionado (si existe)
        $modulo = $request->query('modulo');
        
        // Definir título y descripción según el módulo seleccionado
        $moduloInfo = [
            'titulo' => 'Iniciar Sesión',
            'descripcion' => ''
        ];
        
        if ($modulo) {
            switch ($modulo) {
                case 'pos':
                    $moduloInfo = [
                        'titulo' => 'Punto de Venta',
                        'descripcion' => 'Acceso al sistema de ventas, facturación y control de inventario'
                    ];
                    break;
                case 'citas':
                    $moduloInfo = [
                        'titulo' => 'Control de Citas',
                        'descripcion' => 'Gestión de agenda médica y citas de pacientes'
                    ];
                    break;
                case 'servicios':
                    $moduloInfo = [
                        'titulo' => 'Servicios Especializados',
                        'descripcion' => 'Administración de servicios médicos y tratamientos'
                    ];
                    break;
                case 'medicos':
                    $moduloInfo = [
                        'titulo' => 'Gestión Médica',
                        'descripcion' => 'Control del personal médico y horarios de atención'
                    ];
                    break;
            }
        }
        
        // Obtener la hora actual (similar al login original)
        date_default_timezone_set('America/Merida');
        $hora = date('g:i A');
        
        // Array de mensajes de bienvenida aleatorios
        $messages = [
            "¡Bienvenido a SALUDA! Tu salud es nuestra prioridad.",
            "Cuidando tu salud con profesionalismo y calidez.",
            "Tu farmacia de confianza, siempre cerca de ti.",
            "Atención médica de calidad para toda la familia.",
            "Más que una farmacia, somos tu aliado en salud.",
            "Comprometidos con tu bienestar integral.",
            "Tu salud, nuestra pasión."
        ];
        
        // Seleccionar un mensaje aleatorio
        $randomMessage = $messages[array_rand($messages)];
        
        // Mensaje de bienvenida según la hora del día
        $hour = (int) date('H');
        
        if ($hour >= 5 && $hour < 12) {
            $welcomeMessage = '¡Buenos días!';
        } elseif ($hour >= 12 && $hour < 19) {
            $welcomeMessage = '¡Buenas tardes!';
        } else {
            $welcomeMessage = '¡Buenas noches!';
        }
        
        return view('auth.login', compact('hora', 'randomMessage', 'welcomeMessage', 'modulo', 'moduloInfo', 'licenciaPrincipal'));
    }
    
    /**
     * Procesa el intento de login
     */
    public function login(Request $request)
    {
        // Validar datos del formulario
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
        
        // Obtener el módulo seleccionado (si existe)
        $modulo = $request->input('modulo');
        
        // Buscar el usuario por email
        $user = User::where('email', $credentials['email'])->first();
        
        // Verificar si el usuario existe y está activo
        if (!$user || !$user->is_active) {
            throw ValidationException::withMessages([
                'email' => ['El usuario no existe o está desactivado.'],
            ]);
        }
        
        // Verificar la contraseña
        if (!Hash::check($credentials['password'], $user->password)) {
            throw ValidationException::withMessages([
                'password' => ['La contraseña es incorrecta.'],
            ]);
        }
        
        // Verificar si el usuario tiene una licencia asignada y está activa
        if (!$user->licencia || !$user->licencia->estaActiva()) {
            throw ValidationException::withMessages([
                'email' => ['Este usuario no tiene una licencia activa. Contacte al administrador.'],
            ]);
        }
        
        // Iniciar sesión
        Auth::login($user, $request->boolean('remember'));
        
        // Redirigir según el módulo seleccionado
        if ($modulo) {
            switch ($modulo) {
                case 'pos':
                    return redirect()->route('pos');
                case 'citas':
                    return redirect()->route('citas');
                case 'servicios':
                    return redirect()->route('servicios');
                case 'medicos':
                    return redirect()->route('medicos');
                default:
                    return redirect()->route('dashboard');
            }
        }
        
        // Si no hay módulo específico, redirigir al dashboard principal
        return redirect()->route('dashboard');
    }
    
    /**
     * Cierra la sesión del usuario
     */
    public function logout(Request $request)
    {
        Auth::logout();
        
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return redirect()->route('login');
    }
}
