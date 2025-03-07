<!-- admin logIn page and login logic -->
<?php

session_start();
if (isset($_SESSION['uid'])) {
    header('location: dashboard.php');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f0f2f5;
            margin: 0;
            font-family: Arial, sans-serif;
        }

        .login-container {
            background-color: #fff;
            padding: 2rem;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
            width: 300px;
        }

        .login-container h1 {
            margin-bottom: 1.5rem;
            color: #333;
        }

        .login-container form {
            display: flex;
            flex-direction: column;
        }

        .login-container input[type="email"],
        .login-container input[type="password"] {
            padding: 0.75rem;
            margin-bottom: 1rem;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .login-container input[type="submit"] {
            padding: 0.75rem;
            border: none;
            border-radius: 4px;
            background-color: #067d64;
            color: #fff;
            cursor: pointer;
            font-size: 1rem;
        }

        .login-container input[type="submit"]:hover {
            background-color: #055a4a;
        }

        .back-home {
            display: block;
            margin-top: 1rem;
            color: #067d64;
            text-decoration: none;
        }

        .back-home:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <div class="login-container">
        <h1>Admin Login</h1>
        <form action="adminlogin.php" method="POST">
            <input type="email" name="uname" placeholder="Email ID" required>
            <input type="password" name="pass" placeholder="Password" required>
            <input type="submit" name="login" value="Login">
        </form>
        <a href="../index.php" class="back-home">Back to Home</a>
    </div>
</body>

</html>

<?php

include('../dbconnection.php');
if (isset($_POST['login'])) {
    $ademail = $_POST['uname'];
    $password = $_POST['pass'];
    $qry = "SELECT * FROM `adlogin` WHERE `email`='$ademail' AND `password`='$password'";
    $run = mysqli_query($dbcon, $qry);
    $row = mysqli_num_rows($run);
    if ($row < 1) {
        ?>
        <script>
            alert("Only admin can login..");
            window.open('adminlogin.php', '_self');
        </script><?php
    }
    else {
        $data = mysqli_fetch_assoc($run);
        $id = $data['a_id'];
        $_SESSION['uid'] = $id;
        header('location:dashboard.php');
    }
}
?>