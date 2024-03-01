<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title><?php
               
            ?>
        </title>
       <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <link rel="stylesheet" href="<?php echo web_root;?>bootstrap/css/bootstrap.min.css">

        <?php echo web_root;?>
       <?php echo web_root;?>

        
        <link rel="stylesheet" href="<?php echo web_root;?>dist/css/AdminLTE.min.css">
      
        <link rel="stylesheet" href="<?php echo web_root;?>dist/css/skins/_all-skins.min.css">
        
        <link rel="stylesheet" href="<?php echo web_root;?>plugins/iCheck/flat/blue.css">
        
        <link rel="stylesheet" href="<?php echo web_root;?>plugins/morris/morris.css">
        
        <link rel="stylesheet" href="<?php echo web_root;?>plugins/jvectormap/jquery-jvectormap-1.2.2.css">
        <link href="<?php echo web_root; ?>plugins/datepicker/bootstrap-datetimepicker.min.css" rel="stylesheet" media="screen">

        <link rel="stylesheet" href="<?php echo web_root;?>plugins/dataTables/jquery.dataTables.min.css">  

        <?php echo web_root;?>
       <?php echo web_root;?>
        
        <link rel="stylesheet" href="<?php echo web_root;?>plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
 
    </head>

 <body class="hold-transition skin-blue fixed sidebar-mini">
