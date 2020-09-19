<div class="search-section row">
    <div class="col-md-9">
        <form action="search.php" method="get" class="search-bar">
            <div class="input-group mb-3">
                <input type="search" name="query" class="form-control form-control-lg" id="search"
                    placeholder="Search for jobs....." aria-label="Recipient's username"
                    aria-describedby="search-input">
                <div class="input-group-append">
                    <select class="input-group-text" name="category" id="search-input">
                        <option value="" disabled selected>Category</option>
                        <?php $query=mysqli_query($conn, "select * from category");
    $cnt=1;
    while ($row=mysqli_fetch_array($query)) {
        ?>
                        <option value="<?php echo $row['id']; ?>">
                            <?php echo $row['categoryName']; ?>
                        </option>
                        <?php
    } ?>
                    </select>
                </div>
            </div>
            <input type="submit" class="d-none" value="submit">
        </form>
    </div>
</div>