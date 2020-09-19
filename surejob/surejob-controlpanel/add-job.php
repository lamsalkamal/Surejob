<?php
session_start();
include '../includes/config.php';
if (strlen($_SESSION['alogin'])==0) {
    header('location:index.php');
} else {
    date_default_timezone_set('Europe/Helsinki');// change according timezone
    $currentTime = date('Y-d-m h:i:s', time());
    $_SESSION['job-create-msg']="";
    $_SESSION['msgclass']="";

    if (isset($_POST['add-job'])) {
        $jobTitle = $_POST['jobTitle'];
        $companyName = $_POST['companyName'];
        $jobCategory = $_POST['jobCategory'];
        $companyUrl = $_POST['companyUrl'];
    
        $fileLogo = $_FILES['fileLogo']['name'];
        $tmp_name = $_FILES['fileLogo']['tmp_name'];
        $path = "../uploads/company-logo/".$fileLogo;
        move_uploaded_file($tmp_name, $path);
        $companyLocation = $_POST['companyLocation'];
        $otherInfo = $_POST['otherInfo'];
   
        $query = "INSERT INTO job(jobTitle,companyName,jobCategory,companyUrl,fileLogo,companyLocation,otherInfo,updationDate) VALUES ('$jobTitle','$companyName','$jobCategory','$companyUrl','$fileLogo','$companyLocation','$otherInfo','$currentTime')";
        $sql=mysqli_query($conn, $query);
        echo $sql;
        $_SESSION['job-create-msg']="Job Added !!";
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
                <h5 class="form-head">Add New Job</h5>
                <hr />
                <?php if ($_SESSION['job-create-msg'] != '') { ?>
                <span class=<?php echo $_SESSION['msgclass']; ?>>
                    <?php echo htmlentities($_SESSION['job-create-msg']); ?>
                </span>
                <?php } ?>
                <div class="form-group">
                    <label>Job Title</label>
                    <input type="text" class="form-control" name="jobTitle">
                </div>
                <div class="form-group">
                    <label>Company Name</label>
                    <input type="text" class="form-control" name="companyName">
                </div>
                <div class="form-group">
                    <label>Job Category:</label>
                    <select class="form-control" name="jobCategory" required>
                        <option value="" disabled selected>Select Job Category </option>
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
                    <label>Company Url</label>
                    <input type="text" class="form-control" name="companyUrl"
                        placeholder="website url / facebook-page url">
                </div>

                <div class="form-group">
                    <label>Choose Logo</label>
                    <input type="file" class="form-control-file border" name="fileLogo">
                </div>

                <div class="form-group">
                    <label>Company Location</label>
                    <input type="text" class="form-control" name="companyLocation">
                </div>

                <div class="form-group">
                    <label for="comment">Other Information</label>
                    <textarea class="form-control" rows="5" name="otherInfo"></textarea>
                </div>

                <div class="btns">
                    <button type="submit" name="add-job" class="btn btn-primary">Add Job</button>
                    <button type="button" class="btn btn-danger">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>
<?php
}