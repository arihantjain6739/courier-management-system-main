<?php
session_start();
if(isset($_SESSION['uid'])){
    echo "";
} else {
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
    <title>Pricing</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;700&family=Rajdhani:wght@300;400;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --neon-pink: #ff2cdf;
            --neon-blue: #00f9ff;
            --neon-green: #0aff0a;
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
        }
        
        .container {
            width: 80%;
            margin: 80px auto;
            margin-bottom: 80px;
            background: rgba(10, 10, 10, 0.7);
            padding: 20px;
            border-radius: 20px;
            box-shadow: var(--shadow);
            border: 1px solid var(--border-color);
            position: relative;
            z-index: 1;
            backdrop-filter: blur(5px);
            transform: perspective(1000px) rotateX(2deg);
        }
        
        .container::before {
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
        
        h1 {
            text-align: center;
            color: var(--text-color);
            font-family: 'Orbitron', sans-serif;
            font-size: 2rem;
            letter-spacing: 3px;
            margin-bottom: 30px;
            text-shadow: 0 0 10px var(--neon-pink), 0 0 20px rgba(255, 44, 223, 0.5);
        }
        
        table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
            margin: 20px 0;
            border-radius: 10px;
            overflow: hidden;
        }
        
        table, th, td {
            border: none;
        }
        
        th, td {
            padding: 15px;
            text-align: center;
            position: relative;
        }
        
        th {
            background-color: var(--darker-bg);
            color: var(--neon-pink);
            font-family: 'Orbitron', sans-serif;
            font-weight: 600;
            letter-spacing: 2px;
            text-shadow: 0 0 5px rgba(255, 44, 223, 0.5);
            border-bottom: 1px solid var(--border-color);
        }
        
        tr:nth-child(even) {
            background-color: rgba(255, 44, 223, 0.05);
        }
        
        tr:nth-child(odd) {
            background-color: rgba(0, 0, 0, 0.3);
        }
        
        tr:hover {
            background-color: rgba(255, 44, 223, 0.1);
        }
        
        td {
            color: var(--text-color);
            font-family: 'Rajdhani', sans-serif;
            font-size: 1.1rem;
            letter-spacing: 1px;
            border-bottom: 1px solid rgba(255, 44, 223, 0.1);
            transition: all 0.3s ease;
        }
        
        tr:last-child td {
            border-bottom: none;
        }
        
        .payment-info {
            text-align: center;
            margin-top: 40px;
            padding: 20px;
            border-radius: 15px;
            background-color: rgba(0, 0, 0, 0.3);
            border: 1px solid var(--border-color);
        }
        
        .payment-info h3 {
            color: var(--text-color);
            font-family: 'Orbitron', sans-serif;
            font-size: 1.3rem;
            letter-spacing: 2px;
            margin-bottom: 20px;
            text-shadow: 0 0 5px rgba(255, 44, 223, 0.3);
        }
        
        .payment-info ol {
            list-style: none;
            padding: 0;
            display: flex;
            justify-content: space-around;
            flex-wrap: wrap;
        }
        
        .payment-info li {
            margin: 15px;
            font-size: 1.1rem;
            background-color: rgba(0, 0, 0, 0.5);
            padding: 15px 20px;
            border-radius: 50px;
            border: 1px solid var(--border-color);
            min-width: 250px;
            transition: all 0.3s ease;
            letter-spacing: 1px;
        }
        
        .payment-info li:hover {
            transform: translateY(-5px);
            box-shadow: 0 0 15px rgba(255, 44, 223, 0.5);
        }
        
        .payment-info li i {
            margin-right: 10px;
            color: var(--neon-pink);
            font-size: 1.2rem;
        }
        
        .qr-container {
            margin-top: 30px;
            text-align: center;
            background-color: rgba(0, 0, 0, 0.5);
            padding: 25px;
            border-radius: 15px;
            border: 1px solid var(--border-color);
            position: relative;
            overflow: hidden;
        }
        
        .qr-container h3 {
            color: var(--text-color);
            font-family: 'Orbitron', sans-serif;
            font-size: 1.3rem;
            letter-spacing: 2px;
            margin-bottom: 20px;
            text-shadow: 0 0 5px rgba(0, 249, 255, 0.5);
        }
        
        .qr-code {
            position: relative;
            width: 220px;
            height: 220px;
            margin: 0 auto;
            background-color: white;
            padding: 10px;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 249, 255, 0.5);
            transition: all 0.3s ease;
            animation: qrPulse 3s infinite alternate;
        }
        
        @keyframes qrPulse {
            0% {
                box-shadow: 0 0 15px rgba(0, 249, 255, 0.3);
                transform: scale(1);
            }
            100% {
                box-shadow: 0 0 25px rgba(0, 249, 255, 0.7);
                transform: scale(1.02);
            }
        }
        
        .qr-code img {
            width: 200px;
            height: 200px;
            border-radius: 5px;
        }
        
        .qr-code::before {
            content: "";
            position: absolute;
            top: -5px;
            left: -5px;
            right: -5px;
            bottom: -5px;
            background: linear-gradient(45deg, var(--neon-blue), var(--neon-pink), var(--neon-green), var(--neon-blue));
            z-index: -1;
            border-radius: 15px;
            background-size: 400%;
            animation: glowing 20s linear infinite;
        }
        
        @keyframes glowing {
            0% { background-position: 0 0; }
            50% { background-position: 400% 0; }
            100% { background-position: 0 0; }
        }
        
        .scan-line {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 5px;
            background-color: rgba(0, 249, 255, 0.8);
            box-shadow: 0 0 10px 5px rgba(0, 249, 255, 0.5);
            z-index: 100;
            animation: scanMove 2.5s linear infinite;
        }
        
        @keyframes scanMove {
            0% { top: 10%; opacity: 0.9; }
            50% { opacity: 0.5; }
            100% { top: 90%; opacity: 0.9; }
        }
        
        .qr-text {
            margin-top: 15px;
            font-family: 'Rajdhani', sans-serif;
            font-size: 1.1rem;
            color: var(--neon-blue);
            letter-spacing: 1px;
            text-shadow: 0 0 5px rgba(0, 249, 255, 0.5);
        }
        
        .qr-note {
            margin-top: 10px;
            font-size: 0.9rem;
            opacity: 0.7;
        }
        
        @media (max-width: 768px) {
            .container {
                width: 95%;
                transform: none;
            }
            
            .payment-info ol {
                flex-direction: column;
                align-items: center;
            }
            
            .payment-info li {
                width: 100%;
                max-width: 300px;
            }
            
            .qr-container {
                padding: 15px;
            }
            
            .qr-code {
                width: 180px;
                height: 180px;
            }
            
            .qr-code img {
                width: 160px;
                height: 160px;
            }
        }
    </style>
