<?php
session_start();
include '../includes/config.php';
if (strlen($_SESSION['alogin'])==0) {
    header('location:index.php');
} else {
    date_default_timezone_set('Europe/Helsinki');// change according timezone
    $currentTime = date('Y-d-m h:i:s', time());
    $_SESSION['msgclass'] = "";
    $_SESSION['location-update-msg']="";
    if (isset($_POST['edit-job-location'])) {
        $jobLocation=$_POST['jobLocation'];
        $id=intval($_GET['id']);
        $sql=mysqli_query($conn, "update jobLocation set jobLocation='$jobLocation',updationDate='$currentTime' where id='$id'");
        $_SESSION['msgclass'] = "success-msg";
        $_SESSION['location-update-msg']="Job Location Updated !!";
    } ?>

<?php include 'includes/header.php'; ?>
<?php include 'includes/navbar.php'; ?>

<div class="container body-section">
    <div class="row">
        <div class="sidebar-col col-md-3">
            <?php include 'sidebar.php'; ?>
        </div>
        <div class="next-col col-md-9">
            <form name="Category" method="post" class="change-password-form">
                <h5 class="form-head">Update Job Location</h5>
                <hr />
                <?php if ($_SESSION['location-update-msg'] != '') { ?>
                <span class=<?php echo $_SESSION['msgclass']; ?>>
                    <?php echo htmlentities($_SESSION['location-update-msg']); ?>
                </span>
                <?php } ?>
                <?php
                    $id=intval($_GET['id']);
    $query=mysqli_query($conn, "select * from jobLocation where id='$id'");
    while ($row=mysqli_fetch_array($query)) {
        ?>
                <div class="form-group">
                    <label for="job-location">Job Location</label>
                    <input type="text" class="form-control" id="job-location" name="jobLocation"
                        value="<?php echo  htmlentities($row['jobLocation']); ?>" required>
                </div>
                <?php
    } ?>
                <hr />
                <button type="submit" class="btn btn-primary" name="edit-job-location">Update Job Location</button>
            </form>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>

<?php
}