<?php
$mydb = new mysqli('opportunityjunction.mysql.database.azure.com', 'shubhamj', 'omkar@29', 'erisdb');

if ($mydb->connect_errno) {
    echo "Failed to connect to MySQL: " . $mydb->connect_error;
    exit();
}

$sql = "SELECT * FROM `tblcompany`";
$result = $mydb->query($sql);

if ($result) {
    ?>

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="aligncenter"><h2 class="aligncenter">Company</h2></div>
                <br/>
            </div>
        </div>

        <div class="row">
            <?php
            while ($company = $result->fetch_assoc()) {
                ?>
                <div class="col-sm-4 info-blocks">
                    <i class="icon-info-blocks fa fa-building-o"></i>
                    <div class="info-blocks-in">
                        <h3><?php echo $company['COMPANYNAME']; ?></h3>
                        <!-- <p><?php echo $company['COMPANYMISSION']; ?></p> -->
                        <p>Address: <?php echo $company['COMPANYADDRESS']; ?></p>
                        <p>Contact No.: <?php echo $company['COMPANYCONTACTNO']; ?></p>
                    </div>
                </div>
                <?php
            }
            ?>
        </div>
    </div>

    <?php
} else {
    echo "Error: " . $mydb->error;
}

// Close the database connection
$mydb->close();
?>
