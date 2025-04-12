<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SALUDA - Centro Médico Familiar</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        :root {
            --primary-color: #C80096;
            --secondary-color: #00A8E1;
            --accent-color: #0057B8;
            --accent-light: #00C7B1;
            --accent-dark: #007987;
            --highlight: #FFDA00;
            --text-color: #333;
            --white: #fff;
            --light-grey: #f7f9fc;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html, body {
            height: 100%;
            width: 100%;
            overflow-x: hidden;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: var(--light-grey);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .loader {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            z-index: 9999;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            overflow: hidden;
            text-align: center;
        }

        .loader::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: radial-gradient(circle, transparent 20%, rgba(0,0,0,0.1) 100%);
            opacity: 0.3;
        }

        .loader-container {
            position: relative;
            width: 120px;
            height: 120px;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .heartbeat {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            font-size: 3.5rem;
            color: var(--white);
            animation: pulse 1.5s infinite;
        }

        .ecg-line {
            position: absolute;
            top: 60%;
            left: 0;
            width: 100%;
            height: 30px;
            stroke: var(--white);
            stroke-width: 2;
            fill: none;
            stroke-dasharray: 300;
            stroke-dashoffset: 300;
            animation: ecg 2s ease-in-out infinite;
        }

        .loading-text {
            color: var(--white);
            font-size: 1.2rem;
            font-weight: 400;
            letter-spacing: 1px;
            margin-top: 2rem;
            text-shadow: 0 2px 4px rgba(0,0,0,0.1);
            width: 100%;
            text-align: center;
            padding: 0 20px;
        }

        @keyframes pulse {
            0% { transform: translate(-50%, -50%) scale(1); }
            50% { transform: translate(-50%, -50%) scale(1.2); }
            100% { transform: translate(-50%, -50%) scale(1); }
        }

        @keyframes ecg {
            0% { stroke-dashoffset: 300; }
            50% { stroke-dashoffset: 0; }
            100% { stroke-dashoffset: -300; }
        }

        #content-wrapper {
            flex: 1;
            display: flex;
            flex-direction: column;
            width: 100%;
        }

        @media (max-width: 768px) {
            .loader-container {
                width: 100px;
                height: 100px;
            }
            
            .heartbeat {
                font-size: 3rem;
            }
            
            .loading-text {
                font-size: 1.1rem;
            }
        }
        
        @media (max-width: 480px) {
            .loader-container {
                width: 80px;
                height: 80px;
            }
            
            .heartbeat {
                font-size: 2.5rem;
            }
            
            .loading-text {
                font-size: 1rem;
                margin-top: 1.5rem;
            }
        }

        @yield('custom-styles')
    </style>
</head>
<body>
    <div class="loader">
        <div class="loader-container">
            <i class="fas fa-heartbeat heartbeat"></i>
            <svg class="ecg-line" viewBox="0 0 120 30">
                <path d="M0,15 L15,15 L20,5 L25,25 L30,5 L35,25 L40,15 L60,15 L65,0 L70,30 L75,15 L120,15"></path>
            </svg>
        </div>
        <div class="loading-text">Cargando Centro Médico Familiar...</div>
    </div>

    <div id="content-wrapper">
        @yield('content')
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(window).on('load', function() {
            $(".loader").fadeOut(2000);
        });
    </script>
    @yield('scripts')
</body>
</html> 