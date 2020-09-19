<?php
session_start();
include '../includes/config.php';
if (strlen($_SESSION['alogin'])==0) {
    header('location:index.php');
} else {
    $pid=intval($_GET['id']);
    $_SESSION['job-logo-msg']="";
    $_SESSION['msgclass']="";
    $query=mysqli_query($conn, "select companyName,fileLogo from job where id='$pid'");
    $cnt=1;
    while ($row=mysqli_fetch_array($query)) {
        if (isset($_POST['change-logo'])) {
            $companyName=$_POST['companyName'];
            $fileLogo=$_FILES["fileLogo"]["name"];
            $dir="../uploads/company-logo/";
            unlink($dir.$row["fileLogo"]);

            move_uploaded_file($_FILES["fileLogo"]["tmp_name"], $dir.$_FILES["fileLogo"]["name"]);
            $sql=mysqli_query($conn, "update job set fileLogo='$fileLogo' where id='$pid' ");
            $_SESSION['job-logo-msg']="Company Logo Updated Successfully !!";
            $_SESSION['msgclass']="success-msg";
        } ?>

<?php include 'includes/header.php'; ?>
<?php include 'includes/navbar.php'; ?>

<div class="container body-section">
    <div class="row">
        <div class="sidebar-col col-md-3">
            <?php include 'sidebar.php'; ?>
        </div>
        <div class="next-col col-md-9">
            <form method="post" enctype="multipart/form-data">
                <h5 class="form-head">Update Company Logo</h5>
                <hr />
                <?php if ($_SESSION['job-logo-msg'] != '') { ?>
                <span class=<?php echo $_SESSION['msgclass']; ?>>
                    <?php echo htmlentities($_SESSION['job-logo-msg']); ?>
                </span>
                <?php } ?>
                <div class="form-group">
                    <label>Company Name</label>
                    <input type="text" name="companyName" readonly
                        value="<?php echo htmlentities($row['companyName']); ?>" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>File Logo</label>
                    <div>
                        <img src="../uploads/company-logo/<?php echo htmlentities($row['fileLogo']); ?>" width="200"
                            height="100">
                    </div>
                </div>
                <div class="form-group">
                    <label>Choose New Logo</label>
                    <input type="file" class="form-control-file border" name="fileLogo" required>
                </div>
                <?php
    } ?>
                <div class="modal-footer">
                    <button type="submit" name="change-logo" class="btn btn-primary">Update Logo</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>


<?php
}