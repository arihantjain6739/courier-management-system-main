<?php
session_start();
if (isset($_SESSION['uid'])) {
    echo "";
} else {
    header('location: ../index.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page | Typhoon Logistics</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;700&family=Rajdhani:wght@300;400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        :root {
            --neon-pink: #ff2cdf;
            --neon-blue: #00f9ff;
            --neon-green: #0aff0a;
            --dark-bg: #000000;
        }

        body {
            background-color: var(--dark-bg);
            color: white;
            font-family: 'Rajdhani', sans-serif;
            overflow-x: hidden;
            position: relative;
        }

        .bg-light, .bg-white, .card, .modal-content, .dropdown-menu {
            background-color: var(--dark-bg) !important;
            color: white !important;
        }

        .container, .container-fluid, .row, .col, [class^="col-"] {
            background-color: transparent;
        }

        body::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: black; /* Ensures black base */
            background-image: 
                radial-gradient(circle at 20% 35%, rgba(255, 44, 223, 0.08) 0%, transparent 40%),
                radial-gradient(circle at 75% 65%, rgba(0, 249, 255, 0.05) 0%, transparent 40%);
            z-index: -1;
        }

        .grid-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: black; /* Black base layer */
            background-image: 
                linear-gradient(rgba(255, 44, 223, 0.03) 1px, transparent 1px),
                linear-gradient(90deg, rgba(255, 44, 223, 0.03) 1px, transparent 1px);
            background-size: 50px 50px;
            z-index: -1;
            pointer-events: none;
            animation: gridPulse 15s infinite alternate;
        }

        @keyframes gridPulse {
            0% { opacity: 0.7; }
            50% { opacity: 0.9; }
            100% { opacity: 0.7; }
        }

        .content {
            margin-top: 8%;
            text-align: center;
            padding: 3rem;
            background: rgba(0, 0, 0, 0.9);
            border-radius: 12px;
            border: 1px solid rgba(255, 44, 223, 0.3);
            box-shadow: 0 0 20px rgba(255, 44, 223, 0.2), 0 0 60px rgba(255, 44, 223, 0.05);
            backdrop-filter: blur(5px);
            transform: perspective(1000px) rotateX(2deg);
            position: relative;
            animation: floatCard 6s ease-in-out infinite;
            overflow: hidden;
        }

        @keyframes floatCard {
            0% { transform: perspective(1000px) rotateX(2deg) translateY(0px); }
            50% { transform: perspective(1000px) rotateX(2deg) translateY(-10px); }
            100% { transform: perspective(1000px) rotateX(2deg) translateY(0px); }
        }

        .content::after {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: linear-gradient(
                0deg,
                transparent,
                rgba(255, 44, 223, 0.1),
                rgba(255, 44, 223, 0.1),
                transparent
            );
            transform: rotate(25deg);
            animation: scanline 6s linear infinite;
        }

        @keyframes scanline {
            0% { top: -200%; }
            100% { top: 200%; }
        }

        .glitch-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
            opacity: 0;
            animation: glitchEffect 10s infinite;
            z-index: 10;
            mix-blend-mode: overlay;
        }

        @keyframes glitchEffect {
            0%, 93%, 100% { opacity: 0; }
            94% { opacity: 0.5; transform: translate(2px, 3px); }
            95% { opacity: 0.7; transform: translate(-3px, -2px); }
            96% { opacity: 0.5; transform: translate(0px, 0px); }
            97% { opacity: 0.7; transform: translate(2px, -1px); }
            98% { opacity: 0.5; transform: translate(-2px, 1px); }
            99% { opacity: 0; transform: translate(0px, 0px); }
        }

        h2, h3, h4 {
            font-family: 'Orbitron', sans-serif;
            letter-spacing: 2px;
            position: relative;
            z-index: 1;
        }

        h2 {
            font-weight: 700;
            color: white;
            margin-bottom: 1.5rem;
            text-transform: uppercase;
            text-shadow: 0 0 10px var(--neon-pink), 0 0 20px rgba(255, 44, 223, 0.5);
            display: inline-block;
            animation: textFlicker 5s infinite alternate;
        }

        @keyframes textFlicker {
            0%, 19.999%, 22%, 62.999%, 64%, 64.999%, 70%, 100% {
                opacity: 1;
                text-shadow: 0 0 10px var(--neon-pink), 0 0 20px rgba(255, 44, 223, 0.5);
            }
            20%, 21.999%, 63%, 63.999%, 65%, 69.999% {
                opacity: 0.8;
                text-shadow: none;
            }
        }

        h4 {
            color: white;
            font-weight: 400;
            border-bottom: 1px solid var(--neon-pink);
            padding-bottom: 1rem;
            margin-bottom: 1.5rem;
            display: inline-block;
            animation: borderPulse 4s infinite;
        }

        @keyframes borderPulse {
            0%, 100% { border-color: var(--neon-pink); }
            50% { border-color: var(--neon-blue); }
        }

        h3 {
            margin-top: 1rem;
            background: linear-gradient(90deg, var(--neon-blue), var(--neon-pink));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            font-weight: 700;
            animation: gradientShift 8s infinite;
        }

        @keyframes gradientShift {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        .logo-glow {
            position: relative;
            display: inline-block;
        }

        .logo-glow::after {
            content: "";
            position: absolute;
            top: 50%;
            left: 50%;
            width: 100%;
            height: 100%;
            transform: translate(-50%, -50%);
            background: radial-gradient(circle, rgba(255, 44, 223, 0.8) 0%, transparent 70%);
            filter: blur(20px);
            z-index: -1;
            opacity: 0.5;
            animation: pulse 3s infinite alternate;
        }

        @keyframes pulse {
            0% { opacity: 0.3; transform: translate(-50%, -50%) scale(0.8); }
            100% { opacity: 0.5; transform: translate(-50%, -50%) scale(1.2); }
        }

        .digital-dots {
            margin: 2rem 0;
            height: 5px;
            width: 100%;
            background-image: radial-gradient(var(--neon-pink) 1px, transparent 1px);
            background-size: 10px 10px;
            opacity: 0.7;
            animation: dotsPulse 3s infinite alternate;
        }

        @keyframes dotsPulse {
            0% { 
                opacity: 0.5;
                background-image: radial-gradient(var(--neon-pink) 1px, transparent 1px);
            }
            50% { 
                opacity: 0.7;
                background-image: radial-gradient(var(--neon-blue) 1px, transparent 1px);
            }
            100% { 
                opacity: 0.5;
                background-image: radial-gradient(var(--neon-pink) 1px, transparent 1px);
            }
        }

        p {
            color: rgba(255, 255, 255, 0.9);
            font-size: 1.1rem;
            line-height: 1.5;
            text-shadow: 0 0 2px rgba(255, 255, 255, 0.3);
            animation: fadeInUp 1s ease-out 0.5s both;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .service-features {
            margin-top: 40px;
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
        }

        .feature-item {
            margin: 10px 20px;
            text-align: center;
            opacity: 0;
            animation: featureAppear 0.6s ease-out forwards;
        }

        .feature-item:nth-child(1) { animation-delay: 0.7s; }
        .feature-item:nth-child(2) { animation-delay: 0.9s; }
        .feature-item:nth-child(3) { animation-delay: 1.1s; }

        @keyframes featureAppear {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .feature-icon {
            font-size: 2rem;
            margin-bottom: 15px;
            color: var(--neon-blue);
            animation: iconGlow 3s infinite alternate;
        }

        @keyframes iconGlow {
            0% { color: var(--neon-blue); text-shadow: 0 0 5px var(--neon-blue); }
            50% { color: var(--neon-pink); text-shadow: 0 0 10px var(--neon-pink); }
            100% { color: var(--neon-blue); text-shadow: 0 0 5px var(--neon-blue); }
        }

        .feature-text {
            font-size: 0.9rem;
            letter-spacing: 1px;
            color: rgba(255, 255, 255, 0.8);
        }

        .typing-text {
            overflow: hidden;
            border-right: 2px solid var(--neon-pink);
            white-space: nowrap;
            margin: 0 auto;
            width: 0;
            animation: typing 3.5s steps(40, end) forwards, blink-caret 0.75s step-end infinite;
            animation-delay: 1.5s;
        }

        @keyframes typing {
            from { width: 0 }
            to { width: 100% }
        }

        @keyframes blink-caret {
            from, to { border-color: transparent }
            50% { border-color: var(--neon-pink) }
        }

        .counter-section {
            margin-top: 30px;
            margin-bottom: 20px;
            display: flex;
            justify-content: space-around;
            flex-wrap: wrap;
        }

        .counter-item {
            margin: 10px;
            text-align: center;
        }

        .counter-number {
            font-family: 'Orbitron', sans-serif;
            font-size: 1.8rem;
            color: var(--neon-blue);
            margin-bottom: 5px;
        }

        .counter-label {
            font-size: 0.8rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: rgba(255, 255, 255, 0.7);
        }

        input, select, textarea, .form-control {
            background-color: #0a0a0a !important;
            color: white !important;
            border: 1px solid rgba(255, 44, 223, 0.3) !important;
        }

        input:focus, select:focus, textarea:focus, .form-control:focus {
            background-color: #0a0a0a !important;
            color: white !important;
            border-color: var(--neon-pink) !important;
            box-shadow: 0 0 5px rgba(255, 44, 223, 0.5) !important;
        }

        table, th, td {
            background-color: #000000 !important;
            color: white !important;
            border-color: rgba(255, 44, 223, 0.3) !important;
        }

        th {
            background-color: #0a0a0a !important;
            color: var(--neon-pink) !important;
            font-family: 'Orbitron', sans-serif;
            letter-spacing: 1px;
        }
    </style>
</head>
<body>
    <div class="grid-overlay"></div>
    <?php include('header.php'); ?>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10 content animate__animated animate__fadeIn">
                <div class="glitch-overlay"></div>
                
                <div class="logo-glow">
                    <h2 class="animate__animated animate__fadeInDown">TYPHOON</h2>
                </div>
                <h4 class="animate__animated animate__fadeIn animate__delay-1s">Logistics Management System</h4>

                <div class="digital-dots"></div>

                <p class="mb-4 typing-text">The fastest logistics service network across India, powered by advanced tracking technology</p>

                <h3 class="animate__animated animate__fadeIn animate__delay-2s">NEXT-GEN LOGISTICS</h3>
                
                <div class="service-features">
                    <div class="feature-item">
                        <i class="fas fa-shipping-fast feature-icon"></i>
                        <p class="feature-text">Ultra-Fast Delivery</p>
                    </div>
                    <div class="feature-item">
                        <i class="fas fa-globe feature-icon"></i>
                        <p class="feature-text">Global Network</p>
                    </div>
                    <div class="feature-item">
                        <i class="fas fa-shield-alt feature-icon"></i>
                        <p class="feature-text">Secure Transport</p>
                    </div>
                </div>
                
                <div class="counter-section animate__animated animate__fadeIn animate__delay-3s">
                    <div class="counter-item">
                        <div class="counter-number" id="cities-counter">0</div>
                        <div class="counter-label">Cities</div>
                    </div>
                    <div class="counter-item">
                        <div class="counter-number" id="packages-counter">0</div>
                        <div class="counter-label">Packages Daily</div>
                    </div>
                    <div class="counter-item">
                        <div class="counter-number" id="vehicles-counter">0</div>
                        <div class="counter-label">Delivery Vehicles</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        // Counter animation
        function animateCounter(elementId, finalValue, duration) {
            let startTime = null;
            const element = document.getElementById(elementId);
            
            function animate(currentTime) {
                if (!startTime) startTime = currentTime;
                const timeElapsed = currentTime - startTime;
                const progress = Math.min(timeElapsed / duration, 1);
                const currentValue = Math.floor(progress * finalValue);
                
                element.textContent = currentValue;
                
                if (progress < 1) {
                    requestAnimationFrame(animate);
                } else {
                    element.textContent = finalValue;
                }
            }
            
            requestAnimationFrame(animate);
        }
        
        // Start counter animations after a delay
        setTimeout(() => {
            animateCounter('cities-counter', 210, 2000);
            animateCounter('packages-counter', 25000, 2000);
            animateCounter('vehicles-counter', 5700, 2000);
        }, 3000);
    </script>
</body>
</html>