<div class="wrapper">

  <header class="main-header">
    <a href="<?php echo web_root;?>/admin/" class="logo">
      <span class="logo-mini"><b></b></span>
      <span class="logo-lg"><b>Admin Dashboard</b></span>
    </a>
    <nav class="navbar navbar-static-top" role="navigation">
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
 
          <?php
              $user = New User();
              $singleuser = $user->single_user($_SESSION['ADMIN_USERID']);

          ?>
          <li class="dropdown user user-menu" style="padding-right: 15px;"  >
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="<?php echo web_root.'admin/user/'. $singleuser->PICLOCATION;?>" class="user-image" alt="User Image">
              <span class="hidden-xs"><?php echo $singleuser->FULLNAME; ?></span>
            </a>
            <ul class="dropdown-menu">
              <li class="user-header"> 
                <img data-target="#menuModal"  data-toggle="modal"  src="<?php echo web_root.'admin/user/'. $singleuser->PICLOCATION;?>" class="img-circle" alt="User Image" />  
              </li> 
              <li class="user-footer">
                <div class="pull-left">
                  <a href="<?php echo web_root.'admin/user/index.php?view=view&id='.$_SESSION['ADMIN_USERID'] ;?>" class="btn btn-default btn-flat">Profile</a>
                </div>
                <div class="pull-right">
                  <a href="<?php echo web_root ;?>admin/logout.php" class="btn btn-default btn-flat">Sign out</a>
                </div>
              </li>
            </ul>
          </li>
          
        </ul>
      </div>
    </nav>
  </header>



 <div class="modal fade" id="menuModal" tabindex="-1">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button class="close" data-dismiss="modal" type=
                                    "button">x</button>

                                    <h4 class="modal-title" id="myModalLabel">Image.</h4>
                                </div>

                                <form action="<?php echo web_root; ?>admin/user/controller.php?action=photos" enctype="multipart/form-data" method=
                                "post">
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <div class="rows">
                                                <div class="col-md-12">
                                                    <div class="rows">
                                                        <div class="col-md-8"> 
                                                            <input class="mealid" type="hidden" name="mealid" id="mealid" value="">
                                                              <input name="MAX_FILE_SIZE" type="hidden" 
                                                              value="1000000"> 
                                                              <input id="photo" name="photo" type="file">
                                                        </div>

                                                        <div class="col-md-4"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="modal-footer">
                                        <button class="btn btn-default" data-dismiss="modal" type=
                                        "button">Close</button> <button class="btn btn-primary"
                                        name="savephoto" type="submit">Upload Photo</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>  



  <aside class="main-sidebar">
    <section class="sidebar">
      
 
      <ul class="sidebar-menu"> 
        <li  class="<?php echo (currentpage() == 'index.php') ? "active" : false;?>" >
          <a href="<?php echo web_root ;?>admin/">
            <i class="fa fa-dashboard"></i> <span><h4>Dashboard<h4></span>  
          </a> 
        </li> 
        <li class="<?php echo (currentpage() == 'company') ? "active" : false;?>" >
          <a href="<?php echo web_root ;?>admin/company/">
            <i class="fa fa-building"></i> <span><h4>Company</h4></span> 
          </a>
        </li>
        <li class="<?php echo (currentpage() == 'vacancy') ? "active" : false;?>" >
          <a href="<?php echo web_root ;?>admin/vacancy/">
            <i class="fa fa-suitcase"></i> <span><h4>Vacancy</h4></span> 
          </a>
        </li>
        <li class="<?php echo (currentpage() == 'employee') ? "active" : false;?>" >
          <a href="<?php echo web_root ;?>admin/employee/">
            <i class="fa fa-users"></i> <span><h4>Employee</h4></span> 
          </a>
        </li> 
        <li class="<?php echo (currentpage() == 'applicants') ? "active" : false;?>" > 
          <a href="<?php echo web_root ;?>admin/applicants/">
            <i class="fa fa-users"></i> <span><h4>Applicants</h4></span> 
            <span class="label label-primary pull-right">
              <?php
                $sql = "SELECT count(*) as 'APPL' FROM `tbljobregistration` WHERE `PENDINGAPPLICATION`=1";
                $mydb->setQuery($sql);
                $pending = $mydb->loadSingleResult();
                echo $pending->APPL;
              ?>
            </span>
          </a>
        </li> 
        <li class="<?php echo (currentpage() == 'category') ? "active" : false;?>" > 
          <a href="<?php echo web_root ;?>admin/category/">
            <i class="fa fa-list"></i> <span>Category</span>  
          </a>
        </li> 

         <li class="<?php echo (currentpage() == 'user') ? "active" : false;?>">
          <a href="<?php echo web_root; ?>admin/user/">
            <i class="fa fa-user"></i> <span>Manage Users</span> </a>
        </li>
        
      </ul>
    </section>
  </aside>
  <div class="content-wrapper">

  <section class="content-header">
      <h1>
        <?php echo isset($title) ? $title : ''; ?>
      </h1>
      <ol class="breadcrumb">
        <?php

          if ($title!='Home') {
            $active_title = '';
            if (isset($_GET['view'])) {
              $active_title = '<li class='.$active_title.'><a href="index.php">'.$title.'</a></li>';
            }else{
              $active_title = '<li class='.$active_title.'>'.$title.'</li>';
            }
            echo '<li><a href='.web_root.'admin/><i class="fa fa-dashboard"></i> Home</a></li>';
            echo  $active_title;
            echo  isset($_GET['view']) ? '<li class="active">'.$_GET['view'].'</li>' : '';
          } 


        ?>
      </ol>
    </section>
         <section class="content">

          <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-body">

              <?php 
               check_message();
               require_once $content; 
               ?> 
             </div>
             </div>
           </div>
         </div>
         </section>
 </div>


  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b></b>
    </div>
    <strong>&copy; 2024 OPPORTUNITY JUNCTION DONE BY SHUBHAM  
  </footer>

  

    </body>
      <script type="text/javascript" src="<?php echo web_root; ?>plugins/jQuery/jQuery-2.1.4.min.js"> </script>
      <script type="text/javascript" src="<?php echo web_root; ?>bootstrap/js/bootstrap.min.js" ></script>
      <script src="<?php echo web_root;?>dist/js/app.min.js"></script> 

      <script type="text/javascript" src="<?php echo web_root; ?>plugins/datepicker/bootstrap-datepicker.js" ></script> 
      <script type="text/javascript" src="<?php echo web_root; ?>plugins/datepicker/bootstrap-datetimepicker.js" charset="UTF-8"></script>
      <script type="text/javascript" src="<?php echo web_root; ?>plugins/datepicker/locales/bootstrap-datetimepicker.uk.js" charset="UTF-8"></script>

      <script type="text/javascript" src="<?php echo web_root; ?>plugins/dataTables/dataTables.bootstrap.min.js" ></script> 
      <script src="<?php echo web_root; ?>plugins/datatables/jquery.dataTables.min.js"></script> 

      <script src="<?php echo web_root; ?>plugins/slimScroll/jquery.slimscroll.min.js"></script>

      <script type="text/javascript" language="javascript" src="<?php echo web_root; ?>plugins/input-mask/jquery.inputmask.js"></script> 
      <script type="text/javascript" language="javascript" src="<?php echo web_root; ?>plugins/input-mask/jquery.inputmask.date.extensions.js"></script> 
      <script type="text/javascript" language="javascript" src="<?php echo web_root; ?>plugins/input-mask/jquery.inputmask.extensions.js"></script> 



<script>
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
</html>
 