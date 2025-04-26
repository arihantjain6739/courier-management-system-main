<?php
require_once "dbconnection.php";
require_once "session.php";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {

    $fullname = $_POST['name'];
    $phn = $_POST['ph'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    if($password==$confirm_password){

    $qry = "INSERT INTO `users` (`email`, `name`, `pnumber`) VALUES ('$email', '$fullname', '$phn')";
    $run = mysqli_query($dbcon,$qry);
    
    if($run==true){

        $psqry = "INSERT INTO `login` (`email`, `password`, `u_id`) VALUES ('$email', '$password',LAST_INSERT_ID() )";
        $psrun = mysqli_query($dbcon,$psqry);
        ?>  <script>
            alert('Identity successfully registered in the system.'); 
            window.open('index.php','_self');
            </script>
        <?php
    }
    }else{
        ?>  <script>
            alert('Security codes do not match! Authentication failed.'); 
            </script>
        <?php
    }

}   
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Register | Typhoon Logistics</title>
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
            
            .login-container {
                max-width: 600px;
                margin: 50px auto;
                padding: 0;
                position: relative;
            }
            
            .login-card {
                background: rgba(10, 10, 10, 0.7);
                padding: 40px;
                border-radius: 20px;
                box-shadow: var(--shadow);
                border: 1px solid var(--border-color);
                position: relative;
                backdrop-filter: blur(5px);
                transform: perspective(1000px) rotateX(2deg);
                overflow: hidden;
            }
            
            .login-card::before {
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
            
            h2.login-title {
                font-family: 'Orbitron', sans-serif;
                color: var(--neon-pink);
                font-size: 2rem;
                text-transform: uppercase;
                letter-spacing: 3px;
                margin-bottom: 5px;
                text-align: center;
                text-shadow: 0 0 10px rgba(255, 44, 223, 0.5);
            }
            
            .login-subtitle {
                color: var(--text-color);
                font-family: 'Rajdhani', sans-serif;
                text-align: center;
                font-size: 1rem;
                letter-spacing: 1px;
                margin-bottom: 30px;
                opacity: 0.8;
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
                border-radius: 5px;
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
            
            .form-control::placeholder {
                color: rgba(255, 255, 255, 0.3);
            }
            
            .input-icon {
                position: absolute;
                right: 15px;
                top: 42px;
                color: var(--neon-pink);
                font-size: 1.1rem;
            }
            
            .btn-register {
                background-color: transparent;
                color: var(--neon-pink);
                border: 1px solid var(--neon-pink);
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
                margin-top: 10px;
            }
            
            .btn-register:hover {
                background-color: var(--neon-pink);
                color: #000;
                box-shadow: 0 0 15px rgba(255, 44, 223, 0.7);
                transform: translateY(-2px);
            }
            
            .btn-register::before {
                content: "";
                position: absolute;
                top: 0;
                left: -100%;
                width: 100%;
                height: 100%;
                background: linear-gradient(to right, transparent, rgba(255, 255, 255, 0.2), transparent);
                transition: left 0.7s;
            }
            
            .btn-register:hover::before {
                left: 100%;
            }
            
            .login-link {
                text-align: center;
                margin-top: 20px;
                font-family: 'Rajdhani', sans-serif;
                font-size: 0.9rem;
            }
            
            .login-link a {
                color: var(--neon-blue);
                transition: all 0.3s ease;
                position: relative;
                text-decoration: none;
            }
            
            .login-link a::after {
                content: "";
                position: absolute;
                bottom: -2px;
                left: 0;
                width: 0;
                height: 1px;
                background-color: var(--neon-blue);
                transition: all 0.3s ease;
            }
            
            .login-link a:hover {
                text-shadow: 0 0 8px rgba(0, 249, 255, 0.7);
            }
            
            .login-link a:hover::after {
                width: 100%;
            }
            
            .notice-text {
                margin-top: 25px;
                padding-top: 15px;
                border-top: 1px solid var(--border-color);
                font-size: 0.85rem;
                opacity: 0.7;
                text-align: center;
            }
            
            /* Animation for the form */
            @keyframes fadeIn {
                from { opacity: 0; transform: perspective(1000px) rotateX(10deg) translateY(-20px); }
                to { opacity: 1; transform: perspective(1000px) rotateX(2deg) translateY(0); }
            }
            
            .login-card {
                animation: fadeIn 0.8s ease forwards;
            }
            
            /* Fix autocomplete styling */
            input:-webkit-autofill,
            input:-webkit-autofill:hover, 
            input:-webkit-autofill:focus {
                -webkit-text-fill-color: var(--text-color);
                -webkit-box-shadow: 0 0 0px 1000px #000 inset;
                transition: background-color 5000s ease-in-out 0s;
            }
            
            /* Responsive adjustments */
            @media (max-width: 767px) {
                .login-container {
                    margin: 30px 15px;
                }
                
                .login-card {
                    transform: none;
                    padding: 30px 20px;
                }
                
                h2.login-title {
                    font-size: 1.5rem;
                }
            }
        </style>
    </head>
    <body>
        <div class="grid-overlay"></div>
        
        <div class="container login-container">
            <div class="login-card">
                <h2 class="login-title">Establish Identity</h2>
                <p class="login-subtitle">Register your digital credentials in the system</p>
                
                <form action="" method="post">
                    <div class="form-group">
                        <label><i class="fas fa-user-circle mr-2"></i>Full Identifier</label>
                        <input type="text" name="name" class="form-control" placeholder="Enter your full name" required>
                        <span class="input-icon"><i class="fas fa-id-card"></i></span>
                    </div>
                    
                    <div class="form-group">
                        <label><i class="fas fa-phone mr-2"></i>Comm Frequency</label>
                        <input type="number" name="ph" class="form-control" placeholder="Enter your contact number" required>
                        <span class="input-icon"><i class="fas fa-broadcast-tower"></i></span>
                    </div>    
                    
                    <div class="form-group">
                        <label><i class="fas fa-at mr-2"></i>Digital Address</label>
                        <input type="email" name="email" class="form-control" placeholder="Enter your email address" required />
                        <span class="input-icon"><i class="fas fa-envelope"></i></span>
                    </div>    
                    
                    <div class="form-group">
                        <label><i class="fas fa-lock mr-2"></i>Security Code</label>
                        <input type="password" name="password" class="form-control" placeholder="Create your password" required>
                        <span class="input-icon"><i class="fas fa-key"></i></span>
                    </div>
                    
                    <div class="form-group">
                        <label><i class="fas fa-shield-alt mr-2"></i>Verify Security Code</label>
                        <input type="password" name="confirm_password" class="form-control" placeholder="Confirm your password" required>
                        <span class="input-icon"><i class="fas fa-check-double"></i></span>
                    </div>
                    
                    <div class="form-group mb-0">
                        <input type="submit" name="submit" class="btn btn-register" value="INITIALIZE ACCESS">
                    </div>
                    
                    <div class="login-link">
                        <p>Already in the system? <a href="index.php">Login here</a></p>
                    </div>
                    
                    <div class="notice-text">
                        <p><i class="fas fa-exclamation-triangle mr-2"></i> System Notice: If your digital address is already registered, operation will fail. Reset your security code or use an alternate identifier.</p>
                    </div>
                </form>
            </div>
        </div>
        
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    </body>
</html>