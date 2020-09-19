<?php
session_start();
error_reporting(0);
include 'includes/config.php';
$active = 'home';
?>
<?php include 'includes/header.php';?>
<?php include 'includes/top-navbar.php';?>
<?php include 'includes/main-navbar.php';?>
<div class="container body-section index-page">
    <div class="row">
        <div class="col-md-8">
            <?php include 'search-input.php'; ?>
            <div class="row job-lists-container">
                <?php $query=mysqli_query($conn, "select * from job order by creationDate desc");
    $cnt=1;
    while ($row=mysqli_fetch_array($query)) {
        ?>
                <div class="col-md-6 col-lg-6 col-xl-6 job-lists">
                    <div class="media" onclick="document.location='jobs.php?id=<?php echo $row['id']; ?>';">
                        <img src="./uploads/company-logo/<?php echo htmlentities($row['fileLogo']); ?>"
                            class="mr-3 media-img" alt="">
                        <div class="media-body">
                            <span class="mt-0 job-title"><?php echo htmlentities($row['jobTitle']); ?>
                            </span>
                            <p class="company-name"><?php echo htmlentities($row['companyName']); ?>
                            </p>
                            <span
                                class="job-time"><?php echo htmlentities(date('M d, Y', strtotime($row['creationDate']))); ?></span>
                        </div>
                    </div>
                </div>

                <?php
    } ?>
            </div>
        </div>
        <div class="col-md-4 facebook-frame-page">
            <div class="fb-page" data-href="https://www.facebook.com/surejob.com.np/" data-tabs="timeline" data-width=""
                data-height="" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false"
                data-show-facepile="true">
                <blockquote cite="https://www.facebook.com/surejob.com.np/" class="fb-xfbml-parse-ignore"><a
                        href="https://www.facebook.com/surejob.com.np/">SureJob.com</a></blockquote>
            </div>
        </div>
    </div>
</div>
<?php include 'includes/footer.php';