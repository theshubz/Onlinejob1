 <!DOCTYPE html>
<html lang="en">
<head>
<title>Opportunity Junction  </title>


<link href="plugins/home-plugins/css/bootstrap.min.css" rel="stylesheet" />
<link href="plugins/home-plugins/css/fancybox/jquery.fancybox.css" rel="stylesheet"> 
<link href="plugins/home-plugins/css/flexslider.css" rel="stylesheet" /> 
<link href="plugins/home-plugins/css/style.css" rel="stylesheet" />
 
<link rel="stylesheet" href="plugins/font-awesome/css/font-awesome.min.css"> 

<link rel="stylesheet" href="plugins/dataTables/jquery.dataTables.min.css"> 
<link rel="stylesheet" href="plugins/dataTables/jquery.dataTables_themeroller.css"> 

<link href="plugins/datepicker/bootstrap-datetimepicker.min.css" rel="stylesheet" media="screen">
<link href="plugins/datepicker/datepicker3.css" rel="stylesheet" media="screen">
 

<style type="text/css">

.flexslider .slides img {
    max-height: 950px; 
    max-width: 1700px; 
}

  #content {
    min-height: 400px;
    color: #000;
  }
  
  .contentbody p {
    font-weight: bold;
  }
  .login a:hover{ 
    color: #00bcd4;
    text-decoration: none;

  }
  .login a:focus{ 
    color: #00bcd4;
    text-decoration: none;

  }
  .login a { 
     font-size: 14px;
    color: #fff;
    padding:0px;
  }
</style>

</head>
<body>
<div id="wrapper" class="home-page">
 
  
  <header>
        <div class="topbar navbar-fixed-top">
          <div class="container">
            <div class="row">
              <div class="col-md-12">      
                <p class="pull-left hidden-xs"><i class="fa fa-phone"></i><b>Contact no. (+91) 9975616377</b></p>
                <?php
require_once('include/database.php');
if (isset($_SESSION['APPLICANTID'])) { 
    $sql = "SELECT count(*) as 'COUNTNOTIF' FROM `tbljob` ORDER BY `DATEPOSTED` DESC";
    $result = mysqli_query($mydb, $sql);
    $showNotif = mysqli_fetch_object($result);
    $notif = isset($showNotif->COUNTNOTIF) ? $showNotif->COUNTNOTIF : 0;

    $applicant = new Applicants();
    $appl  = $applicant->single_applicant($_SESSION['APPLICANTID']);

    $sql = "SELECT count(*) as 'COUNT' FROM `tbljobregistration` WHERE `PENDINGAPPLICATION` = 0 AND `HVIEW` = 0 AND `APPLICANTID` = '{$appl->APPLICANTID}'";
    $result = mysqli_query($mydb, $sql);
    $showMsg = mysqli_fetch_object($result);
    $msg = isset($showMsg->COUNT) ? $showMsg->COUNT : 0;

    echo '<p class="pull-right login"> | <a title="View Message(s)" href="' . web_root . 'applicant/index.php?view=message"> <i class="fa fa-envelope-o"></i> <span class="label label-success">' . $msg . '</span></a> | <a title="View Profile" href="' . web_root . 'applicant/"> <i class="fa fa-user"></i>'. $appl->FNAME. ' '.$appl->LNAME .' </a> | <a href="' . web_root . 'logout.php">  <i class="fa fa-sign-out"> </i>Logout</a> </p>';
} else { 
    // Your code for non-logged-in users
}
?>

                      <p   class="pull-right login"><a data-target="#myModal" data-toggle="modal" href=""> <i class="fa fa-lock"></i><b> Login</b> </a></p>
               
              
              </div>
            </div>
          </div>
        </div> 
        <div style="min-height: 30px;"></div>
        <div class="navbar navbar-default navbar-static-top" > 
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="index.php"><b>OPPORTUNITY&nbsp;JUNCTION<b></a>
                </div>
                <div class="navbar-collapse collapse ">
                    <ul class="nav navbar-nav">
                        <li class="<?php echo !isset($_GET['q'])? 'active' :''?>"><a href="index.php"><h5>Home</h5></a></li> 
                        <li class="<?php  if(isset($_GET['q'])) { if($_GET['q']=='About'){ echo 'active'; }else{ echo ''; }}  ?>"><a href="index.php?q=About"><h4>About Us<h4></a></li>

						<li class="<?php  if(isset($_GET['q'])) { if($_GET['q']=='hiring'){ echo 'active'; }else{ echo ''; }} ?>"><a href=">index.php?q=hiring"><h4>Hiring Now</h4></a></li>

                      <li class="dropdown <?php  if(isset($_GET['q'])) { if($_GET['q']=='category'){ echo 'active'; }else{ echo ''; }}  ?>">
                          <a href="#" data-toggle="dropdown" class="dropdown-toggle"><h5>Popular Jobs </h5><b class="caret"></b></a>
                          <ul class="dropdown-menu">
                          
                          <?php 
