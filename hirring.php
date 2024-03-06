
    <section id="content">
        <div class="container content">     
       
            
 <table id="dash-table" class="table table-hover">
     <thead>
         <th>Job Title</th>
         <th>Company</th>
         <th>Location</th>
         <th>Date Posted</th>
     </thead>
     <tbody>
     <?php
require_once('include/database.php');

if (isset($_GET['search'])) {
    $COMPANYNAME = $_GET['search'];
} else {
    $COMPANYNAME = '';
}

$sql = "SELECT * FROM `tblcompany` c, `tbljob` j WHERE c.`COMPANYID` = j.`COMPANYID` AND COMPANYNAME LIKE '%" . $COMPANYNAME . "%' ORDER BY DATEPOSTED DESC";

$result = mysqli_query($mydb, $sql);

if ($result) {
    while ($row = mysqli_fetch_object($result)) {
        echo '<tr>';
        echo '<td><a href="index.php?q=viewjob&search=' . $row->JOBID . '">' . $row->OCCUPATIONTITLE . '</a></td>';
        echo '<td>' . $row->COMPANYNAME . '</td>';
        echo '<td>' . $row->COMPANYADDRESS . '</td>';
        echo '<td>' . date_format(date_create($row->DATEPOSTED), 'm/d/Y') . '</td>';
        echo '</tr>';
    }
} else {
    echo "No results found.";
}
?>

     </tbody>
 </table>
 <?php
 
  ?>    
              <?php echo date_format(date_create($result->DATEPOSTED),'M d, Y'); ?></h5>
                        <div class="mg-avl-rooms">
                            <div class="mg-avl-room">
                                <div class="row">
                                    <div class="col-sm-2">
                                        <a href="#"><span class="fa fa-building-o" style="font-size: 50px"></span> </a>
                                    </div>
                                    <div class="col-sm-10">
                                        <h2 class="mg-avl-room-title"><?php echo $result->COMPANYNAME . '/ '. $result->OCCUPATIONTITLE ;?> </h2>
                                        <p><?php echo $result->JOBDESCRIPTION ;?></p>
                                        <div class="row mg-room-fecilities">
                                            <div class="col-sm-6">
                                                <ul>
                                                    <li><i class="fp-ht-bed"></i>Required No. of Employee's : <?php echo $result->REQ_NO_EMPLOYEES; ?></li>
                                                    <li><i class="fp-ht-food"></i>Salaries : <?php echo number_format($result->SALARIES,2);  ?></li>
                                                    <li><i class="fa fa-sun-"></i>Duration of Employment : <?php echo $result->DURATION_EMPLOYEMENT; ?></li>
                                                </ul>
                                            </div>
                                            <div class="col-sm-6">
                                                <ul>
                                                    <li><i class="fp-ht-dumbbell"></i>Qualification/Work Experience : <?php echo $result->QUALIFICATION_WORKEXPERIENCE; ?></li>
                                                    <li><i class="fp-ht-tv"></i>Prefered Sex : <?php echo $result->PREFEREDSEX; ?></li>
                                                    <li><i class="fp-ht-computer"></i>Sector of Vacancy : <?php echo $result->SECTOR_VACANCY; ?></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <a href="index.php?q=apply&job=<?php echo $result->JOBID;?>&view=personalinfo" class="btn btn-main btn-next-tab">Apply Now !</a>
                                    </div>
                                </div>
                            </div> 
                        </div>
                    </div>
        </div>                      

     
   </div>
    </section> 