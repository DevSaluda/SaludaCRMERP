@extends('layouts.app')

@section('custom-styles')
<style>
    .login-container {
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 100vh;
        padding: 20px;
        background: linear-gradient(135deg, rgba(200, 0, 150, 0.03) 0%, rgba(0, 168, 225, 0.03) 100%);
        margin: 0;
        width: 100%;
        box-sizing: border-box;
    }

    .login-card {
        background-color: var(--white);
        border-radius: 24px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.08);
        padding: 40px;
        width: 100%;
        max-width: 1000px;
        text-align: center;
        position: relative;
        overflow: hidden;
        margin: 0 auto;
    }

    .login-card::before {
        content: '';
        position: absolute;
        top: -50px;
        right: -50px;
        width: 200px;
        height: 200px;
        border-radius: 50%;
        background: linear-gradient(135deg, var(--accent-light) 0%, var(--secondary-color) 100%);
        opacity: 0.1;
    }

    .login-card::after {
        content: '';
        position: absolute;
        bottom: -80px;
        left: -80px;
        width: 250px;
        height: 250px;
        border-radius: 50%;
        background: linear-gradient(135deg, var(--primary-color) 0%, var(--accent-color) 100%);
        opacity: 0.1;
    }

    .logo-container {
        margin-bottom: 40px;
        position: relative;
        z-index: 1;
    }

    .logo-icon {
        font-size: 4rem;
        display: inline-block;
        background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        margin-bottom: 10px;
        position: relative;
    }

    .logo-icon::after {
        content: '';
        position: absolute;
        width: 100%;
        height: 100%;
        top: 0;
        left: 0;
        background: radial-gradient(circle, var(--highlight) 0%, transparent 70%);
        opacity: 0.3;
        filter: blur(12px);
        z-index: -1;
    }

    .logo-text {
        color: var(--primary-color);
        margin: 10px 0 0;
        font-size: 3rem;
        font-weight: 800;
        letter-spacing: 2px;
    }

    .logo-subtext {
        background: linear-gradient(to right, var(--secondary-color), var(--accent-color));
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        margin: 5px 0 0;
        font-size: 1.3rem;
        font-weight: 500;
    }

    .card-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 25px;
        margin-top: 40px;
        position: relative;
        z-index: 1;
        max-width: 100%;
    }

    .hover-card {
        transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        cursor: pointer;
        border-radius: 20px;
        background: var(--white);
        padding: 35px 25px;
        box-shadow: 0 5px 15px rgba(0,0,0,0.04);
        position: relative;
        overflow: hidden;
        border: 1px solid rgba(0,0,0,0.04);
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
    }

    .hover-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 5px;
        background: linear-gradient(90deg, var(--primary-color), var(--secondary-color));
        transform: scaleX(0);
        transform-origin: left;
        transition: transform 0.4s ease-out;
    }

    .hover-card:hover {
        transform: translateY(-12px) scale(1.02);
        box-shadow: 0 20px 30px rgba(0,0,0,0.1);
    }

    .hover-card:hover::before {
        transform: scaleX(1);
    }

    .hover-card:hover .icon-container {
        transform: scale(1.15);
    }

    .icon-container {
        transition: transform 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        display: inline-block;
        font-size: 3rem;
        margin-bottom: 20px;
        position: relative;
    }

    .hover-card:nth-child(1) .icon-container {
        color: var(--primary-color);
    }

    .hover-card:nth-child(2) .icon-container {
        color: var(--secondary-color);
    }

    .hover-card:nth-child(3) .icon-container {
        color: var(--accent-color);
    }

    .hover-card:nth-child(4) .icon-container {
        color: var(--accent-light);
    }

    .card-title {
        font-weight: 700;
        color: var(--text-color);
        margin-top: 15px;
        font-size: 1.2rem;
        text-transform: uppercase;
        letter-spacing: 1px;
        width: 100%;
        text-align: center;
    }

    .card-subtitle {
        font-size: 0.9rem;
        color: #666;
        margin-top: 8px;
        max-width: 90%;
        margin-left: auto;
        margin-right: auto;
        text-align: center;
    }

    .floating-particles {
        position: absolute;
        width: 100%;
        height: 100%;
        top: 0;
        left: 0;
        pointer-events: none;
        z-index: 0;
    }

    .particle {
        position: absolute;
        border-radius: 50%;
        background-color: var(--highlight);
        opacity: 0.2;
        animation: float 15s infinite ease-in-out;
    }

    .p1 {
        width: 12px;
        height: 12px;
        top: 20%;
        left: 10%;
        animation-delay: 0s;
    }

    .p2 {
        width: 18px;
        height: 18px;
        top: 70%;
        left: 20%;
        background-color: var(--primary-color);
        animation-delay: 1s;
    }

    .p3 {
        width: 15px;
        height: 15px;
        top: 30%;
        right: 15%;
        background-color: var(--secondary-color);
        animation-delay: 2s;
    }

    .p4 {
        width: 10px;
        height: 10px;
        bottom: 20%;
        right: 25%;
        background-color: var(--accent-color);
        animation-delay: 3s;
    }

    @keyframes float {
        0%, 100% {
            transform: translateY(0) translateX(0);
        }
        25% {
            transform: translateY(-15px) translateX(10px);
        }
        50% {
            transform: translateY(5px) translateX(-10px);
        }
        75% {
            transform: translateY(10px) translateX(5px);
        }
    }

    /* Mejoras de responsividad */
    @media (max-width: 1024px) {
        .card-grid {
            gap: 20px;
        }
        
        .login-card {
            padding: 35px 30px;
        }
    }

    @media (max-width: 768px) {
        .card-grid {
            grid-template-columns: 1fr;
            gap: 20px;
            width: 100%;
        }

        .login-card {
            padding: 30px 20px;
            width: 100%;
        }
        
        .logo-text {
            font-size: 2.5rem;
        }
        
        .logo-subtext {
            font-size: 1.1rem;
        }
    }
    
    @media (max-width: 480px) {
        .login-container {
            padding: 15px;
        }
        
        .login-card {
            padding: 25px 15px;
        }
        
        .hover-card {
            padding: 25px 15px;
        }
        
        .logo-text {
            font-size: 2.2rem;
        }
        
        .card-title {
            font-size: 1.1rem;
        }
        
        .card-subtitle {
            font-size: 0.85rem;
        }
    }
