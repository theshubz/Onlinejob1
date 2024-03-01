<style type="text/css">
    .mailbox-controls .btn {
      padding: 3px 8px;
      margin: 0px 2px;
    }
</style>
 <div class="content-wrapper">
    <section class="content">
      <div class="row">
    
        <div class="col-md-12">
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Notification</h3>

             
            </div>
          
            <div class="box-body no-padding">
         
              <div class="table-responsive mailbox-messages">
                <table class="table table-hover table-striped">
                  <tbody>
                    <?php 
                        $sql = "SELECT * FROM `tbljob` j, `tblcompany` c WHERE j.`COMPANYID`=c.`COMPANYID` ORDER BY DATEPOSTED DESC LIMIT 10";
                        $mydb->setQuery($sql);
                        $cur = $mydb->loadResultList();
                        foreach ($cur as $result) {
                         
                          echo '<tr>'; 
                          echo '<td class="mailbox-name"><a href="'.web_root.'index.php?q=viewjob&search='.$result->JOBID.'">'.$result->OCCUPATIONTITLE.'</a></td>';
                          echo '<td class="mailbox-subject">'.$result->JOBDESCRIPTION.'</td>'; 
                          echo '<td class="mailbox-date">'.$result->QUALIFICATION_WORKEXPERIENCE.'</td>';
                          echo '<td class="mailbox-date">'.$result->DATEPOSTED.'</td>';
                          echo '</tr>';
                        }
                    ?> 
                  </tbody>
                </table>
               
              </div>
              
            </div>
           
          </div>
        
        </div>
       
      </div>
      
    </section>
   
  </div>