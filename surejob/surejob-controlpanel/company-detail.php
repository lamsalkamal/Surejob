<?php
session_start();
include '../includes/config.php';
if (strlen($_SESSION['alogin'])==0) {
    header('location:index.php');
} else {
    $_SESSION['detail-update-msg']="";
    $_SESSION['msgclass']="";

    if (isset($_POST['edit-company-detail'])) {
        $phoneNum=$_POST['phoneNum'];
        $email=$_POST['email'];
        $address=$_POST['address'];
        $mobile=$_POST['mobile'];
        $id=intval('1');
        $sql=mysqli_query($conn, "update companyDetail set phoneNum='$phoneNum',email='$email',address='$address',mobile='$mobile' where id='$id'");
        if ($sql) {
            $_SESSION['msgclass'] = "success-msg";
            $_SESSION['detail-update-msg']="Company Detail Updated !!";
        }
    } ?>

<?php include 'includes/header.php'; ?>
<?php include 'includes/navbar.php'; ?>

<div class="container body-section">
    <div class="row">
        <div class="sidebar-col col-md-3">
            <?php include 'sidebar.php'; ?>
        </div>
        <div class="next-col col-md-9">
            <?php
                $id=intval('1');
    $query=mysqli_query($conn, "select * from companyDetail where id='$id'");
    while ($row=mysqli_fetch_array($query)) {
        ?>
            <form name="company-detail" method="post" class="change-password-form">
                <h5 class="form-head">Update Company Detail</h5>
                <hr />
                <?php if ($_SESSION['detail-update-msg'] != '') { ?>
                <span class=<?php echo $_SESSION['msgclass']; ?>>
                    <?php echo htmlentities($_SESSION['detail-update-msg']); ?>
                </span>
                <?php } ?>
                <div class="form-group">
                    <label for="phone-number">Phone Number</label>
                    <input type="text" class="form-control" id="phone-number" name="phoneNum" required
                        value="<?php echo htmlentities($row['phoneNum']); ?>">
                </div>
                <div class="form-group">
                    <label for="mobile">Mobile Number</label>
                    <input type="text" class="form-control" id="mobile" name="mobile" required
                        value="<?php echo htmlentities($row['mobile']); ?>">
                </div>
                <div class="form-group">
                    <label for="email-address">Email</label>
                    <input type="text" class="form-control" id="email-address" name="email" required
                        value="<?php echo htmlentities($row['email']); ?>">
                </div>
                <div class="form-group">
                    <label for="address">Address</label>
                    <input type="text" class="form-control" id="address" name="address" required
                        value="<?php echo htmlentities($row['address']); ?>">
                </div>
                <button type="submit" class="btn btn-primary" name="edit-company-detail">Update Company
                    Details</button>
            </form>
            <?php
    } ?>
        </div>
    </div>
</div>
</div>
</div>

<?php include 'includes/footer.php'; ?>

<?php
}