</style>
@endsection

@section('content')
<div class="login-container">
    <div class="login-card">
        <div class="floating-particles">
            <div class="particle p1"></div>
            <div class="particle p2"></div>
            <div class="particle p3"></div>
            <div class="particle p4"></div>
        </div>
        
        <div class="logo-container">
            <i class="fas fa-heartbeat logo-icon"></i>
            <h1 class="logo-text">SALUDA</h1>
            <p class="logo-subtext">Centro Médico Familiar</p>
        </div>

        <div class="card-grid">
            <div class="hover-card" onclick="location.href='{{ route('login') }}?modulo=pos'">
                <div class="icon-container">
                    <i class="fas fa-cash-register"></i>
                </div>
                <h3 class="card-title">Punto de Venta</h3>
                <p class="card-subtitle">Gestiona ventas, facturación y productos</p>
            </div>

            <div class="hover-card" onclick="location.href='{{ route('login') }}?modulo=citas'">
                <div class="icon-container">
                    <i class="fas fa-calendar-day"></i>
                </div>
                <h3 class="card-title">Control de Citas</h3>
                <p class="card-subtitle">Agenda y administra citas médicas</p>
            </div>

            <div class="hover-card" onclick="location.href='{{ route('login') }}?modulo=servicios'">
                <div class="icon-container">
                    <i class="fas fa-hand-holding-medical"></i>
                </div>
                <h3 class="card-title">Servicios Especializados</h3>
                <p class="card-subtitle">Administra servicios clínicos y tratamientos</p>
            </div>

            <div class="hover-card" onclick="location.href='{{ route('login') }}?modulo=medicos'">
                <div class="icon-container">
                    <i class="fas fa-user-md"></i>
                </div>
                <h3 class="card-title">Médicos</h3>
                <p class="card-subtitle">Gestiona el equipo médico y horarios</p>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    // Scripts específicos del dashboard
</script>
@endsection 