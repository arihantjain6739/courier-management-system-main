<!-- copyright and contactUs fixed footer -->

<!DOCTYPE html>
<html>
<head>
<style>
.footer {
    position: fixed;
    width: 100%;
    text-align: center;
    bottom: 0;
    background-color: #000000;
    color: white;
    border-top: 1px solid rgba(255, 44, 223, 0.3);
    box-shadow: 0 0 15px rgba(255, 44, 223, 0.2);
    padding: 8px 0;
    font-family: 'Rajdhani', sans-serif;
    z-index: 100;
}

.footer p {
    margin-top: 4px;
    margin-bottom: 4px;
    font-size: 0.9rem;
    letter-spacing: 1px;
}

.footer a {
    color: var(--neon-pink);
    text-decoration: none;
    position: relative;
    transition: all 0.3s;
    font-family: 'Orbitron', sans-serif;
    font-size: 0.8rem;
    letter-spacing: 1px;
    padding: 2px 10px;
}

.footer a:hover {
    text-shadow: 0 0 5px rgba(255, 44, 223, 0.7);
    color: var(--neon-pink);
}

.footer a::after {
    content: '';
    position: absolute;
    bottom: -2px;
    left: 50%;
    transform: translateX(-50%);
    width: 0;
    height: 1px;
    background: var(--neon-pink);
    transition: width 0.3s ease;
}

.footer a:hover::after {
    width: 70%;
}

:root {
    --neon-pink: #ff2cdf;
    --neon-blue: #00f9ff;
}
</style>
</head>
<body>
<footer class="footer">
  <p>Copyright © 2025 Typhoon Logistics</p>
  <a href="contactUS.php">Contact Us</a>
</footer>
</body>
</html>