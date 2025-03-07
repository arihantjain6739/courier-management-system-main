<!-- admin dashboard page with options for admin -->

<?php
session_start();
if(isset($_SESSION['uid'])){
    echo "";
}else{
    header('location: ../login.php');
    exit();
}
?>

<?php
include('head.php');
?>

<style>
    body {
        background-color: #f4f4f9;
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
    }
    .navbar {
        display: flex;
        justify-content: space-between;
        align-items: center;
        background-color: #333;
        padding: 10px 20px;
    }
    .navbar a {
        color: #fff;
        text-decoration: none;
        padding: 8px 16px;
    }
    .navbar a:hover {
        background-color: #575757;
    }
    .container {
        max-width: 1200px;
        margin: 50px auto;
        padding: 20px;
        background-color: #fff;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        border-radius: 8px;
    }
    .container h1 {
        text-align: center;
        color: #333;
        margin-bottom: 40px;
    }
    .options {
        display: flex;
        justify-content: space-around;
        flex-wrap: wrap;
    }
    .options a {
        display: block;
        width: 200px;
        margin: 10px;
        padding: 20px;
        text-align: center;
        background-color: #007bff;
        color: #fff;
        text-decoration: none;
        border-radius: 8px;
        transition: background-color 0.3s;
    }
    .options a:hover {
        background-color: #0056b3;
    }
</style>

<div class="navbar">
    <a href="../index.php">Login As User</a>
    <a href="logout.php">Log Out</a>
</div>

<div class="container">
    <h1>Welcome To Admin Dashboard</h1>
    <div class="options">
        <!-- <a href="insertdata.php">Insert Data</a> -->
        <!-- <a href="updatedata.php">Update Data</a> -->
        <a href="deletedata.php">Delete Data</a>
        <a href="deleteusers.php">Delete Users</a>
    </div>
</div>
</body>
</html>