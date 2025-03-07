<?php
session_start();
if (!isset($_SESSION['uid'])) {
    header('location: ../login.php');
    exit();
}
?>

<?php include('head.php'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Users</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="d-flex justify-content-between mb-3">
            <a href="dashboard.php" class="btn btn-primary">Back to Dashboard</a>
            <a href="logout.php" class="btn btn-danger">Log Out</a>
        </div>
        <h1 class="text-center mb-4">Showing All Users</h1>
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead class="thead-dark">
                    <tr>
                        <th>No.</th>
                        <th>User Name</th>
                        <th>Email Id</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    include('../dbconnection.php');

                    $qry = "SELECT * FROM `users`";
                    $run = mysqli_query($dbcon, $qry);

                    if (mysqli_num_rows($run) < 1) {
                        echo "<tr><td colspan='4' class='text-center'>There is no data in the database</td></tr>";
                    } else {
                        $count = 0;
                        while ($data = mysqli_fetch_assoc($run)) {
                            $count++;
                            ?>
                            <tr>
                                <td><?php echo $count; ?></td>
                                <td><?php echo $data['name']; ?></td>
                                <td><?php echo $data['email']; ?></td>
                                <td><a href="usersdeleted.php?emm=<?php echo $data['email']; ?>" class="btn btn-danger btn-sm">Delete User</a></td>
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