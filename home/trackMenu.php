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
<?php include('navbar.php'); // Assuming you have a navbar file ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Track Courier</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <h2 class="text-center">Your Couriers</h2>
    <div class="table-responsive">
        <table class="table table-bordered table-hover mt-3">
            <thead class="thead-dark">
                <tr>
                    <th>No.</th>
                    <th>Item's Image</th>
                    <th>Sender Name</th>
                    <th>Receiver Name</th>
                    <th>Receiver Email</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include('../dbconnection.php');

                $email = $_SESSION['emm'];

                $qryy = "SELECT * FROM `courier` WHERE `semail`='$email'";
                $run = mysqli_query($dbcon, $qryy);

                if(mysqli_num_rows($run) < 1){
                    echo "<tr><td colspan='6' class='text-center'>No record found.</td></tr>";
                } else {
                    $count = 0;
                    while($data = mysqli_fetch_assoc($run)) {
                        $count++;
                ?>
                <tr>
                    <td><?php echo $count; ?></td>
                    <td><img src="../dbimages/<?php echo $data['image']; ?>" alt="pic" class="img-thumbnail" style="max-width: 100px;"/></td>
                    <td><?php echo $data['sname']; ?></td>
                    <td><?php echo $data['rname']; ?></td>
                    <td><?php echo $data['remail']; ?></td>
                    <td>
                        <a href="updationtable.php?sid=<?php echo $data['c_id']; ?>" class="btn btn-primary btn-sm">Edit</a>
                        <a href="deletecourier.php?bb=<?php echo $data['billno']; ?>" class="btn btn-danger btn-sm">Delete</a>
                        <a href="status.php?sidd=<?php echo $data['c_id']; ?>" class="btn btn-info btn-sm">Check Status</a>
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