<?php
session_start();
if(!isset($_SESSION['uid'])){
    header('location: ../login.php');
    exit();
}

include('header.php');
include('../dbconnection.php');

$idd = $_GET['sidd'];
$qryy = "SELECT * FROM `courier` WHERE `c_id`='$idd'";
$run = mysqli_query($dbcon, $qryy);
$data = mysqli_fetch_assoc($run);
$stdate = $data['date'];
$tddate = date('Y-m-d');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Package Status | Typhoon Logistics</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;500;600;700&family=Rajdhani:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --neon-pink: #ff2cdf;
            --neon-blue: #00f9ff;
            --neon-green: #0aff0a;
            --neon-yellow: #ffee00;
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
        
        .status-container {
            max-width: 800px;
            margin: 80px auto;
            padding: 0;
            position: relative;
        }
        
        .status-card {
            background: rgba(10, 10, 10, 0.7);
            padding: 30px;
            border-radius: 20px;
            box-shadow: var(--shadow);
            border: 1px solid var(--border-color);
            position: relative;
            backdrop-filter: blur(5px);
            transform: perspective(1000px) rotateX(2deg);
            overflow: hidden;
        }
        
        .status-card::before {
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
            z-index: 0;
        }
        
        .status-heading {
            font-family: 'Orbitron', sans-serif;
            text-transform: uppercase;
            letter-spacing: 3px;
            font-size: 2.2rem;
            text-align: center;
            margin-bottom: 20px;
            position: relative;
            z-index: 1;
        }
        
        .status-message {
            font-family: 'Rajdhani', sans-serif;
            text-align: center;
            font-size: 1.2rem;
            letter-spacing: 2px;
            margin-top: 20px;
            position: relative;
            z-index: 1;
        }
        
        .status-in-transit {
            color: var(--neon-yellow);
            text-shadow: 0 0 10px rgba(255, 238, 0, 0.7);
        }
        
        .status-delivered {
            color: var(--neon-green);
            text-shadow: 0 0 10px rgba(10, 255, 10, 0.7);
        }
        
        .status-icon {
            font-size: 5rem;
            display: block;
            margin: 20px auto;
            text-align: center;
            position: relative;
            z-index: 1;
        }
        
        .status-details {
            position: relative;
            z-index: 1;
            padding: 20px;
            margin-top: 20px;
            border-top: 1px solid var(--border-color);
        }
        
        .back-btn {
            background-color: transparent;
            color: var(--neon-blue);
            border: 1px solid var(--neon-blue);
            border-radius: 25px;
            padding: 12px 30px;
            font-family: 'Orbitron', sans-serif;
            font-weight: 500;
            letter-spacing: 2px;
            text-transform: uppercase;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
            margin: 30px auto 0;
            display: block;
            z-index: 1;
        }
        
        .back-btn:hover {
            background-color: var(--neon-blue);
            color: #000;
            box-shadow: 0 0 15px rgba(0, 249, 255, 0.7);
            transform: translateY(-2px);
        }
        
        .back-btn::before {
            content: "";
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(to right, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.7s;
        }
        
        .back-btn:hover::before {
            left: 100%;
        }
        
        .status-progress {
            display: flex;
            justify-content: space-between;
            margin: 40px 0 30px;
            position: relative;
            z-index: 1;
        }
        
        .progress-step {
            flex: 1;
            text-align: center;
            position: relative;
        }
        
        .progress-step:not(:last-child)::after {
            content: "";
            position: absolute;
            top: 15px;
            left: 50%;
            width: 100%;
            height: 2px;
            background: var(--border-color);
        }
        
        .progress-step.active:not(:last-child)::after {
            background: linear-gradient(to right, var(--neon-pink), var(--neon-blue));
        }
        
        .step-icon {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            background-color: var(--darker-bg);
            border: 1px solid var(--border-color);
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 10px;
            position: relative;
            z-index: 2;
        }
        
        .progress-step.active .step-icon {
            background-color: var(--neon-pink);
            box-shadow: 0 0 15px rgba(255, 44, 223, 0.7);
        }
        
        .progress-step.completed .step-icon {
            background-color: var(--neon-green);
            box-shadow: 0 0 15px rgba(10, 255, 10, 0.7);
            border-color: var(--neon-green);
        }
        
        .step-label {
            font-family: 'Rajdhani', sans-serif;
            font-size: 0.8rem;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        
        .progress-step.active .step-label {
            color: var(--neon-pink);
            font-weight: bold;
        }
        
        .progress-step.completed .step-label {
            color: var(--neon-green);
            font-weight: bold;
        }
        
        @keyframes pulse {
            0% { transform: scale(1); opacity: 1; }
            50% { transform: scale(1.1); opacity: 0.8; }
            100% { transform: scale(1); opacity: 1; }
        }
        
        .pulse-animation {
            animation: pulse 2s infinite;
        }
        
        @media (max-width: 767px) {
            .status-container {
                margin: 40px 15px;
            }
            
            .status-card {
                transform: none;
                padding: 20px;
            }
            
            .status-heading {
                font-size: 1.5rem;
            }
            
            .status-icon {
                font-size: 3rem;
            }
            
            .progress-step:not(:last-child)::after {
                width: 90%;
            }
        }
    </style>
</head>
<body>
    <div class="grid-overlay"></div>
    
    <div class="container status-container">
        <div class="status-card">
            <?php if($stdate == $tddate): ?>
                <h1 class="status-heading status-in-transit">PACKAGE IN TRANSIT</h1>
                <i class="fas fa-shipping-fast status-icon status-in-transit pulse-animation"></i>
                <div class="status-progress">
                    <div class="progress-step completed">
                        <div class="step-icon"><i class="fas fa-check"></i></div>
                        <div class="step-label">Processed</div>
                    </div>
                    <div class="progress-step active">
                        <div class="step-icon"><i class="fas fa-truck"></i></div>
                        <div class="step-label">In Transit</div>
                    </div>
                    <div class="progress-step">
                        <div class="step-icon"><i class="fas fa-box"></i></div>
                        <div class="step-label">Delivered</div>
                    </div>
                </div>
                <p class="status-message">
                    Your package is currently being transported to its destination.
                    <br>
                    Estimated delivery: Within 24 hours
                </p>
            <?php else: ?>
                <h1 class="status-heading status-delivered">DELIVERY COMPLETE</h1>
                <i class="fas fa-check-circle status-icon status-delivered"></i>
                <div class="status-progress">
                    <div class="progress-step completed">
                        <div class="step-icon"><i class="fas fa-check"></i></div>
                        <div class="step-label">Processed</div>
                    </div>
                    <div class="progress-step completed">
                        <div class="step-icon"><i class="fas fa-check"></i></div>
                        <div class="step-label">In Transit</div>
                    </div>
                    <div class="progress-step completed">
                        <div class="step-icon"><i class="fas fa-check"></i></div>
                        <div class="step-label">Delivered</div>
                    </div>
                </div>
                <p class="status-message">
                    Your package has been successfully delivered to its destination.
                    <br>
                    THANK YOU FOR CHOOSING TYPHOON LOGISTICS
                </p>
            <?php endif; ?>
            
            <div class="text-center">
                <button onclick="window.location.href='trackMenu.php'" class="back-btn">Return to Tracking</button>
            </div>
        </div>
    </div>
    
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>