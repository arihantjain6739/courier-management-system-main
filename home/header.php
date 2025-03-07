<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title>Navbar with Logo Image</title>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

<style>
    .bs-example{
        margin: 0;
    }
    .navbar-brand img {
        height: 50px;
    }
    .navbar-nav .nav-link {
        font-size: 1.1em;
        padding: 10px 15px;
        font-family: Arial, sans-serif; /* Change this to your desired font */
    }
    .navbar-nav .nav-link.active {
        font-weight: bold;
        color: #007bff !important;
    }
    .navbar-nav .nav-link:hover {
        color: #0056b3 !important;
    }
</style>
</head>
<body>
<div class="bs-example">
    <nav class="navbar navbar-expand-md navbar-light bg-white">
        <a href="home.php" class="navbar-brand">
            <img src="../images/fcmw.png" alt="CoolBrand">
        </a>
        <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarCollapse">
            <div class="navbar-nav">
                <a href="home.php" class="nav-item nav-link active">Home</a>
                <a href="price.php" class="nav-item nav-link">Price</a>
                <a href="courierMenu.php" class="nav-item nav-link">Courier</a>
                <a href="trackMenu.php" class="nav-item nav-link">Track</a>
                <a href="profile.php" class="nav-item nav-link">Profile</a>
                <a href="contactUS.php" class="nav-item nav-link">Contact Us</a>
            </div>
            <div class="navbar-nav ml-auto">
                <a href="../admin/logout.php" class="nav-item nav-link">Admin Page</a>
                <a href="../logout.php" class="nav-item nav-link">Log Out</a>
            </div>
        </div>
    </nav>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
<?php include('footer.php'); ?>