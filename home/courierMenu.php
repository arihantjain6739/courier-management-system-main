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
    <title>Place Order</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-image: url('../images/1920_1080.jpg');
            background-repeat: no-repeat;
            background-size: cover;
        }
        .container {
            background-color: rgba(255, 255, 255, 0.8);
            padding: 20px;
            border-radius: 10px;
            margin-top: 50px;
            max-height: 80vh; /* Adjust the height as needed */
            overflow-y: auto;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2 class="text-center">Fill The Details Of Sender & Receiver</h2>
        <form action="courierMenu.php" method="POST" enctype="multipart/form-data">
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="sname">Sender Name</label>
                    <input type="text" class="form-control" id="sname" name="sname" placeholder="Sender FullName" required>
                </div>
                <div class="form-group col-md-6">
                    <label for="rname">Receiver Name</label>
                    <input type="text" class="form-control" id="rname" name="rname" placeholder="Receiver FullName" required>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="semail">Sender Email</label>
                    <input type="email" class="form-control" id="semail" name="semail" value="<?php echo $email; ?>" readonly>
                </div>
                <div class="form-group col-md-6">
                    <label for="remail">Receiver Email</label>
                    <input type="email" class="form-control" id="remail" name="remail" placeholder="Receiver EmailId" required>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="sphone">Sender Phone No.</label>
                    <input type="number" class="form-control" id="sphone" name="sphone" placeholder="Sender Number" required>
                </div>
                <div class="form-group col-md-6">
                    <label for="rphone">Receiver Phone No.</label>
                    <input type="number" class="form-control" id="rphone" name="rphone" placeholder="Receiver Number" required>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="saddress">Sender Address</label>
                    <input type="text" class="form-control" id="saddress" name="saddress" placeholder="Sender Address" required>
                </div>
                <div class="form-group col-md-6">
                    <label for="raddress">Receiver Address</label>
                    <input type="text" class="form-control" id="raddress" name="raddress" placeholder="Receiver Address" required>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="wgt">Weight (kg)</label>
                    <input type="number" class="form-control" id="wgt" name="wgt" placeholder="Weight in kg" required>
                </div>
                <div class="form-group col-md-6">
                    <label for="billno">Payment Id</label>
                    <input type="number" class="form-control" id="billno" name="billno" placeholder="Enter Transaction Number" required>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="date">Date</label>
                    <input type="date" class="form-control" id="date" name="date" value="<?php echo date('Y-m-d'); ?>" readonly>
                </div>
                <div class="form-group col-md-6">
                    <label for="simg">Items Image</label>
                    <input type="file" class="form-control-file" id="simg" name="simg">
                </div>
            </div>
            <button type="submit" name="submit" class="btn btn-primary btn-block">Place Order</button>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
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
                alert('Order Placed Successfully :)');
                window.open('courierMenu.php', '_self');
              </script>";
    }
}
?>
