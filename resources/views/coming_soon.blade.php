@extends('layouts.app')

@section('custom-styles')
<style>
    .coming-soon-container {
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        min-height: 100vh;
        padding: 20px;
        background: linear-gradient(135deg, rgba(200, 0, 150, 0.02) 0%, rgba(0, 168, 225, 0.05) 100%);
        width: 100%;
        box-sizing: border-box;
        margin: 0;
    }

    .coming-soon-card {
        background-color: var(--white);
        border-radius: 24px;
        box-shadow: 0 15px 35px rgba(0,0,0,0.08);
        padding: 50px 40px;
        width: 100%;
        max-width: 600px;
        text-align: center;
        position: relative;
        overflow: hidden;
        margin: 0 auto;
    }

    .coming-soon-card::before {
        content: '';
        position: absolute;
        top: -100px;
        right: -100px;
        width: 200px;
        height: 200px;
        border-radius: 50%;
        background: linear-gradient(135deg, var(--accent-light) 0%, var(--secondary-color) 100%);
        opacity: 0.1;
    }

    .coming-soon-card::after {
        content: '';
        position: absolute;
        bottom: -60px;
        left: -60px;
        width: 180px;
        height: 180px;
        border-radius: 50%;
        background: linear-gradient(135deg, var(--primary-color) 0%, var(--accent-color) 100%);
        opacity: 0.1;
    }

    .coming-soon-icon {
        position: relative;
        display: inline-block;
        margin-bottom: 30px;
        z-index: 1;
    }

    .coming-soon-icon i {
        font-size: 5rem;
        background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }

    .coming-soon-icon::after {
        content: '';
        position: absolute;
        width: 100%;
        height: 100%;
        top: 0;
        left: 0;
        background: radial-gradient(circle, var(--highlight) 0%, transparent 70%);
        opacity: 0.3;
        filter: blur(15px);
        z-index: -1;
    }

    .coming-soon-title {
        font-size: 2.5rem;
        font-weight: 700;
        margin-bottom: 20px;
        color: var(--text-color);
        position: relative;
        z-index: 1;
        width: 100%;
        text-align: center;
    }

    .coming-soon-text {
        font-size: 1.2rem;
        color: #666;
        margin-bottom: 35px;
        line-height: 1.6;
        position: relative;
        z-index: 1;
        width: 100%;
        text-align: center;
    }

    .back-button {
        background: linear-gradient(to right, var(--primary-color), var(--accent-color));
        color: var(--white);
        border: none;
        padding: 14px 30px;
        border-radius: 50px;
        font-size: 1rem;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        text-decoration: none;
        display: inline-block;
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        position: relative;
        z-index: 1;
        overflow: hidden;
        text-align: center;
    }

    .back-button::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: linear-gradient(to right, var(--accent-color), var(--primary-color));
        z-index: -1;
        transition: opacity 0.3s ease;
        opacity: 0;
    }

    .back-button:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 20px rgba(0,0,0,0.15);
    }

    .back-button:hover::before {
        opacity: 1;
    }

    .construction-details {
        display: flex;
        justify-content: center;
        margin: 20px 0 30px;
        position: relative;
        z-index: 1;
        width: 100%;
    }

    .construction-item {
        display: flex;
        align-items: center;
        margin: 0 15px;
        justify-content: center;
    }

    .construction-icon {
        font-size: 1.5rem;
        margin-right: 8px;
        color: var(--accent-light);
    }

    .construction-text {
        color: #666;
        font-size: 0.95rem;
    }

    .progress-bar {
        height: 6px;
        width: 80%;
        background-color: #eee;
        border-radius: 10px;
        margin: 0 auto 35px;
        position: relative;
        overflow: hidden;
        z-index: 1;
    }

    .progress-fill {
        position: absolute;
        top: 0;
        left: 0;
        height: 100%;
        width: 65%;
        background: linear-gradient(to right, var(--primary-color), var(--secondary-color));
        border-radius: 10px;
        animation: pulse-animation 2s infinite;
    }

    @keyframes pulse-animation {
        0%, 100% {
            opacity: 1;
        }
        50% {
            opacity: 0.7;
        }
    }

    @media (max-width: 768px) {
        .coming-soon-card {
            padding: 40px 25px;
        }

        .construction-details {
            flex-direction: column;
            align-items: center;
        }

        .construction-item {
            margin: 8px 0;
        }
        
        .coming-soon-title {
            font-size: 2.2rem;
        }
    }
    
    @media (max-width: 480px) {
        .coming-soon-container {
            padding: 15px;
        }
        
        .coming-soon-card {
            padding: 30px 20px;
        }
        
        .coming-soon-icon i {
            font-size: 4rem;
        }
        
        .coming-soon-title {
            font-size: 1.8rem;
            margin-bottom: 15px;
        }
        
        .coming-soon-text {
            font-size: 1rem;
            margin-bottom: 25px;
        }
        
        .back-button {
            padding: 12px 25px;
            font-size: 0.9rem;
        }
        
        .construction-text {
            font-size: 0.85rem;
        }
    }
</style>
@endsection

@section('content')
<div class="coming-soon-container">
    <div class="coming-soon-card">
        <div class="coming-soon-icon">
            <i class="fas fa-stethoscope"></i>
        </div>
        <h1 class="coming-soon-title">{{ $module }}</h1>
        
        <div class="progress-bar">
            <div class="progress-fill"></div>
        </div>
        
        <div class="construction-details">
            <div class="construction-item">
                <span class="construction-icon"><i class="fas fa-code"></i></span>
                <span class="construction-text">En desarrollo</span>
            </div>
            <div class="construction-item">
                <span class="construction-icon"><i class="fas fa-calendar-check"></i></span>
                <span class="construction-text">Próximamente</span>
            </div>
        </div>
        
        <p class="coming-soon-text">Esta sección está actualmente en desarrollo. ¡Estamos trabajando para ofrecerte una experiencia de atención médica excepcional!</p>
        
        <a href="{{ route('dashboard') }}" class="back-button">
            <i class="fas fa-arrow-left" style="margin-right: 8px;"></i> Volver al Inicio
        </a>
    </div>
</div>
@endsection 