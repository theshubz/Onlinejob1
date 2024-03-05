<section id="content">
    <div class="container content">     
        <div class="row">
            <?php 
            require_once('include/database.php');

            // Assuming $mydb is a MySQLi database connection object
            $sql = "SELECT * FROM `tblcompany`";
            $result = $mydb->query($sql);

            if ($result) {
                while ($company = $result->fetch_object()) {
            ?>
                    <div class="col-sm-4 info-blocks">
                        <i class="icon-info-blocks fa fa-building-o"></i>
                        <div class="info-blocks-in">
                            <h3>
                                <a href="index.php?q=hiring&search=<?php echo $company->COMPANYNAME; ?>"><?php echo $company->COMPANYNAME; ?></a>
                            </h3>
                            <!-- <p><?php echo $company->COMPANYMISSION; ?></p> -->
                            <p>Address: <?php echo $company->COMPANYADDRESS; ?></p>
                            <p>Contact No.: <?php echo $company->COMPANYCONTACTNO; ?></p>
                        </div>
                    </div>
            <?php 
                } // End of foreach loop
            } else {
                echo "Error: " . $mydb->error;
            }
            ?>
        </div> 
    </div>
</section>
