  <style type="text/css">
    .mailbox-controls .btn {
      padding: 3px 8px;
      margin: 0px 2px;
    }
  </style>
<?php 
if (!isset($_GET['p'])) {
?>
  <div class="content-wrapper">
    <section class="content">
      <div class="row">
    
        <div class="col-md-12">
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Messages</h3>

              <div class="box-tools pull-right" style="margin-bottom: 5px;">
                <div class="has-feedback">
                  <input type="text" class="form-control input-sm" placeholder="Search Mail">
                  <span class="fa fa-search form-control-feedback" style="margin-top: -25px"></span>
                </div>
              </div>
            </div>
            <div class="box-body no-padding">
              <div class="mailbox-controls">
                <div class="btn-group">
                 
                </div>
               
              </div>
              <div class="table-responsive mailbox-messages">
                <table class="table table-hover table-striped">
                  <tbody>
                    <?php 
                        $sql = "SELECT * FROM `tblcompany` c,`tbljobregistration` j,`tblfeedback` f  WHERE c.`COMPANYID`=j.`COMPANYID` AND j.`REGISTRATIONID`=f.`REGISTRATIONID` AND `PENDINGAPPLICATION`=0 AND j.`APPLICANTID`='{$_SESSION['APPLICANTID']}'";
                        $mydb->setQuery($sql);
                        $cur = $mydb->loadResultList();
                        foreach ($cur as $result) {
                          echo '<tr>';
                          echo '<td><input type="checkbox"></td>';
                          echo '<td class="mailbox-name"><a href="index.php?view=message&p=readmessage&id='.$result->REGISTRATIONID.'">'.$result->COMPANYNAME.'</a></td>';
                          echo '<td class="mailbox-subject">'.$result->REMARKS.'</td>'; 
                          echo '<td class="mailbox-date">'.$result->DATETIMEAPPROVED.'</td>';
                          echo '</tr>';
                        }
                    ?> 
                  </tbody>
                </table>
              </div>
            </div>
            <div class="box-footer no-padding">
              <div class="mailbox-controls">
                
                </button>
                <div class="btn-group">
                  <button type="button" class="btn btn-default btn-sm"><i class="fa fa-trash-o"></i></button>
                 
                </div>
             
                <a href="index.php?view=message" class="btn btn-default btn-sm"><i class="fa fa-refresh"></i></a>
                <div class="pull-right">
                  1-50/200
                  <div class="btn-group">
                    <button type="button" class="btn btn-default btn-sm"><i class="fa fa-chevron-left"></i></button>
                    <button type="button" class="btn btn-default btn-sm"><i class="fa fa-chevron-right"></i></button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
   
 <?php }else{  
  require_once('readmessage.php');
 } ?>