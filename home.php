  <section id="banner">
   
 
        <div id="main-slider" class="flexslider">
            <ul class="slides">
              <li>
                <img src="plugins/home-plugins/img/slides/1.jpg" alt="" />
                <div class="flex-caption">
                    
          <h3>Unlock Your Potential, Find Your Future!</h3> 
           
                </div>
              </li>
              <li>
                <img src="plugins/home-plugins/img/slides/2.jpg" alt="" />
                <div class="flex-caption">
                    <h3>Your Gateway to Professional Success.</h3> 
          <p>Success depends on work</p> 
           
                </div>
              </li>
            </ul>
        </div>
 
 
  </section> 
  <section id="call-to-action-2" style="background-color: grey;">
    <div class="container">
      <div class="row">
        <div class="col-md-10 col-sm-9">
          <h3 style="background-color: grey; color: white;">Navigate Your Career Path, Online</h3>
		  <p style="background-color: grey; color: white;">Welcome to the Opportunity Junction where career opportunities! Dive into a world of endless possibilities as you browse through our curated job listings, connect with industry leaders, and unleash your potential.
		  Our user-friendly interface, comprehensive job listings, and cutting-edge search filters streamline your search process. Start exploring, start applying, and let your career soar to new heights with us.</p>
             
		</div>
      
      </div>
    </div>
  </section>
  
  <section id="content">
  
  
  <div class="container">
        <div class="row">
      <div class="col-md-12">
        <div class="aligncenter"><h2 class="aligncenter">Company</h2></div>
        <br/>
      </div>
    </div>

    <?php 
                              $mydb = new mysqli('opportunityjunction.mysql.database.azure.com', 'shubhamj', 'omkar@29', 'erisdb');

      $sql = "SELECT * FROM `tblcompany`";
      $mydb->query($sql);
      $comp = $mydb->loadResultList();


      foreach ($comp as $company ) {
    
    
    ?>
            <div class="col-sm-4 info-blocks">
                <i class="icon-info-blocks fa fa-building-o"></i>
                <div class="info-blocks-in">
                    <h3><?php echo $company->COMPANYNAME;?></h3>
                    <!-- <p><?php echo $company->COMPANYMISSION;?></p> -->
                    <p>Address :<?php echo $company->COMPANYADDRESS;?></p>
                    <p>Contact No. :<?php echo $company->COMPANYCONTACTNO;?></p>
                </div>
            </div>

    <?php } ?> 
  </div>
  </section>
  
  <section class="section-padding gray-bg">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="section-title text-center">
            <h2 >Popular Jobs</h2>  
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12 ">
          <?php                           $mydb = new mysqli('opportunityjunction.mysql.database.azure.com', 'shubhamj', 'omkar@29', 'erisdb');

            $sql = "SELECT * FROM `tblcategory`";
            $mydb->setQuery($sql);
            $cur = $mydb->loadResultList();

            foreach ($cur as $result) {
              echo '<div class="col-md-3" style="font-size:15px;padding:5px">* <a href="'.web_root.'index.php?q=category&search='.$result->CATEGORY.'">'.$result->CATEGORY.'</a></div>';
            }

          ?>
        </div>
      </div>
 
    </div>
  </section>    
  <section id="content-3-10" class="content-block data-section nopad content-3-10">
  <div class="image-container col-sm-6 col-xs-12 pull-left">
    <div class="background-image-holder">

    </div>
  </div>

</section>
  
                
              </div>
              
              
            </div>
            
                        
             
            <br>
           
            </div>
            
          </div>