<?php
session_start();
error_reporting(0);
include 'includes/config.php';
$title = 'Contact Us';
$description = 'Contact us page of SureJob.com';
$active = 'contact-us';
?>
<?php
 if (isset($_POST['send-message'])) {
     $fullName = $_POST['fullName'];
     $email = $_POST['email'];
     $message = $_POST['message'];
     $formcontent="From: $fullName \n Message: $message";
     $recipient = "example@email.com";
     $subject = "Contact Form";
     $mailheader = "From: $email \r\n";
     mail($recipient, $subject, $formcontent, $mailheader) or die("Error!");
     echo "Thank You!";
 }
?>
<?php include 'includes/header.php';?>
<?php include 'includes/top-navbar.php';?>
<?php include 'includes/main-navbar.php';?>

<div class="container body-section">
    <div class="row">
        <div class="col-md-12 col-lg-5 col-xl-6 mt-2">
            <iframe
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3532.8750617008664!2d84.41778891458277!3d27.690256132850685!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3994fb35beab27a5%3A0x92de245797a63af!2sBITS%20-Bitmap%20IT%20Solution%20Pvt.%20Ltd.!5e0!3m2!1sen!2snp!4v1582192726319!5m2!1sen!2snp"
                frameborder="0" style="border:0;" allowfullscreen=""></iframe>
        </div>
        <div class="col-md-12 col-lg-7 col-xl-6 mt-2">
            <form class="contact-us-form" method="post">
                <h5 class="form-head">Contact Us</h5>
                <hr />
                <?php if ($_SESSION['password-change-msg'] != '') { ?>
                <span class=<?php echo $_SESSION['msgclass']; ?>>
                    <?php echo htmlentities($_SESSION['password-change-msg']); ?>
                </span>
                <?php } ?>
                <div class="form-group">
                    <label>Full Name</label>
                    <input type="text" class="form-control" name="fullName">
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" class="form-control" name="email">
                </div>
                <div class="form-group">
                    <label>Message</label>
                    <textarea type="text" class="form-control" rows="5" name="message"></textarea>
                </div>
                <hr />
                <button type="submit" class="btn btn-primary" name="send-message">Send Message</button>
            </form>
        </div>
    </div>
</div>

<?php include 'includes/footer.php';