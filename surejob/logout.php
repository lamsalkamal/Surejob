<?php
session_start();
$_SESSION['userlogin']=="";
session_unset();
//session_destroy();
$_SESSION['user-errmsg']="You have successfully logout";
?>

<script language="javascript">
document.location = "index.php";
</script>