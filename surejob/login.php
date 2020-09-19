<?php
session_start();
error_reporting(0);
include "includes/config.php" ;

$active='login';
$title='Login';
$description='Login page of SureJob.com';

$host=$_SERVER['HTTP_HOST'];
$uri=rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
    
if (strlen($_SESSION['userlogin'])!=0) {
    header("location:http://$host$uri/index.php");
}
if (isset($_POST['login'])) {
    $email=$_POST['email'];
    $password=md5($_POST['password']);
    $ret=mysqli_query($conn, "SELECT * FROM users WHERE email='$email' and password='$password'");
    $num=mysqli_fetch_array($ret);
    $_SESSION['user-errmsg']="";
    if ($num>0) {
        $extra="index.php";//
        $_SESSION['userlogin']=$_POST['email'];
        $_SESSION['fullName']=$num['fullName'];
        $_SESSION['id']=$num['id'];
        header("location:http://$host$uri/$extra");
        exit();
    } else {
        $_SESSION['user-errmsg']="Invalid email or password";
        $extra="login.php";
        header("location:http://$host$uri/$extra");
        exit();
    }
}
?>

<?php include 'includes/header.php';?>
<?php include 'includes/top-navbar.php';?>
<?php include 'includes/main-navbar.php';?>

<div class="container body-section">
    <div class="admin-login">
        <div class="row">
            <div class="col-md-6 col-xl-4">
                <form method="post" class="login-form">
                    <h5 class="form-head">Sign In</h5>
                    <hr />
                    <?php if ($_SESSION['user-errmsg'] != "") { ?>
                    <span class="error-msg">
                        <?php echo htmlentities($_SESSION['user-errmsg']); ?>
                    </span>
                    <?php } ?>
                    <div class="form-group">
                        <label for="user-email">Email</label>
                        <input type="text" class="form-control" id="user-email" name="email">
                    </div>
                    <div class="form-group">
                        <label for="user-password">Password</label>
                        <input type="password" class="form-control" id="user-password" name="password">
                    </div>
                    <hr />
                    <button type="submit" class="btn btn-primary" name="login">Login</button>
                    <span class="qna-acc">
                        Don't have an account? <a href="register.php">Register here</a>
                    </span>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include 'includes/footer.php';