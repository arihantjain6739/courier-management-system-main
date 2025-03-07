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
    <title>Status</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <?php if($stdate == $tddate): ?>
            <div class="alert alert-warning text-center" role="alert">
                <h1>Status: On The Way...</h1>
            </div>
        <?php else: ?>
            <div class="alert alert-success text-center" role="alert">
                <h1>Status: Items Delivered</h1>
                <p>HAVE A NICE DAY</p>
            </div>
        <?php endif; ?>
        <div class="text-center mt-4">
            <button onclick="window.location.href='trackMenu.php'" class="btn btn-primary btn-lg">Go Back</button>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
