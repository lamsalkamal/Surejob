<?php
session_start();
include '../includes/config.php';
if (strlen($_SESSION['alogin'])==0) {
    header('location:index.php');
} else {
    $_SESSION['delmsg']="";
    $_SESSION['msgclass']="";
    if (isset($_GET['del'])) {
        $delQuery = mysqli_query($conn, "delete from job where id = '".$_GET['id']."'");
        if ($delQuery) {
            echo "<script>document.location = 'manage-job.php';</script>";
            $_SESSION['delmsg']="Job deleted !!";
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
            <h5 class="form-head">Manage Jobs</h5>
            <hr />
            <div class="manage-job">
                <?php if ($_SESSION['delmsg']) { ?>
                <span class=<?php echo $_SESSION['msgclass']; ?>>
                    <?php echo htmlentities($_SESSION['delmsg']); ?>
                </span>
                <?php } ?>

                <table cellpadding="0" cellspacing="0" border="0"
                    class="datatable-1 table table-bordered table-striped table-responsive-md display" width="100%">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Job Title</th>
                            <th>Category</th>
                            <th>Company Name</th>
                            <th>Company Url</th>
                            <th>Company Logo</th>
                            <th>Job Creation Date</th>
                            <th>Last Updated Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php $query=mysqli_query($conn, "select job.*,category.categoryName from job join category on category.id=job.jobCategory");
    $cnt=1;
    while ($row=mysqli_fetch_array($query)) {
        ?>
                        <tr>
                            <td><?php echo htmlentities($cnt); ?>
                            </td>
                            <td><?php echo htmlentities($row['jobTitle']); ?>
                            </td>
                            <td><?php echo htmlentities($row['categoryName']); ?>
                            </td>
                            <td> <?php echo htmlentities($row['companyName']); ?>
                            </td>
                            <td>
                                <a href="<?php echo htmlentities($row['companyUrl']); ?>"
                                    target="_blank"><?php echo htmlentities($row['companyUrl']); ?></a>
                            </td>
                            <td><img src="../uploads/company-logo/<?php echo htmlentities($row['fileLogo']); ?>"
                                    class="file-logo" />
                            </td>
                            <td> <?php echo htmlentities($row['creationDate']); ?>
                            </td>
                            <td><?php echo htmlentities($row['updationDate']); ?>
                            </td>
                            <td>
                                <a href="edit-job.php?id=<?php echo $row['id']?>"><i class="fa fa-edit"></i></a>
                                <a href="manage-job.php?id=<?php echo $row['id']?>&del=delete"
                                    onClick="return confirm('Are you sure you want to delete?')"><i
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


<?php include 'includes/footer.php'; ?>

<?php
}