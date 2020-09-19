<?php
session_start();
include '../includes/config.php';
if (strlen($_SESSION['alogin'])==0) {
    header('location:index.php');
} else {
    date_default_timezone_set('Europe/Helsinki');// change according timezone
    $currentTime = date('Y-d-m h:i:s', time());
    $_SESSION['msgclass'] = "";
    $_SESSION['education-update-msg']="";
    
    if (isset($_POST['edit-education-level'])) {
        $educationName=$_POST['educationName'];
        $id=intval($_GET['id']);
        $sql=mysqli_query($conn, "update education set educationName='$educationName',updationDate='$currentTime' where id='$id'");
        $_SESSION['msgclass'] = "success-msg";
        $_SESSION['education-update-msg']="Education Level Updated !!";
    } ?>

<?php include 'includes/header.php'; ?>
<?php include 'includes/navbar.php'; ?>

<div class="container body-section">
    <div class="row">
        <div class="sidebar-col col-md-3">
            <?php include 'sidebar.php'; ?>
        </div>
        <div class="next-col col-md-9">
            <form name="education-level" method="post" class="change-password-form">
                <h5 class="form-head">Update Education Level</h5>
                <hr />
                <?php if ($_SESSION['education-update-msg'] != '') { ?>
                <span class=<?php echo $_SESSION['msgclass']; ?>>
                    <?php echo htmlentities($_SESSION['education-update-msg']); ?>
                </span>
                <?php } ?>
                <?php
                    $id=intval($_GET['id']);
    $query=mysqli_query($conn, "select * from education where id='$id'");
    while ($row=mysqli_fetch_array($query)) {
        ?>
                <div class="form-group">
                    <label for="education-name">Education Name</label>
                    <input type="text" class="form-control" id="education-name" name="educationName"
                        value="<?php echo  htmlentities($row['educationName']); ?>" required>
                </div>
                <?php
    } ?>
                <hr />
                <button type="submit" class="btn btn-primary" name="edit-education-level">Update
                    Education Level</button>
            </form>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>

<?php
}