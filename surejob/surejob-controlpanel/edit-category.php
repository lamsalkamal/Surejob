<?php
session_start();
include '../includes/config.php';
if (strlen($_SESSION['alogin'])==0) {
    header('location:index.php');
} else {
    date_default_timezone_set('Europe/Helsinki');// change according timezone
    $currentTime = date('Y-d-m h:i:s', time());
    $_SESSION['msgclass'] = "";
    $_SESSION['category-update-msg']="";
    if (isset($_POST['edit-category'])) {
        $category=$_POST['category'];
        $id=intval($_GET['id']);
        $sql=mysqli_query($conn, "update category set categoryName='$category',updationDate='$currentTime' where id='$id'");
        $_SESSION['msgclass'] = "success-msg";
        $_SESSION['category-update-msg']="Category Updated !!";
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
                <h5 class="form-head">Update Category</h5>
                <hr />
                <?php if ($_SESSION['category-update-msg'] != '') { ?>
                <span class=<?php echo $_SESSION['msgclass']; ?>>
                    <?php echo htmlentities($_SESSION['category-update-msg']); ?>
                </span>
                <?php } ?>
                <?php
                    $id=intval($_GET['id']);
    $query=mysqli_query($conn, "select * from category where id='$id'");
    while ($row=mysqli_fetch_array($query)) {
        ?>
                <div class="form-group">
                    <label for="category-name">Category Name</label>
                    <input type="text" class="form-control" id="category-name" name="category"
                        value="<?php echo  htmlentities($row['categoryName']); ?>" required>
                </div>
                <?php
    } ?>
                <hr />
                <button type="submit" class="btn btn-primary" name="edit-category">Update Category</button>
            </form>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>

<?php
}