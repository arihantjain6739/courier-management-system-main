<!-- for 'courier' navbar, courier placing page -->
<?php
session_start();
if (!isset($_SESSION['uid'])) {
    header('location: ../index.php');
    exit();
}

include('header.php');
$email = $_SESSION['emm'];
$uid = $_SESSION['uid'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Place Order | Typhoon Logistics</title>
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
        
        .form-row {
            margin-bottom: 15px;
        }
        
        .form-group {
            margin-bottom: 15px;
        }
        
        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
            color: var(--neon-pink);
            font-family: 'Rajdhani', sans-serif;
            letter-spacing: 1px;
            font-size: 1rem;
            text-transform: uppercase;
        }
        
        .form-control {
            width: 100%;
            padding: 12px 15px;
            border: 1px solid var(--border-color);
            border-radius: 20px;
            font-size: 16px;
            transition: all 0.3s;
            background-color: rgba(10, 10, 10, 0.6);
            color: var(--text-color);
            font-family: 'Rajdhani', sans-serif;
            letter-spacing: 1px;
        }
        
        .form-control:focus {
            outline: none;
            border-color: var(--neon-pink);
            box-shadow: 0 0 10px rgba(255, 44, 223, 0.5);
        }
        
        .form-control::placeholder {
            color: rgba(255, 255, 255, 0.5);
        }
        
        .form-control:read-only {
            background-color: rgba(255, 44, 223, 0.1);
            border-color: var(--neon-pink);
        }
        
        .form-control-file {
            width: 100%;
            padding: 10px;
            background-color: rgba(10, 10, 10, 0.6);
            border: 1px solid var(--border-color);
            border-radius: 20px;
            color: var(--text-color);
            font-family: 'Rajdhani', sans-serif;
        }
        
        .btn {
            display: block;
            width: 100%;
            padding: 15px;
            border: none;
            border-radius: 25px;
            cursor: pointer;
            font-size: 18px;
            font-weight: 600;
            text-align: center;
            transition: all 0.3s;
            font-family: 'Orbitron', sans-serif;
            letter-spacing: 2px;
            position: relative;
            overflow: hidden;
            margin-top: 30px;
            text-transform: uppercase;
        }
        
        .btn-primary {
            background-color: transparent;
            color: var(--neon-pink);
            border: 1px solid var(--neon-pink);
        }
        
        .btn-primary:hover {
            background-color: var(--neon-pink);
            color: white;
            box-shadow: 0 0 15px rgba(255, 44, 223, 0.7);
            transform: translateY(-2px);
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
        
        /* Custom file input styling */
        input[type="file"] {
            position: relative;
            z-index: 2;
            width: 100%;
            height: 46px;
            opacity: 0;
        }
        
        .file-upload {
            position: relative;
        }
        
        .file-upload::after {
            content: "Choose File";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 44px;
            padding: 12px 15px;
            background-color: rgba(10, 10, 10, 0.6);
            border: 1px solid var(--border-color);
            border-radius: 20px;
            color: rgba(255, 255, 255, 0.7);
            font-family: 'Rajdhani', sans-serif;
            pointer-events: none;
            z-index: 1;
            text-align: left;
        }
        
        /* Responsive adjustments */
        @media (max-width: 767px) {
            .container {
                width: 95%;
                padding: 20px;
                transform: none;
                margin-top: 30px;
                margin-bottom: 30px;
            }
            
            h2 {
                font-size: 1.5rem;
            }
        }
    </style>
</head>

<body>
    <div class="grid-overlay"></div>
    
    <div class="container">
        <h2>DATA TRANSMISSION FORM</h2>
        <form action="courierMenu.php" method="POST" enctype="multipart/form-data">
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="sname">Origin Identifier</label>
                    <input type="text" class="form-control" id="sname" name="sname" placeholder="Sender's Full Name" required>
                </div>
                <div class="form-group col-md-6">
                    <label for="rname">Destination Identifier</label>
                    <input type="text" class="form-control" id="rname" name="rname" placeholder="Receiver's Full Name" required>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="semail">Origin Communication Protocol</label>
                    <input type="email" class="form-control" id="semail" name="semail" value="<?php echo $email; ?>" readonly>
                </div>
                <div class="form-group col-md-6">
                    <label for="remail">Destination Communication Protocol</label>
                    <input type="email" class="form-control" id="remail" name="remail" placeholder="Receiver's Email ID" required>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="sphone">Origin Contact Frequency</label>
                    <input type="number" class="form-control" id="sphone" name="sphone" placeholder="Sender's Contact Number" required>
                </div>
                <div class="form-group col-md-6">
                    <label for="rphone">Destination Contact Frequency</label>
                    <input type="number" class="form-control" id="rphone" name="rphone" placeholder="Receiver's Contact Number" required>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="saddress">Origin Coordinates</label>
                    <input type="text" class="form-control" id="saddress" name="saddress" placeholder="Sender's Physical Address" required>
                </div>
                <div class="form-group col-md-6">
                    <label for="raddress">Destination Coordinates</label>
                    <input type="text" class="form-control" id="raddress" name="raddress" placeholder="Receiver's Physical Address" required>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="wgt">Mass Quantification (kg)</label>
                    <input type="number" class="form-control" id="wgt" name="wgt" placeholder="Weight in kg" required>
                </div>
                <div class="form-group col-md-6">
                    <label for="billno">Transaction Verification Code</label>
                    <input type="number" class="form-control" id="billno" name="billno" placeholder="Enter Transaction Number" required>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="date">Temporal Marker</label>
                    <input type="date" class="form-control" id="date" name="date" value="<?php echo date('Y-m-d'); ?>" readonly>
                </div>
                <div class="form-group col-md-6">
                    <label for="simg">Visual Data Archive</label>
                    <div class="file-upload">
                        <input type="file" class="form-control-file" id="simg" name="simg">
                    </div>
                </div>
            </div>
            <button type="submit" name="submit" class="btn btn-primary">Initialize Transfer</button>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        // Update file input display
        $(document).ready(function() {
            $('input[type="file"]').change(function(e) {
                var fileName = e.target.files[0].name;
                $(this).parent('.file-upload').find('::after').text(fileName);
                
                // Add a data attribute to store the filename
                $(this).parent('.file-upload').attr('data-filename', fileName);
                
                // Use CSS to display the filename
                if (fileName) {
                    $(this).parent('.file-upload').addClass('has-file');
                } else {
                    $(this).parent('.file-upload').removeClass('has-file');
                }
            });
        });
    </script>
</body>

</html>

<?php
if (isset($_POST['submit'])) {
    include('../dbconnection.php');

    $sname = $_POST['sname'];
    $rname = $_POST['rname'];
    $semail = $_POST['semail'];
    $remail = $_POST['remail'];
    $sphone = $_POST['sphone'];
    $rphone = $_POST['rphone'];
    $sadd = $_POST['saddress'];
    $radd = $_POST['raddress'];
    $wgt = $_POST['wgt'];
    $billn = $_POST['billno'];
    $originalDate = $_POST['date'];
    $newDate = date("Y-m-d", strtotime($originalDate));
    $imagenam = $_FILES['simg']['name'];
    $tempnam = $_FILES['simg']['tmp_name'];

    move_uploaded_file($tempnam, "../dbimages/$imagenam");

    $qry = "INSERT INTO `courier` (`sname`, `rname`, `semail`, `remail`, `sphone`, `rphone`, `saddress`, `raddress`, `weight`, `billno`, `image`,`date`,`u_id`) VALUES ('$sname', '$rname', '$semail', '$remail', '$sphone', '$rphone', '$sadd', '$radd', '$wgt', '$billn', '$imagenam', '$newDate','$uid');";
    $run = mysqli_query($dbcon, $qry);

    if ($run == true) {
        echo "<script>
                alert('Package transmission initiated successfully. Your order has been placed.');
                window.open('courierMenu.php', '_self');
              </script>";
    }
}
?>