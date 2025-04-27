<?php
session_start();
if (isset($_SESSION['uid'])) {
    header('location: dashboard.php');
    exit();
}
include('../dbconnection.php');

if (isset($_POST['login'])) {
    $ademail = $_POST['uname'];
    $password = $_POST['pass'];

    $qry = "SELECT * FROM `adlogin` WHERE `email`='$ademail' AND `password`='$password'";
    $run = mysqli_query($dbcon, $qry);
    $row = mysqli_num_rows($run);

    if ($row < 1) {
        echo "<script>
            alert('Only admin can login..');
            window.open('adminlogin.php', '_self');
        </script>";
    } else {
        $data = mysqli_fetch_assoc($run);
        $id = $data['a_id'];
        $_SESSION['uid'] = $id;
        header('location: dashboard.php');
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login | Typhoon Logistics</title>
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
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
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

        /* Grid overlay */
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

        /* Circuit pattern overlay */
        .circuit-pattern {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: 
                radial-gradient(circle at 50% 50%, rgba(0, 249, 255, 0.03) 10px, transparent 10px),
                radial-gradient(circle at 25% 25%, rgba(255, 44, 223, 0.02) 5px, transparent 5px),
                radial-gradient(circle at 75% 75%, rgba(10, 255, 10, 0.02) 7px, transparent 7px);
            background-size: 100px 100px, 70px 70px, 50px 50px;
            z-index: -2;
            pointer-events: none;
            animation: circuitPulse 20s infinite alternate;
        }

        @keyframes circuitPulse {
            0% { 
                opacity: 0.6;
                background-position: 0% 0%, 0% 0%, 0% 0%;
            }
            50% { 
                opacity: 0.8;
                background-position: 1% 1%, -1% -1%, 2% 2%;
            }
            100% { 
                opacity: 0.6;
                background-position: 0% 0%, 0% 0%, 0% 0%;
            }
        }

        /* Hexagon pattern */
        .hexagon-pattern {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='28' height='49' viewBox='0 0 28 49'%3E%3Cg fill-rule='evenodd'%3E%3Cg id='hexagons' fill='%23ff2cdf' fill-opacity='0.03' fill-rule='nonzero'%3E%3Cpath d='M13.99 9.25l13 7.5v15l-13 7.5L1 31.75v-15l12.99-7.5zM3 17.9v12.7l10.99 6.34 11-6.35V17.9l-11-6.34L3 17.9zM0 15l12.98-7.5V0h-2v6.35L0 12.69v2.3zm0 18.5L12.98 41v8h-2v-6.85L0 35.81v-2.3zM15 0v7.5L27.99 15H28v-2.31h-.01L17 6.35V0h-2zm0 49v-8l12.99-7.5H28v2.31h-.01L17 42.15V49h-2z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
            z-index: -3;
            opacity: 0.5;
            pointer-events: none;
            animation: hexPulse 25s infinite linear;
        }

        @keyframes hexPulse {
            0% { 
                background-position: 0 0;
                opacity: 0.3;
            }
            50% { 
                opacity: 0.5;
            }
            100% { 
                background-position: 100px 100px;
                opacity: 0.3;
            }
        }

        /* Scan line */
        .scan-line {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(to bottom, 
                transparent 0%, 
                rgba(0, 249, 255, 0.1) 50%, 
                transparent 100%);
            background-size: 100% 10px;
            z-index: 1;
            pointer-events: none;
            opacity: 0.1;
            animation: scanAnimation 8s linear infinite;
        }

        @keyframes scanAnimation {
            0% { transform: translateY(-100%); }
            100% { transform: translateY(100%); }
        }

        @keyframes gridPulse {
            0% { opacity: 0.7; }
            50% { opacity: 0.9; }
            100% { opacity: 0.7; }
        }

        /* Digital rain effect */
        .digital-rain {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -4;
            overflow: hidden;
            opacity: 0.1;
            pointer-events: none;
        }

        .digital-rain::before {
            content: "01101001 10110010 10100111 10010101";
            font-family: 'Courier New', monospace;
            font-size: 14px;
            line-height: 14px;
            color: var(--neon-blue);
            position: absolute;
            top: -100%;
            left: 0;
            width: 100%;
            height: 200%;
            animation: digitalRain 20s linear infinite;
            transform: rotate(90deg);
            letter-spacing: 5px;
        }

        @keyframes digitalRain {
            0% { transform: translateY(-50%) rotate(90deg); }
            100% { transform: translateY(50%) rotate(90deg); }
        }

        .login-container {
            width: 400px;
            background: rgba(0, 0, 0, 0.9);
            border-radius: 12px;
            border: 1px solid rgba(255, 44, 223, 0.3);
            box-shadow: 0 0 20px rgba(255, 44, 223, 0.2), 0 0 60px rgba(255, 44, 223, 0.05);
            backdrop-filter: blur(5px);
            transform: perspective(1000px) rotateX(2deg);
            position: relative;
            animation: floatCard 6s ease-in-out infinite;
            overflow: hidden;
            z-index: 5;
        }

        @keyframes floatCard {
            0% { transform: perspective(1000px) rotateX(2deg) translateY(0px); }
            50% { transform: perspective(1000px) rotateX(2deg) translateY(-10px); }
            100% { transform: perspective(1000px) rotateX(2deg) translateY(0px); }
        }

        .login-container::after {
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

        .login-header {
            text-align: center;
            padding: 30px 20px;
            position: relative;
        }

        .login-header i {
            font-size: 50px;
            color: var(--neon-blue);
            margin-bottom: 10px;
            animation: iconGlow 3s infinite alternate;
        }

        @keyframes iconGlow {
            0% { color: var(--neon-blue); text-shadow: 0 0 5px var(--neon-blue); }
            50% { color: var(--neon-pink); text-shadow: 0 0 10px var(--neon-pink); }
            100% { color: var(--neon-blue); text-shadow: 0 0 5px var(--neon-blue); }
        }

        .login-header h1 {
            font-family: 'Orbitron', sans-serif;
            font-weight: 700;
            letter-spacing: 2px;
            text-transform: uppercase;
            color: white;
            text-shadow: 0 0 10px var(--neon-pink), 0 0 20px rgba(255, 44, 223, 0.5);
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

        .digital-dots {
            margin: 1rem 0;
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

        .login-form {
            padding: 30px;
        }

        .form-group {
            margin-bottom: 20px;
            position: relative;
        }

        .form-group i {
            position: absolute;
            left: 15px;
            top: 14px;
            color: var(--neon-blue);
            animation: iconPulse 3s infinite alternate;
        }

        @keyframes iconPulse {
            0% { opacity: 0.7; }
            100% { opacity: 1; }
        }

        .form-input {
            width: 100%;
            padding: 12px 15px 12px 45px;
            background-color: #0a0a0a !important;
            color: white !important;
            border: 1px solid rgba(255, 44, 223, 0.3) !important;
            border-radius: 6px;
            font-size: 16px;
            transition: all 0.3s;
            font-family: 'Rajdhani', sans-serif;
        }

        .form-input:focus {
            outline: none;
            border-color: var(--neon-pink) !important;
            box-shadow: 0 0 5px rgba(255, 44, 223, 0.5) !important;
        }

        .submit-btn {
            width: 100%;
            padding: 12px;
            background-color: transparent;
            color: white;
            border: 1px solid var(--neon-blue);
            border-radius: 6px;
            font-size: 16px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s;
            font-family: 'Orbitron', sans-serif;
            letter-spacing: 1px;
            text-transform: uppercase;
            position: relative;
            overflow: hidden;
            z-index: 1;
        }

        .submit-btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 44, 223, 0.3), transparent);
            transition: all 0.3s;
            z-index: -1;
        }

        .submit-btn:hover {
            color: white;
            text-shadow: 0 0 5px white;
            box-shadow: 0 0 10px rgba(255, 44, 223, 0.5);
        }

        .submit-btn:hover::before {
            left: 100%;
            animation: buttonGlow 1s;
        }

        @keyframes buttonGlow {
            0% {
                left: -100%;
            }
            100% {
                left: 100%;
            }
        }

        .back-home {
            display: block;
            text-align: center;
            margin-top: 20px;
            color: var(--neon-blue);
            text-decoration: none;
            font-weight: 500;
            font-family: 'Rajdhani', sans-serif;
            transition: all 0.3s;
        }

        .back-home:hover {
            color: var(--neon-pink);
            text-shadow: 0 0 5px var(--neon-pink);
            text-decoration: none;
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

        @media (max-width: 500px) {
            .login-container {
                width: 90%;
            }
        }
    </style>
</head>

<body>
    <div class="grid-overlay"></div>
    <div class="circuit-pattern"></div>
    <div class="hexagon-pattern"></div>
    <div class="scan-line"></div>
    <div class="digital-rain"></div>
    
    <div class="login-container animate__animated animate__fadeIn">
        <div class="glitch-overlay"></div>
        
        <div class="login-header">
            <i class="fas fa-user-shield animate__animated animate__fadeIn"></i>
            <h1 class="animate__animated animate__fadeInDown">ADMIN PORTAL</h1>
        </div>
        
        <div class="digital-dots"></div>
        
        <div class="login-form">
            <form action="adminlogin.php" method="POST">
                <div class="form-group animate__animated animate__fadeIn animate__delay-1s">
                    <i class="fas fa-envelope"></i>
                    <input type="email" class="form-input" name="uname" placeholder="Email Address" required>
                </div>
                <div class="form-group animate__animated animate__fadeIn animate__delay-2s">
                    <i class="fas fa-lock"></i>
                    <input type="password" class="form-input" name="pass" placeholder="Password" required>
                </div>
                <button type="submit" name="login" class="submit-btn animate__animated animate__fadeIn animate__delay-3s">
                    <i class="fas fa-sign-in-alt"></i> Access System
                </button>
            </form>
            <a href="../index.php" class="back-home animate__animated animate__fadeIn animate__delay-4s">
                <i class="fas fa-home"></i> Return to Main Interface
            </a>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>