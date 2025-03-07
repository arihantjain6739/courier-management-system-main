<?php

require_once "dbconnection.php";
require_once "session.php";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {

    $email = $_POST['email'];
    $password = $_POST['password'];

    $qry = "SELECT * FROM `login` WHERE `email`='$email' AND `password`='$password'";
    $run = mysqli_query($dbcon, $qry);
    $row = mysqli_num_rows($run);
    if ($row < 1) {
?>
        <script>
            alert("Opps! plz Enter Your Username and Pswd again..");
            window.open('index.php', '_self');
        </script> <?php
                } else {
                    $data = mysqli_fetch_assoc($run);
                    $id = $data['u_id'];    //fetch id value of user
                    $email = $data['email'];
                    $_SESSION['uid'] = $id;   //now we can use it until session destroy
                    $_SESSION['emm'] = $email;
                    ?>
        <script>
            alert("स्वागत हैं आपका 🙏");
            window.open('home/home.php', '_self');
        </script> <?php

                }
            }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
        }

        .login-container {
            margin-top: 100px;
            max-width: 400px;
            padding: 30px;
            background-color: #ffffff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }

        .login-header {
            margin-bottom: 30px;
        }

        .login-header h1 {
            font-size: 24px;
            font-weight: bold;
            color: #343a40;
        }

        .login-header p {
            color: #6c757d;
        }

        .form-group label {
            font-weight: bold;
            color: #343a40;
        }

        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }

        .btn-danger {
            background-color: #dc3545;
            border-color: #dc3545;
        }

        .register-link {
            color: #007bff;
        }

        .register-link:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="login-container mx-auto">
            <div class="login-header text-center">
                <h1>TYPHOON LOGISTICS SERVICE</h1>
                <p>The Fastest Logistics Service Ever</p>
            </div>
            <form action="" method="post">
                <div class="form-group">
                    <label>Email Address</label>
                    <input type="email" name="email" class="form-control" placeholder="Enter username/emailId" required />
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="password" class="form-control" placeholder="Enter your password" required>
                </div>
                <div class="form-group">
                    <input type="submit" name="submit" class="btn btn-primary btn-block" value="Sign In" />
                </div>
                <div class="form-group text-center">
                    <button onclick="window.location.href='resetpswd.php'" class="btn btn-danger btn-block" style="cursor:pointer">Reset Password</button>
                </div>
                <p class="text-center">Don't have an account? <a href="register.php" class="register-link">Register here</a>.</p>
            </form>
        </div>
    </div>
</body>

</html>