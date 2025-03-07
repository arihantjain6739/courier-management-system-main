<?php
session_start();
if(isset($_SESSION['uid'])){
    echo "";
} else {
    header('location: ../login.php');
}
?>

<?php
include('head.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Data</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="d-flex justify-content-between mb-3">
            <a href="dashboard.php" class="btn btn-primary">Back to Dashboard</a>
            <a href="logout.php" class="btn btn-danger">Log Out</a>
        </div>
        <h1 class="text-center mb-4">Search Data Information</h1>
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead class="thead-dark">
                    <tr>
                        <th>No.</th>
                        <th>Items Image</th>
                        <th>Sender Name</th>
                        <th>Receiver Name</th>
                        <th>Sender Email</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    include('../dbconnection.php');

                    $qryd= "SELECT * FROM `courier`";
                    $run= mysqli_query($dbcon,$qryd);

                    if(mysqli_num_rows($run)<1){
                        echo "<tr><td colspan='6' class='text-center'>No record found.</td></tr>";
                    } else {
                        $count=0;
                        while($data=mysqli_fetch_assoc($run)) {
                            $count++;
                    ?>
                    <tr>
                        <td><?php echo $count; ?></td>
                        <td><img src="../dbimages/<?php echo $data['image']; ?>" alt="pic" class="img-fluid" style="max-width: 100px;"/> </td>
                        <td><?php echo $data['sname']; ?></td>
                        <td><?php echo $data['rname']; ?></td>
                        <td><?php echo $data['semail']; ?></td>
                        <td><a href="datadeleted.php?bb=<?php echo $data['billno']; ?>" class="btn btn-danger btn-sm">Delete</a></td>
                    </tr>
                    <?php
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