require_once('include/database.php');

$sql = "SELECT * FROM `tblcategory` LIMIT 10";

// Execute the query
$result = mysqli_query($mydb, $sql);

if ($result) {
    // Check the number of rows returned by the query
    $num_rows = mysqli_num_rows($result);

    if ($num_rows > 0) {
        // Process each row of the result set
        while ($row = mysqli_fetch_assoc($result)) {
            // Process each row of the result set
            if (isset($_GET['search']) && $row['CATEGORY'] == $_GET['search']) {
                $viewresult = '<li class="active"><a href="index.php?q=category&search='.$row['CATEGORY'].'">'.$row['CATEGORY'].' Jobs</a></li>';
            } else {
                $viewresult = '<li><a href="index.php?q=category&search='.$row['CATEGORY'].'">'.$row['CATEGORY'].' Jobs</a></li>';
            }
            echo $viewresult;
        }
    } else {
        echo "No results found.";
    }
} else {
    // Error handling if the query fails
    echo "Error: " . mysqli_error($mydb);
}
?>



                          </ul>
                       </li> 
                        <li class="<?php  if(isset($_GET['q'])) { if($_GET['q']=='company'){ echo 'active'; }else{ echo ''; }}  ?>"><a href="index.php?q=company"><h4>Company</h4></a></li>
                        <li class="dropdown">
                          <a href="#" data-toggle="dropdown" class="dropdown-toggle"><h5>Job Search</h5> <b class="caret"></b></a>
                          <ul class="dropdown-menu">
                              <li><a href="index.php?q=search-company">Job By Company</a></li>
                          
                              <li><a href="index.php?q=search-jobtitle">Job By Title</a></li>
                         
                          </ul>
                       </li> 
                    </ul>
                </div>
            </div>
        </div>
  </header>
 

  <?php
    if (!isset($_SESSION['APPLICANTID'])) { 
      include("login.php");
    }
  ?>
      <?php

      if (isset($_GET['q'])) {
        
        echo '<section id="inner-headline">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <h2 class="pageTitle">'.$title.'</h2>
                    </div>
                </div>
            </div>
            </section>';
      }


       require_once $content;

        ?>   
 

  <footer>
  <div class="container">
    <div class="row">
      <div class="col-md-4 col-sm-4">
        <div class="widget">
          <h5 class="widgetheading">Contact US</h5>
          <address>
          <strong>Our Company</strong><br>
          Pune Main Road, Near Warje<br>
           Pin-411058 INDIA.</address>
          <p>
            <i class="icon-phone"></i> 91+ 9975616377 <br>
            <i class="icon-envelope-alt"></i> shubhamjadhav7718@gmail.com
          </p>
        </div>
      </div>
      <div class="col-md-4 col-sm-4">
        <div class="widget">
          <h4 class="widgetheading">Quick Links</h4>
          <ul class="link-list">
            <li><a href="index.php">Home</a></li>
            <li><a href="index.php?q=company">Company</a></li>
            <li><a href="index.php?q=hiring">Hiring</a></li>
            <li><a href="index.php?q=About">About us</a></li>
          </ul>
        </div>
      </div>
      <div class="col-md-4 col-sm-4">
        <div class="widget">
          <h4 class="widgetheading">Latest posts</h4>
          <ul class="link-list">
          <?php
$mydb = new mysqli('opportunityjunction.mysql.database.azure.com', 'shubhamj', 'omkar@29', 'erisdb');

if ($mydb->connect_errno) {
    echo "Failed to connect to MySQL: " . $mydb->connect_error;
    exit();
}

$sql = "SELECT c.*, j.* FROM `tblcompany` c INNER JOIN `tbljob` j ON c.`COMPANYID` = j.`COMPANYID` ORDER BY j.`DATEPOSTED` DESC LIMIT 3";
$result = $mydb->query($sql);

