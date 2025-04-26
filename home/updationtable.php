<!-- when we click update any items, it gives table with prev info -->
<?php
session_start();
if(isset($_SESSION['uid'])){
    echo "";
    }else{
    header('location: ../index.php');
    }

?>

<?php
    include('../dbconnection.php');
    include('header.php');

    $idd= $_GET['sid'];
    $uqry= "SELECT * FROM `courier` WHERE `c_id`='$idd'";
    $run= mysqli_query($dbcon,$uqry);
    $data = mysqli_fetch_assoc($run);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Package | Typhoon Logistics</title>
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
        
        .main-container {
            max-width: 900px;
            margin: 50px auto;
            padding: 20px;
            background: rgba(10, 10, 10, 0.7);
            border-radius: 20px;
            box-shadow: var(--shadow);
            border: 1px solid var(--border-color);
            position: relative;
            backdrop-filter: blur(5px);
            transform: perspective(1000px) rotateX(2deg);
        }
        
        .main-container::before {
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
        
        table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
            margin: 0 auto;
        }
        
        th, td {
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid var(--border-color);
            color: var(--text-color);
        }
        
        th {
            font-family: 'Orbitron', sans-serif;
            text-transform: uppercase;
            letter-spacing: 2px;
            font-size: 0.9rem;
            color: var(--neon-pink);
            text-shadow: 0 0 5px rgba(255, 44, 223, 0.5);
            padding: 15px;
        }
        
        thead th {
            background-color: rgba(10, 10, 10, 0.8);
            border-bottom: 2px solid var(--neon-pink);
            text-align: center;
            font-size: 1.2rem;
            padding: 20px;
            letter-spacing: 3px;
        }
        
        .divider-row td {
            border-bottom: 1px solid var(--neon-blue);
            padding: 3px;
            text-align: center;
            color: var(--neon-blue);
            letter-spacing: 2px;
        }
        
        input[type="text"],
        input[type="number"],
        input[type="email"],
        input[type="date"],
        input[type="textfield"] {
            background-color: #000000;
            border: 1px solid var(--border-color);
            border-radius: 8px;
            color: var(--text-color);
            padding: 10px 15px;
            width: 100%;
            font-family: 'Rajdhani', sans-serif;
            letter-spacing: 1px;
            transition: all 0.3s ease;
        }
        
        input[type="text"]:focus,
        input[type="number"]:focus,
        input[type="email"]:focus,
        input[type="date"]:focus,
        input[type="textfield"]:focus {
            border-color: var(--neon-pink);
            box-shadow: 0 0 10px rgba(255, 44, 223, 0.3);
            outline: none;
        }
        
        input[type="file"] {
            background-color: transparent;
            border: 1px dashed var(--border-color);
            border-radius: 8px;
            color: var(--text-color);
            padding: 8px;
            width: 100%;
            cursor: pointer;
        }
        
        input[type="file"]::-webkit-file-upload-button {
            background-color: transparent;
            color: var(--neon-blue);
            border: 1px solid var(--neon-blue);
            border-radius: 5px;
            padding: 5px 10px;
            margin-right: 10px;
            cursor: pointer;
            font-family: 'Rajdhani', sans-serif;
            transition: all 0.3s ease;
        }
        
        input[type="file"]::-webkit-file-upload-button:hover {
            background-color: var(--neon-blue);
            color: #000000;
        }
        
        input[readonly] {
            background-color: rgba(0, 0, 0, 0.3);
            border: 1px solid rgba(255, 44, 223, 0.1);
        }
        
        input[type="submit"] {
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
            cursor: pointer;
            width: 180px;
            margin: 20px auto;
            display: block;
            position: relative;
            overflow: hidden;
        }
        
        input[type="submit"]:hover {
            background-color: var(--neon-pink);
            color: #000000;
            box-shadow: 0 0 15px rgba(255, 44, 223, 0.7);
            transform: translateY(-2px);
        }
        
        input[type="submit"]::before {
            content: "";
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(to right, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.7s;
        }
        
        input[type="submit"]:hover::before {
            left: 100%;
        }
        
        .section-label {
            font-family: 'Orbitron', sans-serif;
            font-size: 1rem;
            color: var(--neon-blue);
            text-transform: uppercase;
            letter-spacing: 2px;
            text-shadow: 0 0 5px rgba(0, 249, 255, 0.5);
            background-color: rgba(0, 249, 255, 0.05);
            border-radius: 5px;
            padding: 5px 0;
        }
        
        @media (max-width: 767px) {
            .main-container {
                transform: none;
                margin: 20px;
            }
            
            th, td {
                padding: 8px;
            }
            
            thead th {
                font-size: 1rem;
                padding: 15px 10px;
            }
            
            input[type="text"],
            input[type="number"],
            input[type="email"],
            input[type="date"],
            input[type="textfield"] {
                padding: 8px;
            }
        }
    </style>
</head>
<body>
<div class="grid-overlay"></div>

<div class="main-container">
    <form action="editdata.php" method="POST" enctype="multipart/form-data">
        <div style="overflow-x:auto;">
            <table>
                <thead>
                    <tr>
                        <th colspan="4">UPDATE PACKAGE TRANSMISSION DATA</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th colspan="2" class="section-label">ORIGIN POINT</th>
                        <th colspan="2" class="section-label">DESTINATION POINT</th>
                    </tr>
                    <tr>
                        <td>IDENTIFIER:</td>
                        <td><input type="text" name="sname" value="<?php echo $data['sname'];?>" required></td>
                        <td>IDENTIFIER:</td>
                        <td><input type="text" name="rname" value="<?php echo $data['rname'];?>" required></td>
                    </tr>
                    <tr>
                        <td>DIGITAL CODE:</td>
                        <td><input type="text" name="semail" value="<?php echo $data['semail'];?>" readonly></td>
                        <td>DIGITAL CODE:</td>
                        <td><input type="text" name="remail" value="<?php echo $data['remail'];?>" required></td>
                    </tr>
                    <tr>
                        <td>COMM FREQUENCY:</td>
                        <td><input type="number" name="sphone" value="<?php echo $data['sphone'];?>" required></td>
                        <td>COMM FREQUENCY:</td>
                        <td><input type="number" name="rphone" value="<?php echo $data['rphone'];?>" required></td>
                    </tr>
                    <tr>
                        <td>COORDINATES:</td>
                        <td><input type="textfield" name="saddress" value="<?php echo $data['saddress'];?>" required></td>
                        <td>COORDINATES:</td>
                        <td><input type="textfield" name="raddress" value="<?php echo $data['raddress'];?>" required></td>
                    </tr>
                    <tr class="divider-row">
                        <td colspan="4">PACKAGE SPECIFICATIONS</td>
                    </tr>
                    <tr>
                        <td>MASS UNITS:</td>
                        <td><input type="number" name="wgt" value="<?php echo $data['weight'];?>" required></td>
                        <td>TRANSACTION ID:</td>
                        <td><input type="number" name="billno" value="<?php echo $data['billno'];?>" required></td>
                    </tr>
                    <tr>
                        <td>TIMESTAMP:</td>
                        <td><input type="date" name="date" value="<?php echo date('Y-m-d'); ?>" readonly /></td>
                        <td>VISUAL DATA:</td>
                        <td><input type="file" name="simg" value="<?php echo $data['image'];?>"></td>
                    </tr>
                    <tr>
                        <input type="hidden" name="idd" value="<?php echo $data['c_id']; ?>" />
                        <td colspan="4" align="center"><input type="submit" name="submit" value="UPDATE"></td>
                    </tr>
                </tbody>
            </table>
        </div>   
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>