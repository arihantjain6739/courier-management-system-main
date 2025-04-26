<!-- when track menu is clicked it will show all courier placed by that User-->
<?php
session_start();
if(isset($_SESSION['uid'])){
    echo "";
} else {
    header('location: ../login.php');
}
?>
<?php include('header.php'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Track Courier | Typhoon Logistics</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
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
        
        .container {
            width: 90%;
            max-width: 1200px;
            margin: 50px auto;
            background: rgba(10, 10, 10, 0.7);
            padding: 30px;
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
        
        h2 {
            text-align: center;
            color: var(--text-color);
            font-family: 'Orbitron', sans-serif;
            font-size: 1.8rem;
            letter-spacing: 2px;
            margin-bottom: 30px;
            text-shadow: 0 0 10px var(--neon-pink), 0 0 20px rgba(255, 44, 223, 0.5);
            text-transform: uppercase;
        }
        
        .table-responsive {
            border-radius: 10px;
            overflow: hidden;
        }
        
        .table {
            margin-bottom: 0;
            color: var(--text-color);
            font-family: 'Rajdhani', sans-serif;
            border: none;
            background-color: transparent;
        }
        
        .table th, .table td {
            vertical-align: middle;
            padding: 15px;
            border-color: rgba(255, 44, 223, 0.2);
            letter-spacing: 1px;
        }
        
        .table thead th {
            background-color: rgba(255, 44, 223, 0.1);
            color: var(--neon-pink);
            font-family: 'Orbitron', sans-serif;
            font-weight: 500;
            font-size: 0.9rem;
            text-transform: uppercase;
            border-bottom: 2px solid rgba(255, 44, 223, 0.3);
            letter-spacing: 2px;
            vertical-align: middle;
            text-shadow: 0 0 5px rgba(255, 44, 223, 0.3);
        }
        
        .table tbody tr {
            transition: all 0.3s ease;
            background-color: rgba(0, 0, 0, 0.3);
        }
        
        .table tbody tr:nth-child(odd) {
            background-color: rgba(0, 0, 0, 0.5);
        }
        
        .table tbody tr:hover {
            background-color: rgba(255, 44, 223, 0.1);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(255, 44, 223, 0.2);
        }
        
        .img-thumbnail {
            background-color: rgba(0, 0, 0, 0.5);
            border: 1px solid var(--border-color);
            border-radius: 10px;
            transition: all 0.3s ease;
            max-width: 80px;
            max-height: 80px;
            object-fit: cover;
        }
        
        .img-thumbnail:hover {
            transform: scale(1.5);
            box-shadow: 0 0 20px rgba(255, 44, 223, 0.5);
            z-index: 10;
            position: relative;
        }
        
        .btn {
            font-family: 'Rajdhani', sans-serif;
            font-weight: 600;
            border-radius: 20px;
            letter-spacing: 1px;
            margin: 2px;
            text-transform: uppercase;
            font-size: 0.75rem;
            transition: all 0.3s ease;
            padding: 6px 12px;
            position: relative;
            overflow: hidden;
        }
        
        .btn::before {
            content: "";
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(to right, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.7s;
        }
        
        .btn:hover::before {
            left: 100%;
        }
        
        .btn-primary {
            background-color: transparent;
            color: var(--neon-blue);
            border: 1px solid var(--neon-blue);
        }
        
        .btn-primary:hover {
            background-color: var(--neon-blue);
            color: white;
            box-shadow: 0 0 15px rgba(0, 249, 255, 0.7);
            transform: translateY(-2px);
            border-color: var(--neon-blue);
        }
        
        .btn-danger {
            background-color: transparent;
            color: #ff4a6e;
            border: 1px solid #ff4a6e;
        }
        
        .btn-danger:hover {
            background-color: #ff4a6e;
            color: white;
            box-shadow: 0 0 15px rgba(255, 74, 110, 0.7);
            transform: translateY(-2px);
            border-color: #ff4a6e;
        }
        
        .btn-info {
            background-color: transparent;
            color: var(--neon-pink);
            border: 1px solid var(--neon-pink);
        }
        
        .btn-info:hover {
            background-color: var(--neon-pink);
            color: white;
            box-shadow: 0 0 15px rgba(255, 44, 223, 0.7);
            transform: translateY(-2px);
            border-color: var(--neon-pink);
        }
        
        .no-records {
            background-color: rgba(0, 0, 0, 0.5);
            padding: 40px;
            text-align: center;
            font-family: 'Orbitron', sans-serif;
            letter-spacing: 2px;
            color: var(--neon-pink);
            text-shadow: 0 0 5px rgba(255, 44, 223, 0.5);
        }
        
        @media (max-width: 991px) {
            .container {
                width: 95%;
                transform: none;
                padding: 20px;
            }
            
            .table th, .table td {
                padding: 10px;
            }
            
            h2 {
                font-size: 1.5rem;
            }
        }
        
        @media (max-width: 767px) {
            .btn {
                padding: 4px 8px;
                font-size: 0.7rem;
            }
            
            .table {
                font-size: 0.9rem;
            }
            
            .img-thumbnail {
                max-width: 60px;
                max-height: 60px;
            }
        }
    </style>
</head>
<body>
    <div class="grid-overlay"></div>
    
    <div class="container">
        <h2>TRACKING INTERFACE</h2>
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>SEQUENCE</th>
                        <th>VISUAL DATA</th>
                        <th>ORIGIN</th>
                        <th>DESTINATION</th>
                        <th>RECEIVER ID</th>
                        <th>OPERATIONS</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    include('../dbconnection.php');

                    $email = $_SESSION['emm'];

                    $qryy = "SELECT * FROM `courier` WHERE `semail`='$email'";
                    $run = mysqli_query($dbcon, $qryy);

                    if(mysqli_num_rows($run) < 1){
                        echo "<tr><td colspan='6' class='no-records'>NO TRANSMISSION DATA FOUND IN SYSTEM</td></tr>";
                    } else {
                        $count = 0;
                        while($data = mysqli_fetch_assoc($run)) {
                            $count++;
                    ?>
                    <tr>
                        <td><?php echo $count; ?></td>
                        <td><img src="../dbimages/<?php echo $data['image']; ?>" alt="pic" class="img-thumbnail"/></td>
                        <td><?php echo $data['sname']; ?></td>
                        <td><?php echo $data['rname']; ?></td>
                        <td><?php echo $data['remail']; ?></td>
                        <td>
                            <a href="updationtable.php?sid=<?php echo $data['c_id']; ?>" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i> MODIFY</a>
                            <a href="deletecourier.php?bb=<?php echo $data['billno']; ?>" class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i> TERMINATE</a>
                            <a href="status.php?sidd=<?php echo $data['c_id']; ?>" class="btn btn-info btn-sm"><i class="fas fa-satellite-dish"></i> TRACE</a>
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

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>