<?php
session_start();
global $active;
?>

<nav class="navbar navbar-expand-xl navbar-dark bg-dark sticky-top">
    <div class="container">
        <a class="navbar-brand" href="index.php">
            <img src="assets/images/surejob-logo.png" class="logo" />
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main-navbar-trigger"
            aria-controls="main-navbar-trigger" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="main-navbar-trigger">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item <?php echo $active == "home" ? 'active' : ''; ?>">
                    <a class="nav-link" href="index.php">Home</a>
                </li>
                <li class="nav-item <?php echo $active == "contact-us" ? 'active' : ''; ?>">
                    <a class="nav-link" href="contact.php">Contact</a>
                </li>
                <?php if (strlen($_SESSION['userlogin'])==0) { ?>
                <li class="nav-item <?php echo $active == "login" ? 'active' : ''; ?>">
                    <a class="nav-link" href="login.php">Login</a>
                </li>
                <li class="nav-item <?php echo $active == "register" ? 'active' : ''; ?>">
                    <a class="nav-link" href="register.php">Register</a>
                </li>
                <?php } else { ?>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <?php echo htmlentities($_SESSION['fullName']); ?>
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="#">My Profile</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item text-danger" href="logout.php">Logout</a>
                    </div>
                </li>
                <?php } ?>
            </ul>
        </div>
    </div>
</nav>