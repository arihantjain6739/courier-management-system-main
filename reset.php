<?php
include('dbconnection.php');
session_start();
$gd = $_SESSION['gid'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Security Code | Typhoon Logistics</title>
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
        
        .reset-container {
            max-width: 500px;
            margin: 80px auto;
            padding: 0;
            position: relative;
        }
        
        .reset-card {
            background: rgba(10, 10, 10, 0.7);
            padding: 40px;
            border-radius: 20px;
            box-shadow: var(--shadow);
            border: 1px solid var(--border-color);
            position: relative;
            backdrop-filter: blur(5px);
            transform: perspective(1000px) rotateX(2deg);
        }
        
        .reset-card::before {
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
        
        h2.reset-title {
            font-family: 'Orbitron', sans-serif;
            color: var(--neon-pink);
            font-size: 1.8rem;
            text-transform: uppercase;
            letter-spacing: 3px;
            margin-bottom: 20px;
            text-align: center;
            text-shadow: 0 0 10px rgba(255, 44, 223, 0.5);
        }
        
        .reset-subtitle {
            color: var(--text-color);
            font-family: 'Rajdhani', sans-serif;
            text-align: center;
            font-size: 0.9rem;
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
            font-size: 1rem;
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
            width: 100%;
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
            top: 43px;
            color: var(--neon-pink);
            font-size: 1.1rem;
        }
        
        .btn-reset {
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
            cursor: pointer;
        }
        
        .btn-reset:hover {
            background-color: var(--neon-pink);
            color: #000;
            box-shadow: 0 0 15px rgba(255, 44, 223, 0.7);
            transform: translateY(-2px);
        }
        
        .btn-reset::before {
            content: "";
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(to right, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.7s;
        }
        
        .btn-reset:hover::before {
            left: 100%;
        }
        
        /* Animation for the form */
        @keyframes fadeIn {
            from { opacity: 0; transform: perspective(1000px) rotateX(10deg) translateY(-20px); }
            to { opacity: 1; transform: perspective(1000px) rotateX(2deg) translateY(0); }
        }
        
        .reset-card {
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
            .reset-container {
                margin: 40px 15px;
            }
            
            .reset-card {
                transform: none;
                padding: 30px 20px;
            }
            
            h2.reset-title {
                font-size: 1.5rem;
            }
        }
    </style>
</head>

<body>
    <div class="grid-overlay"></div>
    
    <div class="container reset-container">
        <div class="reset-card">
            <h2 class="reset-title">Security Protocol Reset</h2>
            <p class="reset-subtitle">Enter your new security code to re-establish system access</p>
            
            <form action="reset.php" method="POST">
                <div class="form-group">
                    <label><i class="fas fa-lock mr-2"></i>New Security Code</label>
                    <input type="password" name="pass" class="form-control" placeholder="Enter your new security code" required>
                    <span class="input-icon"><i class="fas fa-key"></i></span>
                </div>
                
                <div class="form-group mb-0">
                    <input type="submit" name="submit" class="btn-reset" value="RECONFIGURE ACCESS">
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
if (isset($_POST['submit'])) {
    $password = $_POST['pass'];

    $qryd = "UPDATE `login` SET `password` = '$password' WHERE `u_id` = '$gd'";
    $run = mysqli_query($dbcon, $qryd);

    if ($run == true) {
        ?> <script>
            alert('Security code successfully updated. Re-authentication required.');
            window.open('logout.php', '_self');
            </script>
        <?php
    }
}
?>