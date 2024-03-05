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
require_once('include/database.php');

// Assuming you have a database connection object $mydb from database.php

$sql = "SELECT * FROM `tblcompany`";
$mydb->setQuery($sql);
$compResult = $mydb->query();

if ($compResult) {
while ($company = $compResult->fetch_object()) {
   // Your HTML rendering for each company goes here
?>
   <div class="col-sm-4 info-blocks">
       <i class="icon-info-blocks fa fa-building-o"></i>
       <div class="info-blocks-in">
           <h3><?php echo $company->COMPANYNAME;?></h3>
           <p>Address: <?php echo $company->COMPANYADDRESS;?></p>
           <p>Contact No.: <?php echo $company->COMPANYCONTACTNO;?></p>
       </div>
   </div>
<?php
}
} else {
echo "Error executing query: " . $mydb->error;
}
?>

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
    <?php 
require_once('database.php');



$sql = "SELECT * FROM `tblcategory`";
$mydb->setQuery($sql);
$curResult = $mydb->query();

if ($curResult) {
while ($result = $curResult->fetch_object()) {
   echo '<div class="col-md-3" style="font-size:15px;padding:5px">* <a href="index.php?q=category&search='.$result->CATEGORY.'">'.$result->CATEGORY.'</a></div>';
}
} else {
echo "Error executing query: " . $mydb->error;
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