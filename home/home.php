<?php

session_start();
if(isset($_SESSION['uid'])){
    echo "";
    }else{
    header('location: ../index.php');
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-image: url('../images/1920_1080.jpg');
            background-repeat: no-repeat;
            background-size: cover;
            color: white;
        }
        .content {
            margin-top: 20%;
            text-align: center;
        }
    </style>
</head>
<body>
    <?php include('header.php'); ?>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 content">
                <h2 style="color: white;">Typhoon Logistics Management Service</h2>
                <h4 style="color: white;">The fastest Logistics service of India</h4>
                <br>
                <h3 style="color: white;">DBMS MINI PROJECT</h3>
                <!-- <h6>By Group 24</h6> -->
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>