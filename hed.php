<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />    
    <title>DonateHub</title>
</head>
<header>
    <nav class="navbar navbar-light bg-light">
        <div class="logo-container">
            <a class="navbar-brand" href="#">
                <img src="WhatsApp Image 2024-03-26 à 00.46.56_86f82fd7.jpg" width="100" height="100" alt="Donation-logo"><b>DonateHub</b>
            </a>
        </div>
        <div class="side-bar">
            <?php
                $activePage = basename($_SERVER['PHP_SELF'], ".php");
            ?>
            <ul class="nav nav-pills nav-fill gap-2 p-1 small bg-primary rounded-5 shadow-sm" id="pillNav2" role="tablist" style="--bs-nav-link-color: var(--bs-white); --bs-nav-pills-link-active-color: var(--bs-primary); --bs-nav-pills-link-active-bg: var(--bs-white);">
                <li class="nav-item" role="presentation">
                    <a href="home.php" class="nav-link rounded-5 <?php echo ($activePage == 'home') ? 'active' : ''; ?>">Home</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a href="about.php" class="nav-link rounded-5 <?php echo ($activePage == 'about') ? 'active' : ''; ?>">About</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a href="news.php" class="nav-link rounded-5 <?php echo ($activePage == 'news') ? 'active' : ''; ?>">News</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a href="signup.html" class="nav-link rounded-5 <?php echo ($activePage == 'signup') ? 'active' : ''; ?>">Signup</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a href="login.html" class="nav-link rounded-5 <?php echo ($activePage == 'login') ? 'active' : ''; ?>">Login</a>
                </li>
            </ul>
        </div>
    </nav>
</header>
<?php
if(isset($_GET['page'])) {
    $page = $_GET['page'];
    switch($page) {
        case 'home':
            header("Location: home.php");
            break;
        case 'about':
            header("Location: about.php");
            break;
        case 'news':
            header("Location: news.php");
            break;
        case 'signup':
            header("Location: signup.html");
            break;
        case 'login':
            header("Location: login.html");
            break;
        default:
            header("Location: home.php");
    }
    exit;
}
?>
