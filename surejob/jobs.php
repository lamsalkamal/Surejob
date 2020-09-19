<?php
session_start();
error_reporting(0);
include 'includes/config.php';
$title = 'Jobs';
?>
<?php include 'includes/header.php';?>
<?php include 'includes/top-navbar.php';?>
<?php include 'includes/main-navbar.php';?>

<div class="container body-section">
    <div class="row job-detail-container">
        <?php
        $id = $_GET['id'];
        $query=mysqli_query($conn, "select job.*,category.categoryName from job join category on category.id=job.jobCategory having id='$id'");
    $cnt=1;
    while ($row=mysqli_fetch_array($query)) {
        ?>

        <div class="col-md-12 job-detail">
            <span class="post-detail">
                <span>
                    <img src="./uploads/company-logo/<?php echo htmlentities($row['fileLogo']); ?>" class="job-img" />
                </span>
                <span>
                    <h3 class="mt-0 job-title">
                        <?php echo htmlentities($row['jobTitle']); ?>
                    </h3>
                    <small><?php echo htmlentities($row['categoryName']); ?></small>
                    <p class="company-name">
                        <a href="<?php echo htmlentities($row['companyUrl']); ?>" target="_blank">
                            <?php echo htmlentities($row['companyName']); ?>
                        </a>
                        <b>&middot;</b> <?php echo htmlentities($row['companyLocation']); ?>
                    </p>
                    <p class="job-time mt-2">
                        Posted on <?php echo htmlentities(date('M d, Y', strtotime($row['creationDate']))); ?>
                    </p>
                </span>
            </span>
            <hr />
            <span class="other-info">
                <?php echo $row['otherInfo']; ?>
            </span>
        </div>

        <?php
    } ?>
    </div>
</div>
<?php include 'includes/footer.php';