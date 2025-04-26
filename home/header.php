<!-- .php -->
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title>Typhoon Logistics</title>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;500;600;700&family=Rajdhani:wght@300;400;500;600;700&display=swap" rel="stylesheet">

<style>
    :root {
        --neon-pink: #ff2cdf;
        --neon-blue: #00f9ff;
        --dark-bg: #000000;
        --darker-bg: #050505;
        --card-bg: #0a0a0a;
        --input-bg: #0a0a0a;
        --border-color: rgba(255, 44, 223, 0.3);
        --text-color: #ffffff;
        --shadow: 0 0 20px rgba(255, 44, 223, 0.3), 0 0 60px rgba(255, 44, 223, 0.1);
    }
    
    body {
        font-family: 'Rajdhani', sans-serif;
        background-color: var(--dark-bg);
    }
    
    .bs-example{
        margin: 0;
    }
    
    .navbar {
        background-color: var(--dark-bg) !important;
        border-bottom: 1px solid rgba(255, 44, 223, 0.3);
        box-shadow: 0 0 15px rgba(255, 44, 223, 0.2);
        padding: 12px 20px;
        font-family: 'Rajdhani', sans-serif;
    }
    
    .navbar-brand {
        font-family: 'Orbitron', sans-serif;
        font-weight: 700;
        color: var(--neon-pink) !important;
        letter-spacing: 2px;
        text-shadow: 0 0 10px rgba(255, 44, 223, 0.5);
    }
    
    .navbar-brand img {
        height: 45px;
        filter: drop-shadow(0 0 5px rgba(255, 44, 223, 0.7));
        margin-right: 10px;
    }
    
    .navbar-nav .nav-link {
        font-size: 1rem;
        padding: 10px 18px;
        font-family: 'Rajdhani', sans-serif;
        font-weight: 500;
        color: white !important;
        letter-spacing: 1px;
        position: relative;
        transition: all 0.3s ease;
        margin: 0 5px;
        border-radius: 20px;
        background: linear-gradient(to right, transparent, rgba(255, 44, 223, 0.05), transparent);
        text-transform: uppercase;
    }
    
    .navbar-nav .nav-link::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 50%;
        transform: translateX(-50%);
        width: 0;
        height: 2px;
        background: var(--neon-pink);
        transition: width 0.3s ease;
        border-radius: 1px;
    }
    
    .navbar-nav .nav-link:hover::after {
        width: 70%;
    }
    
    .navbar-nav .nav-link.active {
        font-weight: 600;
        color: var(--neon-pink) !important;
        text-shadow: 0 0 5px rgba(255, 44, 223, 0.5);
        background: rgba(255, 44, 223, 0.1);
    }
    
    .navbar-nav .nav-link:hover {
        color: var(--neon-pink) !important;
        text-shadow: 0 0 5px rgba(255, 44, 223, 0.5);
        transform: translateY(-2px);
    }
    
    .navbar-toggler {
        border-color: rgba(255, 44, 223, 0.5) !important;
        background-color: transparent !important;
        border-radius: 20px;
    }
    
    .navbar-toggler-icon {
        background-image: url("data:image/svg+xml;charset=utf8,%3Csvg viewBox='0 0 30 30' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath stroke='rgba(255, 44, 223, 0.8)' stroke-width='2' stroke-linecap='round' stroke-miterlimit='10' d='M4 7h22M4 15h22M4 23h22'/%3E%3C/svg%3E") !important;
    }
    
    /* Special styling for the Log Out button */
    .navbar-nav .nav-link:last-child {
        border: 1px solid var(--neon-pink);
        border-radius: 25px;
        padding: 8px 20px;
        margin-left: 10px;
        transition: all 0.3s;
        background: transparent;
        position: relative;
        overflow: hidden;
        font-family: 'Orbitron', sans-serif;
        font-size: 0.9rem;
        font-weight: 500;
    }
    
    .navbar-nav .nav-link:last-child:hover {
        background-color: var(--neon-pink);
        color: white !important;
        box-shadow: 0 0 15px rgba(255, 44, 223, 0.7);
    }
    
    .navbar-nav .nav-link:last-child::before {
        content: "";
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(to right, transparent, rgba(255, 255, 255, 0.2), transparent);
        transition: left 0.7s;
    }
    
    .navbar-nav .nav-link:last-child:hover::before {
        left: 100%;
    }
    
    /* Override for Admin Page link which is the second to last */
    .navbar-nav .nav-link:nth-last-child(2) {
        border: 1px solid rgba(0, 249, 255, 0.5);
        border-radius: 25px;
        padding: 8px 20px;
        margin-left: 0;
        transition: all 0.3s;
        background: transparent;
        font-family: 'Orbitron', sans-serif;
        font-size: 0.9rem;
        font-weight: 500;
    }
    
    .navbar-nav .nav-link:nth-last-child(2):hover {
        background-color: var(--neon-blue);
        color: white !important;
        box-shadow: 0 0 15px rgba(0, 249, 255, 0.7);
    }
</style>
</head>
<body>
<div class="bs-example">
    <nav class="navbar navbar-expand-md">
        <a href="home.php" class="navbar-brand">
            <img src="../images/fcmw.png" alt="Typhoon Logistics">
            <span class="d-none d-md-inline">TYPHOON</span>
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
                <a href="../admin/adminlogin.php" class="nav-item nav-link">ADMIN</a>
                <a href="../logout.php" class="nav-item nav-link">LOGOUT</a>
            </div>
        </div>
    </nav>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>