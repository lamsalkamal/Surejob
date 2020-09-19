<footer>
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <h5 class="footer-head">Sure Job</h5>
                <p>
                    Surejob is a one stop solution for HR requirements like staffing & executive search. We are a
                    prominent executive search & selection company, providing a wide range of recruitment solutions for
                    various
                    human resource requirements. We are offering services for all Nepal.
                </p>
                <span><a href="">Find us on Facebook</a></span>
            </div>
            <div class="col-md-4">
                <h5 class="footer-head">Quick Links</h5>
                <ul>
                    <li><a href="../index.php"><i class="fa fa-home"></i> Home</a></li>
                    <li><a href="../contact.php"><i class="fa fa-phone"></i> Contact Us</a></li>
                    <li><a href="../login.php"><i class="fa fa-sign-in"></i> Login</a></li>
                    <li><a href="../register.php"><i class="fa fa-sign-in"></i> Register</a></li>
                </ul>
            </div>
            <div class="col-md-4">
                <h5 class="footer-head">Location</h5>
                <ul>
                    <?php
    $id=intval('1');
    $query=mysqli_query($conn, "select * from companyDetail where id='$id'");
    while ($row=mysqli_fetch_array($query)) {
        ?>
                    <li><i class="fa fa-map"></i> <?php echo htmlentities($row['address']); ?>
                    </li>
                    <li><i class="fa fa-phone"></i> <?php echo htmlentities($row['phoneNum']); ?>
                        <?php if ($row['mobile'] != '') {
            echo '/ '.htmlentities($row['mobile']);
        } ?>
                    </li>
                    <li><i class="fa fa-envelope-o"></i> <?php echo htmlentities($row['email']); ?>
                    </li>
                    <?php
    } ?>
                </ul>
            </div>
        </div>
    </div>
    <div class="copy-right">
        <p>SureJob.com &copy; <?php echo date('Y'); ?>.</p>
        <p>Powered by: <a href="https://www.bitmapitsolution.com" target="_blank">Bitmap I.T. Solution Pvt. Ltd.</a></p>
    </div>
</footer>
<script src="scripts/jquery-1.9.1.min.js" type="text/javascript"></script>
<script src="scripts/jquery-ui-1.10.1.custom.min.js" type="text/javascript"></script>
<script src="scripts/flot/jquery.flot.js" type="text/javascript"></script>
<script src="scripts/datatables/jquery.dataTables.js"></script>
<script>
$(document).ready(function() {
    $('.datatable-1').dataTable();
    $('.dataTables_paginate').addClass("btn-group datatable-pagination");
    $('.dataTables_paginate > a').wrapInner('<span />');
    $('.dataTables_paginate > a:first-child').append('<i class="icon-chevron-left shaded"></i>');
    $('.dataTables_paginate > a:last-child').append('<i class="icon-chevron-right shaded"></i>');
});
</script>
</body>

</html>