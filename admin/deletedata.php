<?php
session_start();
if(isset($_SESSION['uid'])){
    echo "";
} else {
    header('location: ../login.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Data | Typhoon Logistics</title>
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
            margin: 0;
            padding: 0;
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
            position: fixed;
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

        .container {
            max-width: 1400px; /* Increased from 1200px */
            margin: 50px auto;
            padding: 30px;
            background: rgba(0, 0, 0, 0.8);
            border-radius: 12px;
            border: 1px solid rgba(255, 44, 223, 0.3);
            box-shadow: 0 0 20px rgba(255, 44, 223, 0.2), 0 0 60px rgba(255, 44, 223, 0.05);
            backdrop-filter: blur(5px);
            position: relative;
            z-index: 5;
        }

        .container::after {
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
            z-index: -1;
        }

        @keyframes scanline {
            0% { top: -200%; }
            100% { top: 200%; }
        }

        h1 {
            text-align: center;
            color: white;
            margin-bottom: 30px;
            font-family: 'Orbitron', sans-serif;
            font-weight: 700;
            font-size: 2.5rem; /* Increased from default */
            letter-spacing: 2px;
            text-transform: uppercase;
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

        .btn {
            font-family: 'Orbitron', sans-serif;
            text-transform: uppercase;
            letter-spacing: 1px;
            border-radius: 6px;
            position: relative;
            overflow: hidden;
            z-index: 1;
            transition: all 0.3s;
            font-size: 1rem; /* Increased from default */
        }

        .btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: all 0.3s;
            z-index: -1;
        }

        .btn:hover::before {
            left: 100%;
        }

        .btn-primary {
            background-color: transparent !important;
            border: 1px solid var(--neon-blue) !important;
            color: white !important;
            padding: 10px 20px; /* Increased padding */
        }

        .btn-primary:hover {
            box-shadow: 0 0 15px rgba(0, 249, 255, 0.5) !important;
            text-shadow: 0 0 5px var(--neon-blue) !important;
        }

        .btn-danger {
            background-color: transparent !important;
            border: 1px solid var(--neon-pink) !important;
            color: white !important;
            padding: 10px 20px; /* Increased padding */
        }

        .btn-danger:hover {
            box-shadow: 0 0 15px rgba(255, 44, 223, 0.5) !important;
            text-shadow: 0 0 5px var(--neon-pink) !important;
        }

        .table-responsive {
            overflow-x: auto;
            width: 100%;
        }

        .table {
            color: white !important;
            background: transparent !important;
            border: none !important;
            margin-top: 20px;
            width: 100%;
            font-size: 1.15rem; /* Increased font size */
        }

        .table th {
            background-color: rgba(0, 0, 0, 0.6) !important;
            border: 1px solid var(--neon-blue) !important;
            color: white;
            font-family: 'Orbitron', sans-serif;
            font-weight: 400;
            font-size: 1.2rem; /* Increased font size */
            letter-spacing: 1px;
            text-transform: uppercase;
            text-shadow: 0 0 5px var(--neon-blue);
            padding: 15px 20px; /* Increased padding */
        }

        .table td {
            border: 1px solid rgba(255, 44, 223, 0.2) !important;
            background-color: rgba(0, 0, 0, 0.4) !important;
            font-family: 'Rajdhani', sans-serif;
            font-size: 1.15rem; /* Increased font size */
            padding: 15px 20px; /* Increased padding */
            vertical-align: middle;
        }

        .table tr:hover td {
            background-color: rgba(0, 0, 0, 0.6) !important;
            border: 1px solid rgba(255, 44, 223, 0.4) !important;
        }

        img.img-fluid {
            border: 1px solid var(--neon-blue);
            border-radius: 4px;
            box-shadow: 0 0 10px rgba(0, 249, 255, 0.3);
            transition: all 0.3s;
            max-width: 120px; /* Increased from 100px */
            height: auto;
        }

        img.img-fluid:hover {
            transform: scale(1.05);
            box-shadow: 0 0 20px rgba(0, 249, 255, 0.5);
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

        .btn-sm {
            padding: 8px 15px; /* Increased from 5px 10px */
            font-size: 0.9rem; /* Increased from 0.8rem */
        }
    </style>
</head>
<body>
    <div class="grid-overlay"></div>
    <div class="circuit-pattern"></div>
    <div class="hexagon-pattern"></div>
    <div class="scan-line"></div>
    
    <div class="container animate__animated animate__fadeIn">
        <div class="d-flex justify-content-between mb-4 animate__animated animate__fadeInDown">
            <a href="dashboard.php" class="btn btn-primary">
                <i class="fas fa-arrow-left"></i> Back to Dashboard
            </a>
            <a href="logout.php" class="btn btn-danger">
                <i class="fas fa-sign-out-alt"></i> Log Out
            </a>
        </div>
        
        <h1 class="mb-4 animate__animated animate__fadeInDown">DATA MANAGEMENT</h1>
        
        <div class="digital-dots"></div>
        
        <div class="table-responsive animate__animated animate__fadeIn animate__delay-1s">
            <table class="table">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Items Image</th>
                        <th>Sender Name</th>
                        <th>Receiver Name</th>
                        <th>Sender Email</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    include('../dbconnection.php');

                    $qryd= "SELECT * FROM `courier`";
                    $run= mysqli_query($dbcon,$qryd);

                    if(mysqli_num_rows($run)<1){
                        echo "<tr><td colspan='6' class='text-center'>No record found.</td></tr>";
                    } else {
                        $count=0;
                        while($data=mysqli_fetch_assoc($run)) {
                            $count++;
                    ?>
                    <tr class="animate__animated animate__fadeIn" style="animation-delay: calc(<?php echo $count; ?> * 0.1s)">
                        <td><?php echo $count; ?></td>
                        <td><img src="../dbimages/<?php echo $data['image']; ?>" alt="pic" class="img-fluid"/> </td>
                        <td><?php echo $data['sname']; ?></td>
                        <td><?php echo $data['rname']; ?></td>
                        <td><?php echo $data['semail']; ?></td>
                        <td>
                            <a href="datadeleted.php?bb=<?php echo $data['billno']; ?>" class="btn btn-danger btn-sm">
                                <i class="fas fa-trash-alt"></i> Delete
                            </a>
                        </td>
                    </tr>
                    <?php
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
    
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>