</head>
<body>
    <div class="grid-overlay"></div>
    
    <div class="container">
        <h1>PRICING MATRIX</h1>
        <table>
            <tr>
                <th>WEIGHT RANGE (KG)</th>
                <th>TRANSPORT COST (₹)</th>
            </tr>
            <tr>
                <td>0 - 1</td>
                <td>120</td>
            </tr>
            <tr>
                <td>1 - 2</td>
                <td>200</td>
            </tr>
            <tr>
                <td>2 - 4</td>
                <td>250</td>
            </tr>
            <tr>
                <td>4 - 5</td>
                <td>300</td>
            </tr>
            <tr>
                <td>5 - 7</td>
                <td>400</td>
            </tr>
            <tr>
                <td>7+</td>
                <td>500</td>
            </tr>
        </table>
        <div class="payment-info">
            <h3>TRANSACTION METHODS</h3>
            <ol>
                <li><i class="fas fa-university"></i> UPI: typhoonsystems@sbi.com</li>
                <li><i class="fab fa-google-pay"></i> GPay: +91 6362786223</li>
                <li><i class="fas fa-mobile-alt"></i> PhnPay: +91 6362786223</li>
            </ol>
        </div>
        
        <div class="qr-container">
    <h3><i class="fab fa-google-pay"></i> SCAN QR CODE TO PAY</h3>
    <div class="qr-code">
        <div class="scan-line"></div>
        <img src="https://res.cloudinary.com/dxpn0ctfa/image/upload/v1745774830/WhatsApp_Image_2025-04-27_at_10.56.32_PM_kqsifs.jpg" alt="GPay QR Code">
    </div>
    <div class="qr-text">Typhoon Logistics Payment</div>
    <div class="qr-note">Scan the QR code using Google Pay or any UPI app</div>
</div>
    </div>
</body>
</html>