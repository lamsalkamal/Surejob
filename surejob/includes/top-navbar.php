<?php
session_start();
include 'includes/config.php';
?>
<?php
    $id=intval('1');
    $query=mysqli_query($conn, "select * from companyDetail where id='$id'");
    while ($row=mysqli_fetch_array($query)) {
        ?>
<div class="top-navbar">
    <span><span><i class="fa fa-phone"></i> Phone:</span> <?php echo  htmlentities($row['phoneNum']); ?>
    </span>
    <span><span><i class="fa fa-envelope-o"></i> Email Address:</span> <a
            href="mailto: <?php echo  htmlentities($row['email']); ?>"><?php echo  htmlentities($row['email']); ?></a>
    </span>
</div>
<?php
    }