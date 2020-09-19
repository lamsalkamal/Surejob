<?php include 'includes/config.php'; ?>

<?php
    if (isset($_POST['user_email'])) {
        $emailId=$_POST['user_email'];

        $sql = " SELECT * FROM users WHERE email='$emailId' ";

        $query = mysqli_query($conn, $sql);

        if (mysqli_num_rows($query)>0) {
            echo '<span class="text-danger">Email Already Exist.</span>';
            echo "<script>$('#register-btn').prop('disabled',true);</script>";
        } else {
            echo '<span class="text-success">Email is available for registration.</span>';
            echo "<script>$('#register-btn').prop('disabled',false);</script>";
        }
        exit();
    }