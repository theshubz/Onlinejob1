<?php
require_once('include/database.php');

if (isset($_GET['search'])) {
    $jobid = $_GET['search'];
} else {
    $jobid = '';
}

$sql = "SELECT * FROM `tblcompany` c,`tbljob` j WHERE c.`COMPANYID`=j.`COMPANYID` AND JOBID LIKE '%" . $jobid . "%' ORDER BY DATEPOSTED DESC";

$result = mysqli_query($mydb, $sql);

if ($result) {
    while ($row = mysqli_fetch_object($result)) {
?>
<div class="container">
    <div class="mg-available-rooms">
        <h5 class="mg-sec-left-title">Date Posted : <?php echo date_format(date_create($row->DATEPOSTED), 'M d, Y'); ?></h5>
        <div class="mg-avl-rooms">
            <div class="mg-avl-room">
                <div class="row">
                    <div class="col-sm-2">
                        <a href="#"><span class="fa fa-building-o" style="font-size: 50px"></span></a>
                    </div>
                    <div class="col-sm-10">
                        <div style="border-bottom: 1px solid #ddd;padding: 10px;font-size: 25px;font-weight: bold;color: #000;margin-bottom: 5px;"><?php echo $row->OCCUPATIONTITLE; ?>
                        </div>
                        <div class="row contentbody">
                            <div class="col-sm-6">
                                <ul>
                                    <li><i class="fp-ht-bed"></i> No. of Employee's Required: <?php echo $row->REQ_NO_EMPLOYEES; ?></li>
                                    <li><i class="fp-ht-food"></i>Salary : <?php echo number_format($row->SALARIES, 2); ?></li>
                                    <li><i class="fa fa-sun-"></i>Duration of Employment : <?php echo $row->DURATION_EMPLOYEMENT; ?></li>
                                </ul>
                            </div>
                            <div class="col-sm-6">
                                <ul>
                                    <li><i class="fp-ht-tv"></i>Prefered Gender : <?php echo $row->PREFEREDSEX; ?></li>
                                    <li><i class="fp-ht-computer"></i>Sector of Vacancy : <?php echo $row->SECTOR_VACANCY; ?></li>
                                </ul>
                            </div>
                            <div class="col-sm-12">
                                <p>Qualification/Work Experience :</p>
                                <ul style="list-style: none;">
                                    <li><?php echo $row->QUALIFICATION_WORKEXPERIENCE; ?></li>
                                </ul>
                            </div>
                            <div class="col-sm-12">
                                <p>Job Description:</p>
                                <ul style="list-style: none;">
                                    <li><?php echo $row->JOBDESCRIPTION; ?></li>
                                </ul>
                            </div>
                            <div class="col-sm-12">
                                <p>Employer : <?php echo $row->COMPANYNAME; ?></p>
                                <p>Location : <?php echo $row->COMPANYADDRESS; ?></p>
                            </div>
                        </div>
                        <a href="index.php?q=apply&job=<?php echo $row->JOBID; ?>&view=personalinfo" class="btn btn-main btn-next-tab">Apply Now !</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
    }
} else {
    echo "No results found.";
}
?>
