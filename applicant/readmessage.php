<?php 
  $id = isset($_GET['id']) ? $_GET['id'] :0;

$sql="UPDATE `tbljobregistration` SET HVIEW=1 WHERE `REGISTRATIONID`='{$id}'";
$mydb->setQuery($sql);
$mydb->executeQuery();


$sql = "SELECT * FROM `tblcompany` c,`tbljobregistration` jr,  `tbljob` j  WHERE c.`COMPANYID`=jr.`COMPANYID` AND jr.`JOBID`=j.`JOBID` AND `REGISTRATIONID`='{$id}'";
$mydb->setQuery($sql);
$res = $mydb->loadSingleResult();

$applicant = new Applicants();
$appl  = $applicant->single_applicant($_SESSION['APPLICANTID']);


?> 

 
  <div class="content-wrapper"> 
   
    <section class="content">
      <div class="row"> 
       
        <div class="col-md-12">
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Read Message</h3> 
            </div>
          
            <div class="box-body no-padding">
              <div class="mailbox-read-info">
                <h3><?php  echo $res->OCCUPATIONTITLE; ?></h3>
                <h5>From: <?php  echo $res->COMPANYNAME; ?>
                  <span class="mailbox-read-time pull-right"><?php  echo date_format(date_create($res->DATETIMEAPPROVED),'d M. Y h:i a'); ?></span></h5>
              </div>
            
              <div class="mailbox-read-message">
                <p>Hello <?php  echo $appl->FNAME; ?>,</p>  
                  <p><?php  echo $res->REMARKS; ?></p>
 
               

                <p>Thanks,<br><?php  echo $res->COMPANYNAME; ?></p>
              </div>

        </div>
      </div>
    </section>

  </div>
  