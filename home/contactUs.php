<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact | Typhoon Logistics</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
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
        
        .mail-form {
            background: rgba(10, 10, 10, 0.7);
            padding: 40px 30px;
            border-radius: 20px;
            box-shadow: var(--shadow);
            border: 1px solid var(--border-color);
            position: relative;
            backdrop-filter: blur(5px);
            transform: perspective(1000px) rotateX(2deg);
            margin: 80px auto;
            max-width: 500px;
        }
        
        .mail-form::before {
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
        
        h2 {
            text-align: center;
            color: var(--text-color);
            font-family: 'Orbitron', sans-serif;
            font-size: 1.8rem;
            letter-spacing: 2px;
            margin-bottom: 10px;
            text-shadow: 0 0 10px var(--neon-pink), 0 0 20px rgba(255, 44, 223, 0.5);
            text-transform: uppercase;
        }
        
        p {
            text-align: center;
            color: var(--text-color);
            font-family: 'Rajdhani', sans-serif;
            letter-spacing: 1px;
            margin-bottom: 30px;
            opacity: 0.8;
        }
        
        .form-group {
            margin-bottom: 20px;
            position: relative;
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
            border-radius: 20px;
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
            color: #000000;
            font-family: 'Rajdhani', sans-serif;
            font-weight: 600;
        }
        
        textarea.form-control {
            min-height: 120px;
            resize: none;
            background-color: #000000;
        }
        
        .btn-primary {
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
        
        .btn-primary:hover {
            background-color: var(--neon-pink);
            color: white;
            box-shadow: 0 0 15px rgba(255, 44, 223, 0.7);
            transform: translateY(-2px);
            border-color: var(--neon-pink);
        }
        
        .btn-primary::before {
            content: "";
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(to right, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.7s;
        }
        
        .btn-primary:hover::before {
            left: 100%;
        }
        
        /* Animation for the form */
        @keyframes fadeIn {
            from { opacity: 0; transform: perspective(1000px) rotateX(10deg) translateY(-20px); }
            to { opacity: 1; transform: perspective(1000px) rotateX(2deg) translateY(0); }
        }
        
        .mail-form {
            animation: fadeIn 0.8s ease forwards;
        }
        
        /* Ensure white text on black background */
        input:-webkit-autofill,
        input:-webkit-autofill:hover, 
        input:-webkit-autofill:focus, 
        input:-webkit-autofill:active {
            -webkit-box-shadow: 0 0 0 30px #000000 inset !important;
            -webkit-text-fill-color: white !important;
        }
        
        /* Responsive adjustments */
        @media (max-width: 767px) {
            .mail-form {
                margin: 40px 15px;
                padding: 30px 20px;
                transform: none;
            }
            
            h2 {
                font-size: 1.5rem;
            }
        }
    </style>
</head>

<body>
<?php
include('header.php');
?>
    <div class="grid-overlay"></div>
    
    <div class="container">
        <div class="row">
            <div class="col-md-6 offset-md-3 mail-form">
                <h2>TRANSMISSION PROTOCOL</h2>
                <p>Establish direct communication with command center</p>
                
                <form action="contactUs.php" method="POST">
                    <div class="form-group">
                        <input class="form-control" name="email" type="email" placeholder="YOUR DIGITAL IDENTIFIER (EMAIL)" required>
                    </div>
                    <div class="form-group">
                        <input class="form-control" name="subject" type="text" placeholder="TRANSMISSION SUBJECT" required>
                    </div>
                    <div class="form-group">
                        <textarea class="form-control" name="message" placeholder="COMPOSE YOUR MESSAGE..." rows="5" required></textarea>
                    </div>
                    <div class="form-group">
                        <input class="form-control btn-primary" type="submit" name="send" value="TRANSMIT MESSAGE">
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

<?php
if (isset($_POST['send'])) {
    include('../dbconnection.php');
    //access user entered data
    $eml = $_POST['email'];
    $sub = $_POST['subject'];
    $msg = $_POST['message'];

    $qry = "INSERT INTO `contacts` (`email`, `subject`, `msg`) VALUES ('$eml', '$sub', '$msg')";
    $run = mysqli_query($dbcon, $qry);

    if ($run == true) {
    ?> 
    <script>
        alert('Transmission received. Your message has been logged in the system.');
        window.open('home.php', '_self');
    </script>
    <?php
    }
}
?>