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
            min-height: calc(100vh - 150px); /* Increased space for navbar */
            padding: 100px 0; /* Increased padding */
        }

        .user-card-full {
            overflow: hidden;
            background: rgba(10, 10, 10, 0.7);
            border-radius: 20px;
            box-shadow: var(--shadow);
            border: 1px solid var(--border-color);
            position: relative;
            backdrop-filter: blur(5px);
            transform: perspective(1000px) rotateX(1deg); /* Reduced angle */
            width: 100%;
            margin: 0 auto;
        }
        
        .user-card-full::before {
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

        .user-profile {
            padding: 30px 0;
            border-radius: 20px 0 0 20px;
            position: relative;
            overflow: hidden;
            height: 100%; /* Match height */
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
            width: 90px; /* Slightly smaller image */
            height: 90px;
            border-radius: 50%;
            padding: 5px;
            background: rgba(0, 0, 0, 0.3);
            box-shadow: 0 0 20px rgba(255, 44, 223, 0.5);
            border: 1px solid rgba(255, 255, 255, 0.3);
            object-fit: cover;
            filter: drop-shadow(0 0 5px var(--neon-pink));
            transition: all 0.3s ease;
        }
        
        .img-radius:hover {
            transform: scale(1.05);
            box-shadow: 0 0 25px rgba(255, 44, 223, 0.7);
        }

        .card-block {
            padding: 1.5rem;
            position: relative;
            z-index: 2;
            height: 100%; /* Full height */
        }

        .text-white {
            color: var(--text-color) !important;
        }

        .f-w-600 {
            font-weight: 600;
            font-family: 'Orbitron', sans-serif;
            letter-spacing: 1px;
        }

        h3.f-w-600 {
            font-size: 1.3rem; /* Smaller font */
            text-transform: uppercase;
            margin-top: 15px;
            margin-bottom: 5px;
            text-shadow: 0 0 10px rgba(255, 44, 223, 0.5);
            word-break: break-word; /* Handle long names */
        }

        .card-block p {
            font-family: 'Rajdhani', sans-serif;
            color: rgba(255, 255, 255, 0.8);
            text-transform: uppercase;
            letter-spacing: 1px; /* Reduced letter spacing */
            font-size: 0.85rem; /* Smaller font */
            margin-bottom: 3px;
        }

        h6.m-b-20 {
            font-family: 'Orbitron', sans-serif;
            font-size: 1.1rem; /* Smaller heading */
            color: var(--neon-pink);
            text-transform: uppercase;
            letter-spacing: 1px; /* Reduced spacing */
            text-shadow: 0 0 5px rgba(255, 44, 223, 0.5);
            padding-bottom: 10px;
            position: relative;
            margin-bottom: 15px;
        }

        .b-b-default {
            border-bottom: 1px solid var(--border-color) !important;
        }

        p.m-b-10 {
            color: var(--neon-blue);
            font-family: 'Rajdhani', sans-serif;
            font-weight: 600;
            letter-spacing: 1px;
            text-transform: uppercase;
            margin-bottom: 4px;
            font-size: 0.85rem;
        }

        h6.text-muted {
            color: var(--text-color) !important;
            font-family: 'Rajdhani', sans-serif;
            font-size: 0.9rem; /* Smaller font */
            letter-spacing: 0.5px; /* Reduced spacing */
            overflow-wrap: break-word; /* For email addresses */
            word-break: break-word;
        }

        .social-link {
            border-top: 1px solid var(--border-color);
            padding-top: 15px;
            margin-top: 20px;
        }

        .social-link h6 {
            font-family: 'Orbitron', sans-serif;
            font-size: 0.8rem; /* Smaller quote */
            color: rgba(255, 255, 255, 0.6);
            letter-spacing: 0.5px;
            text-align: center;
            font-style: italic;
        }

        .user-status {
            position: relative;
            display: inline-block;
            padding: 3px 10px; /* Smaller padding */
            background-color: rgba(0, 0, 0, 0.4);
            border: 1px solid var(--neon-blue);
            border-radius: 20px;
            color: var(--neon-blue);
            font-size: 0.7rem; /* Smaller text */
            text-transform: uppercase;
            letter-spacing: 1px; /* Reduced spacing */
            margin-top: 8px;
        }
        
        .user-status::before {
            content: "●";
            color: var(--neon-blue);
            margin-right: 5px;
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
            height: 1px;
            background: linear-gradient(to right, transparent, var(--border-color), transparent);
            margin: 12px 0;
        }
        
        .row {
            margin-left: 0;
            margin-right: 0;
        }
        
        .m-b-25 {
            margin-bottom: 15px;
        }
        
        /* Fix for mobile devices */
        @media only screen and (max-width: 767px) {
            .user-card-full {
                transform: none;
                margin-top: 30px;
                margin-bottom: 30px;
            }
            
            .main-wrapper {
                padding: 20px 0;
                min-height: auto;
            }
            
            .user-profile {
                border-radius: 20px 20px 0 0;
                padding: 20px 0;
            }
            
            .card-block {
                padding: 1.25rem;
            }
            
            h3.f-w-600 {
                font-size: 1.2rem;
            }
            
            h6.m-b-20 {
                font-size: 1rem;
            }
            
            .img-radius {
                width: 80px;
                height: 80px;
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
            <div class="col-xl-6 col-lg-8 col-md-12">
                <div class="user-card-full">
                    <div class="row m-0">
                        <div class="col-sm-4 bg-c-lite-green user-profile">
                            <div class="card-block text-center text-white">
                                <div class="m-b-25">
                                    <img src="https://img.icons8.com/bubbles/100/000000/user.png" class="img-radius" alt="User-Profile-Image">
                                </div>
                                <h3 class="f-w-600"><?php echo $data['name']; ?></h3>
                                <div class="user-status">ACTIVE</div>
                            </div>
                        </div>
                        <div class="col-sm-8">
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