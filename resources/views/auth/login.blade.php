@extends('layouts.app')

@section('custom-styles')
<style>
    :root {
        --primary-color: #C80096;
        --secondary-color: #00A8E1;
        --accent-color: #0057B8;
        --accent-light: #00C7B1;
        --accent-dark: #007987;
        --highlight: #FFDA00;
    }

    .login-container {
        display: flex;
        align-items: center;
        justify-content: center;
        min-height: 100vh;
        width: 100%;
        padding: 20px;
        background-color: #f8fafc;
        background-image: linear-gradient(rgba(255, 255, 255, 0.9), rgba(255, 255, 255, 0.9)), 
                          url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23C80096' fill-opacity='0.05'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
    }

    .login-card {
        width: 100%;
        max-width: 430px;
        background-color: white;
        border-radius: 16px;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.07);
        overflow: hidden;
        position: relative;
        animation: fadeIn 0.5s ease-in-out;
    }

    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .card-header {
        padding: 25px;
        background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
        color: white;
        text-align: center;
        position: relative;
    }

    .header-icon {
        font-size: 28px;
        background: white;
        color: var(--primary-color);
        width: 60px;
        height: 60px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 15px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15);
    }

    .header-title {
        font-size: 24px;
        font-weight: 700;
        margin: 0 0 5px;
    }

    .header-subtitle {
        font-size: 14px;
        font-weight: 400;
        opacity: 0.95;
        margin: 0;
    }

    .welcome-badge {
        display: inline-block;
        background-color: rgba(255, 255, 255, 0.2);
        padding: 6px 12px;
        border-radius: 20px;
        font-size: 13px;
        margin-top: 15px;
    }

    .welcome-badge i {
        margin-right: 6px;
    }

    .license-badge {
        display: inline-block;
        background-color: rgba(255, 255, 255, 0.15);
        padding: 6px 12px;
        border-radius: 20px;
        font-size: 13px;
        margin-top: 10px;
        border: 1px solid rgba(255, 255, 255, 0.3);
    }

    .license-badge i {
        margin-right: 6px;
    }

    .card-body {
        padding: 30px 25px;
    }

    .module-info {
        margin-bottom: 25px;
        padding: 12px 15px;
        background-color: rgba(200, 0, 150, 0.06);
        border-radius: 10px;
        display: flex;
        align-items: center;
    }

    .module-icon {
        font-size: 20px;
        color: var(--primary-color);
        margin-right: 12px;
        flex-shrink: 0;
    }

    .module-details {
        flex-grow: 1;
    }

    .module-title {
        font-weight: 600;
        color: var(--primary-color);
        margin: 0 0 3px;
        font-size: 15px;
    }

    .module-description {
        color: #666;
        font-size: 13px;
        margin: 0;
        line-height: 1.4;
    }

    .login-form {
        margin-bottom: 20px;
    }

    .form-group {
        margin-bottom: 20px;
        position: relative;
    }

    .form-group label {
        display: block;
        margin-bottom: 8px;
        color: #333;
        font-size: 14px;
        font-weight: 500;
    }

    .form-control {
        display: block;
        width: 100%;
        height: 48px;
        padding: 10px 15px;
        padding-left: 45px;
        font-size: 15px;
        background-color: #f8fafc;
        border: 1px solid #e2e8f0;
        border-radius: 8px;
        transition: all 0.2s ease;
    }

    .form-control:focus {
        border-color: var(--primary-color);
        background-color: white;
        box-shadow: 0 0 0 3px rgba(200, 0, 150, 0.1);
        outline: none;
    }

    .input-icon {
        position: absolute;
        left: 15px;
        top: 39px;
        color: #a0aec0;
        font-size: 16px;
    }

    .form-control:focus + .input-icon {
        color: var(--primary-color);
    }

    .password-toggle {
        position: absolute;
        right: 15px;
        top: 39px;
        color: #a0aec0;
        cursor: pointer;
        font-size: 16px;
        z-index: 10;
    }

    .password-toggle:hover {
        color: var(--primary-color);
    }

    .show-password-toggle {
        display: flex;
        align-items: center;
        margin-top: -12px;
        margin-bottom: 20px;
    }

    .show-password-toggle input {
        margin-right: 8px;
    }

    .show-password-toggle label {
        font-size: 13px;
        color: #666;
        cursor: pointer;
        user-select: none;
    }
    
    .remember-me {
        display: flex;
        align-items: center;
        margin-bottom: 16px;
    }
    
    .remember-me input {
        margin-right: 8px;
    }
    
    .remember-me label {
        font-size: 13px;
        color: #666;
        cursor: pointer;
        user-select: none;
    }

    .login-button {
        display: block;
        width: 100%;
        padding: 12px;
        background: linear-gradient(to right, var(--primary-color), var(--secondary-color));
        color: white;
        border: none;
        border-radius: 8px;
        font-size: 15px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        box-shadow: 0 4px 6px rgba(200, 0, 150, 0.1);
    }

    .login-button:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 10px rgba(200, 0, 150, 0.15);
    }

    .login-button:active {
        transform: translateY(0);
    }

    .back-link {
        display: block;
        text-align: center;
        margin-top: 15px;
        color: #666;
        text-decoration: none;
        font-size: 14px;
        transition: color 0.2s;
    }

    .back-link:hover {
        color: var(--primary-color);
    }

    .back-link i {
        margin-right: 6px;
    }

    .time-display {
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 20px 0;
        color: #666;
        font-size: 14px;
    }

    .time-display i {
        color: var(--primary-color);
        margin-right: 8px;
    }

    .quote-box {
        padding: 15px;
        background-color: #f8fafc;
        border-radius: 8px;
        font-style: italic;
        color: #666;
        font-size: 13px;
        line-height: 1.5;
        position: relative;
        margin: 20px 0 15px;
    }

    .quote-box::before {
        content: """;
        position: absolute;
        left: 10px;
        top: 5px;
        font-size: 30px;
        color: var(--primary-color);
        opacity: 0.2;
    }

    .card-footer {
        padding: 15px;
        background-color: #f8fafc;
        border-top: 1px solid #edf2f7;
        text-align: center;
        font-size: 12px;
        color: #888;
    }

    .error-message {
        color: #e53e3e;
        font-size: 13px;
        margin: 10px 0;
        text-align: center;
    }
    
    .validation-error {
        color: #e53e3e;
        font-size: 12px;
        margin-top: 5px;
    }

    /* Responsive adjustments */
    @media (max-width: 480px) {
        .login-container {
            padding: 15px;
        }
        
        .login-card {
            max-width: 100%;
        }
        
        .card-header {
            padding: 20px 15px;
        }
        
        .card-body {
            padding: 25px 20px;
        }
        
        .header-icon {
            width: 50px;
            height: 50px;
            font-size: 22px;
        }
        
        .header-title {
            font-size: 22px;
        }
    }
</style>
@endsection

@section('content')
<div class="login-container">
    <div class="login-card">
        <div class="card-header">
            <div class="header-icon">
                <i class="fas fa-heartbeat"></i>
            </div>
            <h1 class="header-title">SALUDA</h1>
            <p class="header-subtitle">Centro Médico Familiar</p>
            <div class="welcome-badge">
                <i class="far fa-smile"></i>{{ $welcomeMessage }}
            </div>
            @if(isset($licenciaPrincipal))
            <div class="license-badge">
                <i class="fas fa-certificate"></i>{{ $licenciaPrincipal->nombre_hospital }}
            </div>
            @endif
        </div>
        
        <div class="card-body">
            @if(isset($modulo) && $modulo)
            <div class="module-info">
                <div class="module-icon">
                    @switch($modulo)
                        @case('pos')
                            <i class="fas fa-cash-register"></i>
                            @break
                        @case('citas')
                            <i class="fas fa-calendar-day"></i>
                            @break
                        @case('servicios')
                            <i class="fas fa-hand-holding-medical"></i>
                            @break
                        @case('medicos')
                            <i class="fas fa-user-md"></i>
                            @break
                        @default
                            <i class="fas fa-lock"></i>
                    @endswitch
                </div>
                <div class="module-details">
                    <h3 class="module-title">{{ $moduloInfo['titulo'] }}</h3>
                    @if($moduloInfo['descripcion'])
                        <p class="module-description">{{ $moduloInfo['descripcion'] }}</p>
                    @endif
                </div>
            </div>
            @endif
            
            <form class="login-form" method="POST" action="{{ route('login') }}" id="login-form" autocomplete="off">
                @csrf
                
                @if(isset($modulo) && $modulo)
                    <input type="hidden" name="modulo" value="{{ $modulo }}">
                @endif
                
                <div class="form-group">
                    <label for="email">Correo electrónico</label>
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" 
                           name="email" value="{{ old('email') }}" required placeholder="tu.correo@saludamedica.com">
                    <i class="fas fa-envelope input-icon"></i>
                    @error('email')
                    <div class="validation-error">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="form-group">
                    <label for="password">Contraseña</label>
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" 
                           name="password" required placeholder="Tu contraseña">
                    <i class="fas fa-lock input-icon"></i>
                    <i class="fas fa-eye password-toggle" id="togglePassword"></i>
                    @error('password')
                    <div class="validation-error">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="show-password-toggle">
                    <input type="checkbox" id="show_password">
                    <label for="show_password">Mostrar contraseña</label>
                </div>
                
                <div class="remember-me">
                    <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                    <label for="remember">Recordar mi sesión</label>
                </div>
                
                <button type="submit" class="login-button">
                    Ingresar al Sistema
                </button>
                
                <div class="error-message" id="error"></div>
            </form>
            
            <div class="time-display">
                <i class="far fa-clock"></i>
                <span>Son las <strong id="real-time-clock">{{ $hora }}</strong></span>
            </div>
            
            <div class="quote-box">
                {{ $randomMessage }}
            </div>
            
            @if(isset($modulo) && $modulo)
                <a href="{{ route('dashboard') }}" class="back-link">
                    <i class="fas fa-arrow-left"></i> Volver al menú principal
                </a>
            @endif
        </div>
        
        <div class="card-footer">
            @if(isset($licenciaPrincipal))
                {{ $licenciaPrincipal->nombre_hospital }} | Lic. {{ $licenciaPrincipal->codigo_licencia }}
            @else
                CENTRO MÉDICO FAMILIAR | Versión 4.0
            @endif
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    // Actualizar el reloj en tiempo real
    function updateClock() {
        const now = new Date();
        let hours = now.getHours();
        const minutes = String(now.getMinutes()).padStart(2, '0');
        const ampm = hours >= 12 ? 'PM' : 'AM';
        
        hours = hours % 12;
        hours = hours ? hours : 12; // La hora '0' debe ser '12'
        
        document.getElementById('real-time-clock').textContent = hours + ':' + minutes + ' ' + ampm;
    }
    
    // Actualizar el reloj cada segundo
    setInterval(updateClock, 1000);
    
    // Mostrar/ocultar contraseña con el icono
    document.getElementById('togglePassword').addEventListener('click', function() {
        const passwordInput = document.getElementById('password');
        const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordInput.setAttribute('type', type);
        this.classList.toggle('fa-eye');
        this.classList.toggle('fa-eye-slash');
    });
    
    // Mostrar/ocultar contraseña con checkbox
    document.getElementById('show_password').addEventListener('change', function() {
        const passwordInput = document.getElementById('password');
        const passwordIcon = document.getElementById('togglePassword');
        
        if (this.checked) {
            passwordInput.setAttribute('type', 'text');
            passwordIcon.classList.remove('fa-eye');
            passwordIcon.classList.add('fa-eye-slash');
        } else {
            passwordInput.setAttribute('type', 'password');
            passwordIcon.classList.remove('fa-eye-slash');
            passwordIcon.classList.add('fa-eye');
        }
    });

    // Desactivar autocompletado
    document.getElementById('login-form').setAttribute('autocomplete', 'off');
</script>
@endsection 