<?php
session_start();
if(isset($_SESSION['uid'])){
    echo "";
    }else{
    header('location: ../index.php');
    }

?>
<?php
include('header.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile | Typhoon Logistics</title>
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
        
        .main-wrapper {
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: calc(100vh - 150px);
            padding: 50px 0;
        }

        .container {
            max-width: 1500px; /* Extremely wide container */
            width: 90%;
        }

        .user-card-full {
            overflow: hidden;
            background: rgba(10, 10, 10, 0.7);
            border-radius: 25px;
            box-shadow: var(--shadow);
            border: 2px solid var(--border-color);
            position: relative;
            backdrop-filter: blur(5px);
            transform: perspective(1000px) rotateX(1deg);
            width: 100%;
            margin: 0 auto;
            min-height: 500px; /* Force minimum height */
        }
        
        .user-card-full::before {
            content: "";
            position: absolute;
            inset: 0;
            border-radius: 23px;
            padding: 2px; 
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

        .user-profile {
            padding: 60px 0; /* Much larger padding */
            border-radius: 23px 0 0 23px;
            position: relative;
            overflow: hidden;
            height: 100%;
        }
        
        .bg-c-lite-green {
            background: linear-gradient(135deg, var(--neon-pink), #990099);
            position: relative;
        }
        
        .bg-c-lite-green::after {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: 
                linear-gradient(rgba(0, 0, 0, 0.2) 1px, transparent 1px),
                linear-gradient(90deg, rgba(0, 0, 0, 0.2) 1px, transparent 1px);
            background-size: 15px 15px;
            z-index: 1;
            pointer-events: none;
        }

        .img-radius {
            width: 180px; /* Much larger image */
            height: 180px;
            border-radius: 50%;
            padding: 8px;
            background: rgba(0, 0, 0, 0.3);
            box-shadow: 0 0 30px rgba(255, 44, 223, 0.5);
            border: 2px solid rgba(255, 255, 255, 0.3);
            object-fit: cover;
            filter: drop-shadow(0 0 8px var(--neon-pink));
            transition: all 0.3s ease;
            margin-bottom: 30px; /* Added space below image */
        }
        
        .img-radius:hover {
            transform: scale(1.05);
            box-shadow: 0 0 35px rgba(255, 44, 223, 0.7);
        }

        .card-block {
            padding: 3rem; /* Much larger padding */
            position: relative;
            z-index: 2;
            height: 100%;
        }

        .text-white {
            color: var(--text-color) !important;
        }

        .f-w-600 {
            font-weight: 600;
            font-family: 'Orbitron', sans-serif;
            letter-spacing: 2px;
        }

        h3.f-w-600 {
            font-size: 2.2rem; /* Much larger font */
            text-transform: uppercase;
            margin-top: 25px;
            margin-bottom: 15px;
            text-shadow: 0 0 15px rgba(255, 44, 223, 0.5);
            word-break: break-word;
        }

        .card-block p {
            font-family: 'Rajdhani', sans-serif;
            color: rgba(255, 255, 255, 0.8);
            text-transform: uppercase;
            letter-spacing: 2px;
            font-size: 1.3rem; /* Much larger font */
            margin-bottom: 8px;
        }

        h6.m-b-20 {
            font-family: 'Orbitron', sans-serif;
            font-size: 1.8rem; /* Much larger heading */
            color: var(--neon-pink);
            text-transform: uppercase;
            letter-spacing: 2px;
            text-shadow: 0 0 10px rgba(255, 44, 223, 0.5);
            padding-bottom: 20px;
            position: relative;
            margin-bottom: 30px;
        }

        .b-b-default {
            border-bottom: 2px solid var(--border-color) !important;
        }

        p.m-b-10 {
            color: var(--neon-blue);
            font-family: 'Rajdhani', sans-serif;
            font-weight: 600;
            letter-spacing: 2px;
            text-transform: uppercase;
            margin-bottom: 12px;
            font-size: 1.4rem; /* Much larger font */
        }

        h6.text-muted {
            color: var(--text-color) !important;
            font-family: 'Rajdhani', sans-serif;
            font-size: 1.5rem; /* Much larger font */
            letter-spacing: 1px;
            overflow-wrap: break-word;
            word-break: break-word;
        }

        .social-link {
            border-top: 2px solid var(--border-color);
            padding-top: 30px;
            margin-top: 40px;
        }

        .social-link h6 {
            font-family: 'Orbitron', sans-serif;
            font-size: 1.3rem; /* Much larger font */
            color: rgba(255, 255, 255, 0.6);
            letter-spacing: 1px;
            text-align: center;
            font-style: italic;
        }

        .user-status {
            position: relative;
            display: inline-block;
            padding: 8px 25px; /* Much larger padding */
            background-color: rgba(0, 0, 0, 0.4);
            border: 2px solid var(--neon-blue);
            border-radius: 30px;
            color: var(--neon-blue);
            font-size: 1.1rem; /* Much larger font */
            text-transform: uppercase;
            letter-spacing: 2px;
            margin-top: 20px;
        }
        
        .user-status::before {
            content: "●";
            color: var(--neon-blue);
            margin-right: 10px;
            animation: pulse 2s infinite;
        }
        
        @keyframes pulse {
            0% {
                opacity: 0.5;
            }
            50% {
                opacity: 1;
            }
            100% {
                opacity: 0.5;
            }
        }
        
        .profile-divider {
            height: 2px;
            background: linear-gradient(to right, transparent, var(--border-color), transparent);
            margin: 30px 0; /* Much larger margin */
        }
        
        .row {
            margin-left: 0;
            margin-right: 0;
        }
        
        .m-b-25 {
            margin-bottom: 35px; /* Much larger margin */
        }
        
        /* Fix for mobile devices */
        @media only screen and (max-width: 767px) {
            .user-card-full {
                transform: none;
                margin-top: 30px;
                margin-bottom: 30px;
                min-height: auto;
            }
            
            .main-wrapper {
                padding: 20px 0;
                min-height: auto;
            }
            
            .user-profile {
                border-radius: 23px 23px 0 0;
                padding: 40px 0;
            }
            
            .card-block {
                padding: 2rem;
            }
            
            h3.f-w-600 {
                font-size: 1.8rem;
            }
            
            h6.m-b-20 {
                font-size: 1.5rem;
            }
            
            .img-radius {
                width: 140px;
                height: 140px;
            }
            
            p.m-b-10 {
                font-size: 1.2rem;
            }
            
            h6.text-muted {
                font-size: 1.3rem;
            }
        }
    </style>
</head>
<body>
    <div class="grid-overlay"></div>
    
<?php
include('../dbconnection.php');
$id= $_SESSION['uid'];
$qry= "SELECT * FROM `users` WHERE `u_id`='$id'";
$run= mysqli_query($dbcon,$qry);

$data = mysqli_fetch_assoc($run);
?>

<div class="main-wrapper">
    <div class="container">
        <div class="row d-flex justify-content-center">
            <div class="col-12"> <!-- Full width column -->
                <div class="user-card-full">
                    <div class="row m-0">
                        <div class="col-md-4 bg-c-lite-green user-profile">
                            <div class="card-block text-center text-white">
                                <div class="m-b-25">
                                    <img src="https://img.icons8.com/bubbles/100/000000/user.png" class="img-radius" alt="User-Profile-Image">
                                </div>
                                <h3 class="f-w-600"><?php echo $data['name']; ?></h3>
                                <div class="user-status">ACTIVE</div>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="card-block">
                                <h6 class="m-b-20 p-b-5 b-b-default f-w-600">USER DATA</h6>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <p class="m-b-10 f-w-600">EMAIL</p>
                                        <h6 class="text-muted f-w-400"><?php echo $data['email']; ?></h6>
                                    </div>
                                    <div class="col-sm-6">
                                        <p class="m-b-10 f-w-600">CONTACT</p>
                                        <h6 class="text-muted f-w-400"><?php echo $data['pnumber']; ?></h6>
                                    </div>
                                </div>
                                
                                <div class="profile-divider"></div>
                                
                                <div class="row">
                                    <div class="col-sm-6">
                                        <p class="m-b-10 f-w-600">ID</p>
                                        <h6 class="text-muted f-w-400">#<?php echo $data['u_id']; ?></h6>
                                    </div>
                                    <div class="col-sm-6">
                                        <p class="m-b-10 f-w-600">LEVEL</p>
                                        <h6 class="text-muted f-w-400">STANDARD</h6>
                                    </div>
                                </div>
                                
                                <div class="social-link m-t-40 m-b-10">
                                    <h6>"SYSTEM ONLINE"</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>