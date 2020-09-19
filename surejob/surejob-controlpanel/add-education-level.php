<?php
session_start();
include '../includes/config.php';
if (strlen($_SESSION['alogin'])==0) {
    header('location:index.php');
} else {
    date_default_timezone_set('Europe/Helsinki');// change according timezone
    $currentTime = date('Y-d-m h:i:s', time());
    $_SESSION['education-create-msg']="";
    $_SESSION['delmsg']="";
    $_SESSION['msgclass']="";

    if (isset($_POST['create-education-level'])) {
        $educationName=$_POST['educationName'];
        $sql=mysqli_query($conn, "insert into education(educationName,updationDate) values('$educationName','$currentTime')");
        $_SESSION['education-create-msg']="Education Level Created !!";
        $_SESSION['msgclass']="success-msg";
    }

    if (isset($_GET['del'])) {
        $delQuery = mysqli_query($conn, "delete from education where id = '".$_GET['id']."'");
        if ($delQuery) {
            echo "<script>document.location = 'add-education-level.php';</script>";
            $_SESSION['delmsg']="Education Level deleted !!";
            $_SESSION['msgclass']="error-msg";
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
            <form name="education-level" method="post" class="change-password-form">
                <h5 class="form-head">Edcuation Level</h5>
                <hr />
                <?php if ($_SESSION['education-create-msg'] != '') { ?>
                <span class=<?php echo $_SESSION['msgclass']; ?>>
                    <?php echo htmlentities($_SESSION['education-create-msg']); ?>
                </span>
                <?php } ?>
                <div class="form-group">
                    <label for="education-name">Education Name</label>
                    <input type="text" class="form-control" id="education-name" name="educationName" required>
                </div>
                <hr />
                <button type="submit" class="btn btn-primary" name="create-education-level">Create Education
                    Level</button>
            </form>

            <div class="manage-category">
                <h5 class="manage-category-head">Manage Education Level</h5>
                <hr />

                <?php if ($_SESSION['delmsg']) { ?>
                <span class=<?php echo $_SESSION['msgclass']; ?>>
                    <?php echo htmlentities($_SESSION['delmsg']); ?>
                </span>
                <?php } ?>

                <div class="manage-category-body table">
                    <table cellpadding="0" cellspacing="0" border="0"
                        class="datatable-1 table table-bordered table-striped display" width="100%">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Education Level</th>
                                <th>Creation date</th>
                                <th>Last Updated</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php $query=mysqli_query($conn, "select * from education");
    $cnt=1;
    while ($row=mysqli_fetch_array($query)) {
        ?>
                            <tr>
                                <td><?php echo htmlentities($cnt); ?>
                                </td>
                                <td><?php echo htmlentities($row['educationName']); ?>
                                </td>
                                <td> <?php echo htmlentities($row['creationDate']); ?>
                                </td>
                                <td><?php echo htmlentities($row['updationDate']); ?>
                                </td>
                                <td>
                                    <a href="edit-education-level.php?id=<?php echo $row['id']?>"><i
                                            class="fa fa-edit"></i></a>
                                    <a href="add-education-level.php?id=<?php echo $row['id']?>&del=delete"
                                        onclick="return confirm('Are you sure you want to delete?')"><i
                                            class="fa fa-remove"></i></a>
                                </td>
                            </tr>
                            <?php $cnt=$cnt+1;
    } ?>

                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>

<?php
}