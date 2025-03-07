<?php
session_start();
if(isset($_SESSION['uid'])){
    echo "";
} else {
    header('location: ../index.php');
}
?>
<?php
include('header.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pricing</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 80%;
            margin: 50px auto;
            background: #fff;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            text-align: center;
            color: #333;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 12px;
            text-align: center;
        }
        th {
            background-color: #4CAF50;
            color: white;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        .payment-info {
            text-align: center;
            margin-top: 20px;
        }
        .payment-info ol {
            list-style: none;
            padding: 0;
        }
        .payment-info li {
            margin: 10px 0;
            font-size: 18px;
        }
        .payment-info li i {
            margin-right: 10px;
            color: #4CAF50;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Pricing</h1>
        <table>
            <tr>
                <th>Weight in Kg</th>
                <th>Price</th>
            </tr>
            <tr>
                <td>0-1</td>
                <td>120</td>
            </tr>
            <tr>
                <td>1-2</td>
                <td>200</td>
            </tr>
            <tr>
                <td>2-4</td>
                <td>250</td>
            </tr>
            <tr>
                <td>4-5</td>
                <td>300</td>
            </tr>
            <tr>
                <td>5-7</td>
                <td>400</td>
            </tr>
            <tr>
                <td>7-above</td>
                <td>500</td>
            </tr>
        </table>
        <div class="payment-info">
            <h3>As per your courier's weight, pay the amount on:</h3>
            <ol>
                <li><i class="fas fa-university"></i> UPI: abcd@sbi.com</li>
                <li><i class="fab fa-google-pay"></i> GPay: 6362786223</li>
                <li><i class="fas fa-mobile-alt"></i> PhnPay: 3565656555</li>
            </ol>
        </div>
    </div>
</body>
</html>