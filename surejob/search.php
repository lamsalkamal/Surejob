<?php
session_start();
error_reporting(0);
include 'includes/config.php';
$title="Search results for ".$_GET['query'];
?>
<?php include 'includes/header.php';?>
<?php include 'includes/top-navbar.php';?>
<?php include 'includes/main-navbar.php';?>
<div class="container body-section">
    <?php include 'search-input.php'; ?>
    <div class="row job-lists-container">
        <?php
        $query = $_GET['query'];
        $category=$_GET['category'];
        if (strlen($category) == 0) {
            $sql=mysqli_query($conn, "select * from job WHERE jobTitle LIKE '%$query%' OR companyName LIKE '%$query%'");
        } else {
            $sql=mysqli_query($conn, "select * from job WHERE jobTitle LIKE '%$query%' OR companyName LIKE '%$query%' HAVING jobCategory='$category'");
        }
    $cnt=1;
    $number_of_rows=mysqli_num_rows($sql);
    if ($number_of_rows > 0) { ?>
        <h4 class="col-md-12"><?php echo $number_of_rows; ?> search
            results for '<?php echo $_GET['query']; ?>'</h4>
        <?php
        while ($row=mysqli_fetch_array($sql)) {
            ?>
        <div class="col-md-6 col-lg-6 col-xl-4 job-lists">
            <div class="media">
                <img src="./uploads/company-logo/<?php echo htmlentities($row['fileLogo']); ?>" class="mr-3 media-img"
                    alt="">
                <div class="media-body">
                    <span class="mt-0 job-title"
                        onclick="document.location='jobs.php?id=<?php echo $row['id']; ?>';"><?php echo htmlentities($row['jobTitle']); ?>
                    </span>
                    <a href="<?php echo htmlentities($row['companyUrl']); ?>" target="_blank"
                        class="company-name"><?php echo htmlentities($row['companyName']); ?></a>
                    <span
                        class="job-time"><?php echo htmlentities(date('M d, Y', strtotime($row['creationDate']))); ?></span>
                </div>
            </div>
        </div>

        <?php
        }
    } else { ?>
        <div class="col-md-12 no-results">
            <img src="assets/images/no-results.png" class="no-results-img" />
            <span class="no-results-text">
                <h5>No results found for <?php echo $query; ?>
                </h5>
                <ul>
                    <li>Try different keywords.</li>
                    <li>Try searching same keywords with different category.</li>
                </ul>
            </span>
        </div>
        <?php } ?>
    </div>
</div>
<?php include 'includes/footer.php';