if ($result) {
    while ($row = $result->fetch_assoc()) {
        echo '<li><a href="index.php?q=viewjob&search=' . $row['JOBID'] . '">' . $row['COMPANYNAME'] . ' / ' . $row['OCCUPATIONTITLE'] . '</a></li>';
    }
} else {
    echo "Error: " . $mydb->error;
}

// Close the database connection
$mydb->close();
?>

          </ul>
        </div>
      </div>

    </div>
  </div>
  <div id="sub-footer">
    <div class="container">
      <div class="row">
        <div class="col-lg-6">
          <div class="copyright">
            <p>
              <span>&copy; 2024 OPPORTUNITY JUNCTION DONE BY SHUBHAM  
            </p>
          </div>
        </div>
       
      </div>
    </div>
  </div>
  </footer>
</div>

<script src="plugins/home-plugins/js/jquery.js"></script>
<script src="plugins/home-plugins/js/jquery.easing.1.3.js"></script>
<script src="plugins/home-plugins/js/bootstrap.min.js"></script>
 

<script type="text/javascript" src="plugins/dataTables/dataTables.bootstrap.min.js" ></script>  
<script src="plugins/datatables/jquery.dataTables.min.js"></script> 

<script type="text/javascript" src="plugins/datepicker/bootstrap-datepicker.js" charset="UTF-8"></script>
<script type="text/javascript" src="plugins/datepicker/bootstrap-datetimepicker.js" charset="UTF-8"></script>
<script type="text/javascript" src="plugins/datepicker/locales/bootstrap-datetimepicker.uk.js" charset="UTF-8"></script>

<script type="text/javascript" language="javascript" src="plugins/input-mask/jquery.inputmask.js"></script> 
<script type="text/javascript" language="javascript" src="plugins/input-mask/jquery.inputmask.date.extensions.js"></script> 
<script type="text/javascript" language="javascript" src="plugins/input-mask/jquery.inputmask.extensions.js"></script> 

<script src="plugins/home-plugins/js/jquery.fancybox.pack.js"></script>
<script src="plugins/home-plugins/js/jquery.fancybox-media.js"></script>  
<script src="plugins/home-plugins/js/jquery.flexslider.js"></script>
<script src="plugins/home-plugins/js/animate.js"></script>



<script src="plugins/home-plugins/js/modernizr.custom.js"></script>
<script src="plugins/home-plugins/js/jquery.isotope.min.js"></script>
<script src="plugins/home-plugins/js/jquery.magnific-popup.min.js"></script>
<script src="plugins/home-plugins/js/animate.js"></script>
<script src="plugins/home-plugins/js/custom.js"></script> 


 <script type="text/javascript">
   
     $(function () {
    $("#dash-table").DataTable();
    $('#dash-table2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false
    });
  });


     $("#btnlogin").click(function(){
        var username = document.getElementById("user_email");
        var pass = document.getElementById("user_pass");

        
        if(username.value=="" && pass.value==""){   
          $('#loginerrormessage').fadeOut(); 
                $('#loginerrormessage').fadeIn();  
                $('#loginerrormessage').css({ 
                        "background" :"red",
                        "color"      : "#fff",
                        "padding"    : "5px;"
                    }); 
          $("#loginerrormessage").html("Invalid Username and Password!");
       
        }else{

          $.ajax({    
              type:"POST",  
              url: "process.php?action=login",    
              dataType: "text",  
              data:{USERNAME:username.value,PASS:pass.value},               
              success: function(data){   
               
                $('#loginerrormessage').fadeOut(); 
                $('#loginerrormessage').fadeIn();  
                $('#loginerrormessage').css({ 
                        "background" :"red",
                        "color"      : "#fff",
                        "padding"    : "5px;"
                    }); 
               $('#loginerrormessage').html(data);   
              } 
              }); 
          }
        });


$('input[data-mask]').each(function() {
  var input = $(this);
  input.setMask(input.data('mask'));
});


$('#BIRTHDATE').inputmask({
  mask: "2/1/y",
  placeholder: "mm/dd/yyyy",
  alias: "date",
  hourFormat: "24"
});
$('#HIREDDATE').inputmask({
  mask: "2/1/y",
  placeholder: "mm/dd/yyyy",
  alias: "date",
  hourFormat: "24"
});

$('.date_picker').datetimepicker({
  format: 'mm/dd/yyyy',
  startDate : '01/01/1950', 
  language:  'en',
  weekStart: 1,
  todayBtn:  1,
  autoclose: 1,
  todayHighlight: 1, 
  startView: 2,
  minView: 2,
  forceParse: 0 

});
 </script>
 
</body>
</html>
 