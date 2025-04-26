<?php
require_once "dbconnection.php";
require_once "session.php";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $qry = "SELECT * FROM `login` WHERE `email`='$email' AND `password`='$password'";
    $run = mysqli_query($dbcon, $qry);
    $row = mysqli_num_rows($run);
    if ($row < 1) {
?>
        <script>
            alert("Access denied: Invalid credentials");
            window.open('index.php', '_self');
        </script> <?php
                } else {
                    $data = mysqli_fetch_assoc($run);
                    $id = $data['u_id'];    //fetch id value of user
                    $email = $data['email'];
                    $_SESSION['uid'] = $id;   //now we can use it until session destroy
                    $_SESSION['emm'] = $email;
                    ?>
        <script>
            // alert("Welcome to Typhoon Logistics");
            window.open('home/home.php', '_self');
        </script> <?php
                }
            }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Typhoon Logistics Service</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;700&family=Rajdhani:wght@300;400;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --neon-pink: #ff2cdf;
            --neon-blue: #00f9ff;
            --dark-bg: #000000;
            --darker-bg: #050505;
            --card-bg: #0a0a0a;
            --input-bg: #0a0a0a;
            --border-color: rgba(255, 44, 223, 0.3);
            --text-color: #ffffff;
            --shadow: 0 0 20px rgba(255, 44, 223, 0.3), 0 0 60px rgba(255, 44, 223, 0.1);
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Rajdhani', sans-serif;
            background-color: var(--dark-bg);
            color: var(--text-color);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
            position: relative;
            overflow-x: hidden;
        }
        
        body::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: 
                radial-gradient(circle at 20% 35%, rgba(255, 44, 223, 0.15) 0%, transparent 50%),
                radial-gradient(circle at 75% 65%, rgba(0, 249, 255, 0.1) 0%, transparent 50%);
            z-index: -1;
        }
        
        .grid-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: 
                linear-gradient(rgba(255, 44, 223, 0.07) 1px, transparent 1px),
                linear-gradient(90deg, rgba(255, 44, 223, 0.07) 1px, transparent 1px),
                linear-gradient(rgba(0, 249, 255, 0.03) 10px, transparent 10px),
                linear-gradient(90deg, rgba(0, 249, 255, 0.03) 10px, transparent 10px);
            background-size: 50px 50px, 50px 50px, 100px 100px, 100px 100px;
            z-index: -1;
            pointer-events: none;
        }
        
        /* Horizontal scan line effect */
        .scan-line {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 2px;
            background-color: rgba(255, 44, 223, 0.15);
            box-shadow: 0 0 10px rgba(255, 44, 223, 0.5);
            z-index: -1;
            animation: scanAnimation 8s linear infinite;
            pointer-events: none;
        }
        
        @keyframes scanAnimation {
            0% { top: -10px; opacity: 0; }
            5% { opacity: 0.8; }
            95% { opacity: 0.8; }
            100% { top: 100vh; opacity: 0; }
        }
        
        .login-wrapper {
            display: flex;
            max-width: 1000px;
            width: 100%;
            background-color: rgba(0, 0, 0, 0.8);
            border-radius: 20px;
            overflow: hidden;
            box-shadow: var(--shadow);
            border: 1px solid var(--border-color);
            backdrop-filter: blur(5px);
            transform: perspective(1000px) rotateX(2deg);
            position: relative;
            z-index: 1;
        }
        
        /* Additional highlight effect on edges */
        .login-wrapper::before {
            content: "";
            position: absolute;
            inset: 0;
            border-radius: 20px;
            padding: 1px; 
            background: linear-gradient(
                135deg, 
                rgba(255, 44, 223, 0.5) 0%, 
                transparent 30%, 
                transparent 70%, 
                rgba(0, 249, 255, 0.5) 100%
            ); 
            -webkit-mask: 
                linear-gradient(#fff 0 0) content-box, 
                linear-gradient(#fff 0 0);
            -webkit-mask-composite: xor;
            mask-composite: exclude;
            pointer-events: none;
            z-index: -1;
        }
        
        .login-banner {
            flex: 1;
            background: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)), url('https://images.unsplash.com/photo-1586528116311-ad8dd3c8310d?ixlib=rb-1.2.1&auto=format&fit=crop&w=1200&q=80');
            background-size: cover;
            background-position: center;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 40px;
            position: relative;
            overflow: hidden;
        }
        
        .login-banner::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, rgba(255, 44, 223, 0.2), rgba(0, 0, 0, 0.8));
            z-index: 0;
        }
        
        .login-banner::after {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: 
                linear-gradient(rgba(255, 44, 223, 0.1) 1px, transparent 1px),
                linear-gradient(90deg, rgba(255, 44, 223, 0.1) 1px, transparent 1px);
            background-size: 30px 30px;
            z-index: 1;
        }
        
        .login-banner h1 {
            font-family: 'Orbitron', sans-serif;
            font-size: 2.5rem;
            margin-bottom: 15px;
            text-align: center;
            color: white;
            font-weight: 700;
            letter-spacing: 3px;
            text-shadow: 0 0 10px var(--neon-pink), 0 0 20px rgba(255, 44, 223, 0.5);
            position: relative;
            z-index: 2;
        }
        
        .login-banner p {
            font-size: 1.1rem;
            text-align: center;
            line-height: 1.5;
            color: rgba(255, 255, 255, 0.9);
            position: relative;
            z-index: 2;
        }
        
        .login-form-container {
            flex: 1;
            padding: 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            background-color: var(--dark-bg);
            position: relative;
            z-index: 2;
        }
        
        .login-header {
            text-align: center;
            margin-bottom: 30px;
        }
        
        .login-header h2 {
            font-family: 'Orbitron', sans-serif;
            color: white;
            font-size: 1.8rem;
            margin-bottom: 10px;
            letter-spacing: 2px;
            text-shadow: 0 0 5px rgba(255, 44, 223, 0.5);
        }
        
        .login-header p {
            color: rgba(255, 255, 255, 0.7);
            font-family: 'Rajdhani', sans-serif;
            letter-spacing: 1px;
            font-size: 1.1rem;
        }
        
        .form-group {
            margin-bottom: 25px;
            position: relative;
        }
        
        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: var(--text-color);
            font-family: 'Rajdhani', sans-serif;
            letter-spacing: 1px;
            font-size: 1rem;
        }
        
        .input-with-icon {
            position: relative;
        }
        
        .input-with-icon i {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--neon-pink);
        }
        
        .form-control {
            width: 100%;
            padding: 14px 15px 14px 45px;
            border: 1px solid var(--border-color);
            border-radius: 20px;
            font-size: 16px;
            transition: all 0.3s;
            background-color: var(--input-bg);
            color: var(--text-color);
            font-family: 'Rajdhani', sans-serif;
            letter-spacing: 1px;
        }
        
        .form-control:focus {
            outline: none;
            border-color: var(--neon-pink);
            box-shadow: 0 0 10px rgba(255, 44, 223, 0.5);
        }
        
        .form-control::placeholder {
            color: rgba(255, 255, 255, 0.5);
        }
        
        .btn {
            display: block;
            width: 100%;
            padding: 14px;
            border: none;
            border-radius: 25px;
            cursor: pointer;
            font-size: 16px;
            font-weight: 600;
            text-align: center;
            transition: all 0.3s;
            font-family: 'Orbitron', sans-serif;
            letter-spacing: 2px;
            position: relative;
            overflow: hidden;
        }
        
        .btn-primary {
            background-color: transparent;
            color: var(--neon-pink);
            border: 1px solid var(--neon-pink);
        }
        
        .btn-primary:hover {
            background-color: var(--neon-pink);
            color: white;
            box-shadow: 0 0 15px rgba(255, 44, 223, 0.7);
            transform: translateY(-2px);
        }
        
        .btn-primary::before, .btn-secondary::before {
            content: "";
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(to right, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.7s;
        }
        
        .btn-primary:hover::before, .btn-secondary:hover::before {
            left: 100%;
        }
        
        .btn-secondary {
            background-color: transparent;
            color: var(--neon-blue);
            border: 1px solid var(--neon-blue);
            margin-top: 15px;
        }
        
        .btn-secondary:hover {
            background-color: var(--neon-blue);
            color: white;
            box-shadow: 0 0 15px rgba(0, 249, 255, 0.7);
            transform: translateY(-2px);
        }
        
        .login-footer {
            margin-top: 25px;
            text-align: center;
            color: rgba(255, 255, 255, 0.7);
            font-family: 'Rajdhani', sans-serif;
        }
        
        .login-footer a {
            color: var(--neon-pink);
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s;
            position: relative;
        }
        
        .login-footer a:hover {
            text-shadow: 0 0 5px rgba(255, 44, 223, 0.7);
        }
        
        .login-footer a::after {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 50%;
            transform: translateX(-50%);
            width: 0;
            height: 1px;
            background: var(--neon-pink);
            transition: width 0.3s ease;
        }
        
        .login-footer a:hover::after {
            width: 100%;
        }
        
        /* Background circuit patterns */
        .circuit-pattern {
            position: fixed;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            background-image: url("data:image/svg+xml,%3Csvg width='100' height='100' viewBox='0 0 100 100' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M10 10h5v5h-5zM20 10h5v5h-5zM30 10h5v5h-5zM10 20h5v5h-5zM30 20h5v5h-5zM10 30h5v5h-5zM20 30h5v5h-5zM30 30h5v5h-5z' fill='rgba(255, 44, 223, 0.15)' fill-opacity='0.1' fill-rule='evenodd'/%3E%3C/svg%3E");
            opacity: 0.1;
            z-index: -2;
            pointer-events: none;
        }
        
        /* Animated particles */
        .particles span {
            position: fixed;
            pointer-events: none;
            border-radius: 50%;
            z-index: -2;
        }
        
        @keyframes particles-animation {
            0% {
                transform: translate(0, 0);
                opacity: 0;
            }
            10%, 90% {
                opacity: 0.5;
            }
            100% {
                transform: translate(var(--tx), var(--ty));
                opacity: 0;
            }
        }
        
        @media (max-width: 768px) {
            .login-wrapper {
                flex-direction: column;
                transform: none;
            }
            
            .login-banner {
                min-height: 200px;
                padding: 20px;
            }
            
            .login-form-container {
                padding: 30px 20px;
            }
        }
    </style>
</head>

<body>
    <div class="grid-overlay"></div>
    <div class="scan-line"></div>
    <div class="circuit-pattern"></div>
    <div class="particles" id="particles"></div>
    
    <div class="login-wrapper">
        <div class="login-banner">
            <h1>TYPHOON</h1>
            <p>Next-gen logistics service with lightning speed and unmatched reliability. The future of delivery is here.</p>
        </div>
        <div class="login-form-container">
            <div class="login-header">
                <h2>SYSTEM LOGIN</h2>
                <p>The Fastest Logistics Service Network</p>
            </div>
            <form action="" method="post">
                <div class="form-group">
                    <label for="email">ACCESS IDENTIFIER</label>
                    <div class="input-with-icon">
                        <i class="fas fa-envelope"></i>
                        <input type="email" id="email" name="email" class="form-control" placeholder="Enter your email address" required />
                    </div>
                </div>
                <div class="form-group">
                    <label for="password">SECURITY KEY</label>
                    <div class="input-with-icon">
                        <i class="fas fa-lock"></i>
                        <input type="password" id="password" name="password" class="form-control" placeholder="Enter your password" required>
                    </div>
                </div>
                <div class="form-group">
                    <button type="submit" name="submit" class="btn btn-primary">
                        ACCESS SYSTEM
                    </button>
                    <button type="button" onclick="window.location.href='resetpswd.php'" class="btn btn-secondary">
                        RESET SECURITY KEY
                    </button>
                </div>
                <div class="login-footer">
                    <p>Need system clearance? <a href="register.php">REGISTER NOW</a></p>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Create animated particles
        function createParticles() {
            const particlesContainer = document.getElementById('particles');
            const particleCount = 30;
            
            for (let i = 0; i < particleCount; i++) {
                const size = Math.random() * 5 + 1;
                const isBlue = Math.random() > 0.7;
                
                const particle = document.createElement('span');
                particle.style.width = `${size}px`;
                particle.style.height = `${size}px`;
                particle.style.left = `${Math.random() * 100}vw`;
                particle.style.top = `${Math.random() * 100}vh`;
                particle.style.background = isBlue ? 'rgba(0, 249, 255, 0.6)' : 'rgba(255, 44, 223, 0.6)';
                particle.style.boxShadow = isBlue ? '0 0 10px rgba(0, 249, 255, 0.8)' : '0 0 10px rgba(255, 44, 223, 0.8)';
                
                // Set random movement
                const tx = (Math.random() - 0.5) * 200;
                const ty = (Math.random() - 0.5) * 200;
                particle.style.setProperty('--tx', `${tx}px`);
                particle.style.setProperty('--ty', `${ty}px`);
                
                // Set animation
                const duration = Math.random() * 15 + 5;
                const delay = Math.random() * 5;
                particle.style.animation = `particles-animation ${duration}s ${delay}s infinite`;
                
                particlesContainer.appendChild(particle);
            }
        }
        
        // Initialize
        document.addEventListener('DOMContentLoaded', function() {
            createParticles();
        });
    </script>
</body>

</html>