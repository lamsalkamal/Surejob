<?php
session_start();
include '../includes/config.php';
if (strlen($_SESSION['alogin'])==0) {
    header('location:index.php');
} else {
    date_default_timezone_set('Europe/Helsinki');// change according timezone
    $currentTime = date('Y-d-m h:i:s', time());
    $_SESSION['job-update-msg']="";
    $_SESSION['msgclass']="";
    $pid=intval($_GET['id']);
    if (isset($_POST['edit-job'])) {
        $jobTitle = $_POST['jobTitle'];
        $companyName = $_POST['companyName'];
        $jobCategory = $_POST['jobCategory'];
        $companyUrl = $_POST['companyUrl'];
        $companyLocation = $_POST['companyLocation'];
        $otherInfo = $_POST['otherInfo'];
   
        $query = "UPDATE job SET jobTitle='$jobTitle',companyName='$companyName',jobCategory='$jobCategory',companyUrl='$companyUrl',companyLocation='$companyLocation',otherInfo='$otherInfo',updationDate='$currentTime' WHERE id='$pid'";
        $sql=mysqli_query($conn, $query);
        $_SESSION['job-update-msg']="Job Updated Successfully !!";
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
                <h5 class="form-head">Edit Job</h5>
                <hr />
                <?php if ($_SESSION['job-update-msg'] != '') { ?>
                <span class=<?php echo $_SESSION['msgclass']; ?>>
                    <?php echo htmlentities($_SESSION['job-update-msg']); ?>
                </span>
                <?php } ?>
                <?php

$query=mysqli_query($conn, "select job.*,category.categoryName as catname,category.id as cid from job join category on category.id=job.jobCategory where job.id='$pid'");
    $cnt=1;
    while ($row=mysqli_fetch_array($query)) {
        ?>

                <div class="form-group">
                    <label for="text">Job Title</label>
                    <input type="text" class="form-control" name="jobTitle"
                        value="<?php echo htmlentities($row['jobTitle']); ?>">
                </div>
                <div class="form-group">
                    <label for="text">Company Name</label>
                    <input type="text" class="form-control" name="companyName"
                        value="<?php echo htmlentities($row['companyName']); ?>">
                </div>
                <div class="form-group">
                    <label for="text">Job Category:</label><br>
                    <select class="form-control" name="jobCategory" required>
                        <option value="<?php echo htmlentities($row['cid']); ?>">
                            <?php echo htmlentities($row['catname']); ?>
                        </option>
                        <?php $query=mysqli_query($conn, "select * from category");
        while ($rw=mysqli_fetch_array($query)) {
            if ($row['catname']==$rw['categoryName']) {
                continue;
            } else {
                ?>
                        <option value="<?php echo $rw['id']; ?>">
                            <?php echo $rw['categoryName']; ?>
                        </option>
                        <?php
            }
        } ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="text">Company Url</label>
                    <input type="text" class="form-control" name="companyUrl"
                        placeholder="website url / facebook-page url"
                        value="<?php echo htmlentities($row['companyUrl']); ?>">
                </div>

                <div class="form-group">
                    <label for="text">Company Logo</label>
                    <img src="../uploads/company-logo/<?php echo htmlentities($row['fileLogo']); ?>" width="200"
                        height="100"> <a href="change-logo.php?id=<?php echo $row['id']; ?>">Change
                        Logo</a>
                </div>

                <div class="form-group">
                    <label for="text">Company Location</label>
                    <input type="text" class="form-control" name="companyLocation"
                        value="<?php echo htmlentities($row['companyLocation']); ?>">
                </div>

                <div class="form-group">
                    <label for="comment">Other Information</label>
                    <textarea class="form-control" rows="5"
                        name="otherInfo"><?php echo htmlentities($row['otherInfo']); ?></textarea>
                </div>
                <?php
    } ?>
                <div class="modal-footer">
                    <button type="submit" name="edit-job" class="btn btn-primary">Edit Job</button>
                    <button type="button" class="btn btn-danger">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>
<?php
}