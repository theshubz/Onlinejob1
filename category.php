<section id="content">
    <div class="container content">
        <?php
        if (isset($_GET['search'])) {
            $category = $_GET['search'];
        } else {
            $category = '';
        }

        // Execute the SQL query using mysqli_query
        $sql = "SELECT * FROM `tblcompany` c, `tbljob` j WHERE c.`COMPANYID` = j.`COMPANYID` AND CATEGORY LIKE '%" . $category . "%' ORDER BY DATEPOSTED DESC";
        $result = mysqli_query($mydb, $sql);

        // Check if the query executed successfully
        if ($result) {
            // Fetch and process each row from the result set
            while ($row = mysqli_fetch_assoc($result)) {
        ?>
        <div class="panel panel-primary">
            <div class="panel-header">
                <div style="border-bottom: 1px solid #ddd;padding: 10px;font-size: 20px;font-weight: bold;color: #000;margin-bottom: 5px;">
                    <a href="<?php echo web_root.'index.php?q=viewjob&search='.$row['JOBID'];?>"><?php echo $row['OCCUPATIONTITLE']; ?></a>
                </div>
            </div>
            <div class="panel-body contentbody">
                <div class="row">
                    <div class="col-sm-6">
                        <ul>
                            <li><i class="fp-ht-food"></i>Salary: <?php echo number_format($row['SALARIES'], 2); ?></li>
                            <li><i class="fa fa-sun-"></i>Duration of Employment: <?php echo $row['DURATION_EMPLOYMENT']; ?></li>
                        </ul>
                    </div>
                    <div class="col-sm-6">
                        <ul>
                            <li><i class="fp-ht-tv"></i>Prefered Gender: <?php echo $row['PREFEREDSEX']; ?></li>
                            <li><i class="fp-ht-computer"></i>Sector of Vacancy: <?php echo $row['SECTOR_VACANCY']; ?></li>
                        </ul>
                    </div>
                    <div class="col-sm-12">
                        <p>Qualification/Work Experience:</p>
                        <ul style="list-style: none;">
                            <li><?php echo $row['QUALIFICATION_WORKEXPERIENCE'] ;?></li>
                        </ul>
                    </div>
                    <div class="col-sm-12">
                        <p>Job Description:</p>
                        <ul style="list-style: none;">
                            <li><?php echo $row['JOBDESCRIPTION'] ;?></li>
                        </ul>
                    </div>
                    <div class="col-sm-12">
                        <p>Employer: <?php echo $row['COMPANYNAME'] ?></p>
                        <p>Location: <?php echo $row['COMPANYADDRESS'] ?></p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <a href="index.php?q=apply&job=<?php echo $row['JOBID'];?>&view=personalinfo" class="btn btn-main btn-next-tab">Apply Now!</a>
                    </div>
                </div>
            </div>
            <div class="panel-footer">
                Date Posted: <?php echo date_format(date_create($row['DATEPOSTED']),'M d, Y'); ?>
            </div>
        </div>
        <?php
            }
        } else {
            // Handle the case where the query fails
            echo "Error: " . mysqli_error($mydb);
        }
        ?>
    </div>
</section>
