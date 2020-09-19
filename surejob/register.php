<?php
session_start();
error_reporting(0);
include "includes/config.php" ;
if (strlen($_SESSION['userlogin'])!=0) {
    header('location:index.php');
} else {
    $active = 'register';
    $title='Register';
    $description='Registration page of SureJob.com';

    date_default_timezone_set('Europe/Helsinki');// change according timezone
    $currentTime = date('d-m-Y h:i:s A', time());
    $_SESSION['register-msg']="";
    $_SESSION['msgclass']="";
    if (isset($_POST['register'])) {
        $fullName=$_POST['fullName'];
        $email=$_POST['email'];
        $location=$_POST['location'];
        $phoneNum=$_POST['phoneNum'];
        $education=$_POST['education'];
        $jobLocation=$_POST['jobLocation'];
        $category=$_POST['category'];
        $vehicle=$_POST['vehicle'];
        $license=$_POST['license'];
        $propic = $_FILES['propic']['name'];
        $tmp_name = $_FILES['propic']['tmp_name'];
        $path = "./uploads/users-pic/".$propic;
        move_uploaded_file($tmp_name, $path);
        $password=md5($_POST['password']);
        $query = "INSERT INTO users(fullName,email,password,location,phoneNum,education,jobLocation,category,vehicle,license,propic) VALUES ('$fullName','$email','$password','$location','$phoneNum','$education','$jobLocation','$category','$vehicle','$license','$propic')";
        $sql=mysqli_query($conn, $query);
        $_SESSION['register-msg']="Registration Successsful !!";
        $_SESSION['msgclass']="success-msg";
    } ?>

<?php include 'includes/header.php'; ?>
<?php include 'includes/top-navbar.php'; ?>
<?php include 'includes/main-navbar.php'; ?>

<div class="container body-section">
    <div class="admin-login">
        <div class="row">
            <div class="col-md-8 col-xl-6">
                <form method="post" class="login-form" enctype="multipart/form-data">
                    <h5 class="form-head">Register</h5>
                    <hr />
                    <?php if ($_SESSION['register-msg'] != "") { ?>
                    <span class="<?php echo htmlentities($_SESSION['msgclass']); ?>">
                        <?php echo htmlentities($_SESSION['register-msg']); ?>
                    </span>
                    <?php } ?>
                    <div class="form-group">
                        <label>Full Name</label>
                        <input type="text" class="form-control" name="fullName">
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" class="form-control" name="email" id="email" required
                            onkeyup="checkemail();">
                        <small class="form-text" id="availability"></small>
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" class="form-control" name="password"
                            pattern="(?=^.{8,}$)(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[!@#$%^&amp;*()_+}{&quot;:;'?/&gt;.&lt;,])(?!.*\s).*$"
                            required>
                        <small class="form-text text-muted">Minimum eight characters, at least one uppercase letter, one
                            lowercase letter and one number.</small>
                    </div>
                    <div class="form-group">
                        <label>Address</label>
                        <input type="text" class="form-control" name="location">
                    </div>
                    <div class="form-group">
                        <label>Phone Number</label>
                        <input type="number" class="form-control" name="phoneNum">
                    </div>
                    <div class="form-group">
                        <label>Education Level</label>
                        <select class="form-control" name="education" required>
                            <option value="" disabled selected>Select your Education Level </option>
                            <?php $query=mysqli_query($conn, "select * from education");
    $cnt=1;
    while ($row=mysqli_fetch_array($query)) {
        ?>
                            <option value="<?php echo $row['id']; ?>">
                                <?php echo $row['educationName']; ?>
                            </option>
                            <?php
    } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Job's Location</label>
                        <select class="form-control" name="jobLocation" required>
                            <option value="" disabled selected>Select job location you want to work at </option>
                            <?php $query=mysqli_query($conn, "select * from jobLocation");
    $cnt=1;
    while ($row=mysqli_fetch_array($query)) {
        ?>
                            <option value="<?php echo $row['id']; ?>">
                                <?php echo $row['jobLocation']; ?>
                            </option>
                            <?php
    } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Job Field</label>
                        <select class="form-control" name="category" required>
                            <option value="" disabled selected>Select job field you want to work in </option>
                            <?php $query=mysqli_query($conn, "select * from category");
    $cnt=1;
    while ($row=mysqli_fetch_array($query)) {
        ?>
                            <option value="<?php echo $row['id']; ?>">
                                <?php echo $row['categoryName']; ?>
                            </option>
                            <?php
    } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Do you have a vehicle?</label><br>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" id="vehicle-yes" value="yes" name="vehicle">
                            <label class="form-check-label" for="vehicle-yes">Yes</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" id="vehicle-no" value="no" name="vehicle">
                            <label class="form-check-label" for="vehicle-no">No</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Do you have a driving license?</label><br>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" id="license-yes" value="yes" name="license">
                            <label class="form-check-label" for="license-yes">Yes</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" id="license-no" value="no" name="license">
                            <label class="form-check-label" for="license-no">No</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Choose Profile Picture</label>
                        <input type="file" class="form-control-file border" accept="image/*" name="propic">
                        <small class="form-text text-muted">Note: Only .jpg and .png formats are allowed.</small>
                    </div>
                    <hr />
                    <button type="submit" class="btn btn-primary" name="register" id="register-btn">Register</button>
                    <span class="qna-acc">
                        Already have an account? <a href="login.php">Login here</a>
                    </span>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>
<?php
}