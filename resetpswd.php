<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Identity Verification | Typhoon Logistics</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;500;600;700&family=Rajdhani:wght@300;400;500;600;700&display=swap" rel="stylesheet">
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
        
        body {
            font-family: 'Rajdhani', sans-serif;
            background-color: var(--dark-bg);
            color: var(--text-color);
            margin: 0;
            padding: 0;
            min-height: 100vh;
            position: relative;
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
        }
        
        body::before {
            content: "";
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
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
            background-image: 
                linear-gradient(rgba(255, 44, 223, 0.03) 1px, transparent 1px),
                linear-gradient(90deg, rgba(255, 44, 223, 0.03) 1px, transparent 1px);
            background-size: 50px 50px;
            z-index: -1;
            pointer-events: none;
        }
        
        .header {
            text-align: center;
            padding: 20px 0;
            position: relative;
        }
        
        .logo-title {
            font-family: 'Orbitron', sans-serif;
            font-size: 2.5rem;
            font-weight: 700;
            color: var(--neon-pink);
            text-transform: uppercase;
            letter-spacing: 3px;
            margin-bottom: 5px;
            text-shadow: 0 0 10px rgba(255, 44, 223, 0.5);
        }
        
        .logo-subtitle {
            font-family: 'Rajdhani', sans-serif;
            font-size: 1rem;
            color: var(--neon-blue);
            letter-spacing: 2px;
            margin-bottom: 0;
            text-shadow: 0 0 8px rgba(0, 249, 255, 0.5);
        }
        
        .header-divider {
            height: 1px;
            background: linear-gradient(to right, transparent, var(--neon-pink), transparent);
            margin: 15px auto;
            width: 80%;
        }
        
        .signin-link {
            position: absolute;
            top: 20px;
            right: 40px;
        }
        
        .signin-link a {
            font-family: 'Orbitron', sans-serif;
            color: var(--neon-blue);
            text-decoration: none;
            font-size: 0.9rem;
            letter-spacing: 1px;
            text-transform: uppercase;
            transition: all 0.3s ease;
            border: 1px solid transparent;
            padding: 8px 15px;
            border-radius: 20px;
        }
        
        .signin-link a:hover {
            text-shadow: 0 0 8px rgba(0, 249, 255, 0.7);
            border: 1px solid var(--neon-blue);
        }
        
        .verify-container {
            max-width: 500px;
            margin: 50px auto;
            padding: 0;
            position: relative;
        }
        
        .verify-card {
            background: rgba(10, 10, 10, 0.7);
            padding: 40px;
            border-radius: 20px;
            box-shadow: var(--shadow);
            border: 1px solid var(--border-color);
            position: relative;
            backdrop-filter: blur(5px);
            transform: perspective(1000px) rotateX(2deg);
        }
        
        .verify-card::before {
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
        
        h2.verify-title {
            font-family: 'Orbitron', sans-serif;
            color: var(--neon-pink);
            font-size: 1.5rem;
            text-transform: uppercase;
            letter-spacing: 2px;
            margin-bottom: 5px;
            text-shadow: 0 0 10px rgba(255, 44, 223, 0.3);
        }
        
        .verify-subtitle {
            color: var(--text-color);
            font-family: 'Rajdhani', sans-serif;
            font-size: 0.9rem;
            letter-spacing: 1px;
            margin-bottom: 30px;
            opacity: 0.7;
        }
        
        .form-group {
            margin-bottom: 25px;
            position: relative;
        }
        
        .form-group label {
            font-family: 'Rajdhani', sans-serif;
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: var(--neon-blue);
            display: block;
            margin-bottom: 8px;
        }
        
        .form-group::after {
            content: "";
            display: block;
            position: absolute;
            bottom: -5px;
            left: 50%;
            width: 0;
            height: 1px;
            background: linear-gradient(to right, var(--neon-pink), var(--neon-blue));
            transition: all 0.3s ease;
            transform: translateX(-50%);
        }
        
        .form-group:focus-within::after {
            width: 100%;
        }
        
        .form-control {
            background-color: #000000;
            border: 1px solid var(--border-color);
            border-radius: 8px;
            color: var(--text-color);
            padding: 12px 15px;
            font-family: 'Rajdhani', sans-serif;
            letter-spacing: 1px;
            transition: all 0.3s ease;
        }
        
        .form-control:focus {
            box-shadow: 0 0 15px rgba(255, 44, 223, 0.3);
            border-color: var(--neon-pink);
            background-color: #000000;
            outline: none;
        }
        
        .input-icon {
            position: absolute;
            right: 15px;
            top: 42px;
            color: var(--neon-pink);
            font-size: 1.1rem;
        }
        
        .btn-verify {
            background-color: transparent;
            color: var(--neon-blue);
            border: 1px solid var(--neon-blue);
            border-radius: 25px;
            padding: 12px 20px;
            font-family: 'Orbitron', sans-serif;
            font-weight: 500;
            letter-spacing: 2px;
            text-transform: uppercase;
            transition: all 0.3s ease;
            width: 100%;
            position: relative;
            overflow: hidden;
        }
        
        .btn-verify:hover {
            background-color: var(--neon-blue);
            color: #000;
            box-shadow: 0 0 15px rgba(0, 249, 255, 0.7);
            transform: translateY(-2px);
        }
        
        .btn-verify::before {
            content: "";
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(to right, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.7s;
        }
        
        .btn-verify:hover::before {
            left: 100%;
        }
        
        .register-text {
            text-align: center;
            margin-top: 20px;
            font-family: 'Rajdhani', sans-serif;
            font-size: 0.9rem;
        }
        
        .register-text a {
            color: var(--neon-pink);
            transition: all 0.3s ease;
            position: relative;
            text-decoration: none;
        }
        
        .register-text a::after {
            content: "";
            position: absolute;
            bottom: -2px;
            left: 0;
            width: 0;
            height: 1px;
            background-color: var(--neon-pink);
            transition: all 0.3s ease;
        }
        
        .register-text a:hover {
            text-shadow: 0 0 8px rgba(255, 44, 223, 0.7);
        }
        
        .register-text a:hover::after {
            width: 100%;
        }
        
        /* Animation for the card */
        @keyframes fadeIn {
            from { opacity: 0; transform: perspective(1000px) rotateX(10deg) translateY(-20px); }
            to { opacity: 1; transform: perspective(1000px) rotateX(2deg) translateY(0); }
        }
        
        .verify-card {
            animation: fadeIn 0.8s ease forwards;
        }
        
        /* Fix autofill styling */
        input:-webkit-autofill,
        input:-webkit-autofill:hover, 
        input:-webkit-autofill:focus {
            -webkit-text-fill-color: var(--text-color);
            -webkit-box-shadow: 0 0 0px 1000px #000 inset;
            transition: background-color 5000s ease-in-out 0s;
        }
        
        @media (max-width: 767px) {
            .verify-container {
                margin: 40px 15px;
            }
            
            .verify-card {
                transform: none;
                padding: 30px 20px;
            }
            
            h2.verify-title {
                font-size: 1.2rem;
            }
            
            .logo-title {
                font-size: 1.8rem;
            }
            
            .signin-link {
                position: relative;
                top: 0;
                right: 0;
                text-align: center;
                margin-top: 20px;
            }
        }
    </style>
</head>
<body>
    <div class="grid-overlay"></div>
    
    <div class="header">
        <h1 class="logo-title">Typhoon Logistics</h1>
        <div class="header-divider"></div>
        <p class="logo-subtitle">QUANTUM DELIVERY SOLUTIONS</p>
        <div class="signin-link">
            <a href="index.php"><i class="fas fa-sign-in-alt mr-2"></i>Access Portal</a>
        </div>
    </div>
    
    <div class="container verify-container">
        <div class="verify-card">
            <h2 class="verify-title">Identity Authentication</h2>
            <p class="verify-subtitle">Validate your identity to reset security protocols</p>
            
            <form action="resetpswd.php" method="get">
                <div class="form-group">
                    <label><i class="fas fa-at mr-2"></i>Digital Address</label>
                    <input type="email" name="email" class="form-control" placeholder="Enter your registered email" required>
                    <span class="input-icon"><i class="fas fa-envelope"></i></span>
                </div>
                
                <div class="form-group mb-0">
                    <button type="submit" name="submit" class="btn btn-verify">Verify Identity</button>
                </div>
                
                <div class="register-text">
                    <p>Need system access? <a href="register.php">Register new identity</a></p>
                </div>
            </form>
        </div>
    </div>
    
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

<?php
require_once "dbconnection.php";

if (isset($_REQUEST['submit'])) {
    $email = $_REQUEST['email'];

    $qryy= "SELECT * FROM `login` WHERE `email`='$email'";
    $run= mysqli_query($dbcon,$qryy);
    $row= mysqli_num_rows($run);
    if($row<1){
        ?>
        <script>
            alert("Identity verification failed. Email not recognized in the system.");
            window.open('resetpswd.php','_self');
        </script>
        <?php
    }
    else{
        $data= mysqli_fetch_assoc($run);
        $id=$data['u_id'];
        session_start();
        $_SESSION['gid']=$id;
        ?>
        <script>
            window.open('reset.php','_self');
        </script>
        <?php
    }
}
?>