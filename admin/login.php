<?php
require_once("../include/initialize.php");

 ?>
  <?php
  if(isset($_SESSION['ADMIN_USERID'])){
    redirect(web_root."admin/index.php");
  }
  ?>
   
 <!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Admin | Log in</title>
  
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

  <link rel="stylesheet" href="<?php echo web_root;?>bootstrap/css/bootstrap.min.css">
 
  <link rel="stylesheet" href="<?php echo web_root;?>plugins/font-awesome/css/font-awesome.min.css"> 
  
  <link rel="stylesheet" href="<?php echo web_root;?>dist/css/AdminLTE.min.css">

  <link rel="stylesheet" href="<?php echo web_root;?>plugins/iCheck/square/blue.css">


</head>
<body class="hold-transition login-page">
<div class="login-box">

  <div class="login-box-body" style="min-height: 400px;">
    <h1 class="login-box-msg">Admin LOGIN</h1>
    <hr/>
    <p><?php check_message(); ?></p>

    <form action="" method="post">
      <div class="form-group has-feedback">
        <input type="text" class="form-control" placeholder="Username" name="user_email">
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" class="form-control" placeholder="Password" name="user_pass">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
        <div class="row">
        
        <div class="col-xs-4">
          <button type="submit" name="btnLogin" class="btn btn-primary btn-block btn-flat">Sign In</button>
        </div>
      </div>
       
      </div>
    </form>

   



  </div>
  
</div>

<?php 

if(isset($_POST['btnLogin'])){
  $email = trim($_POST['user_email']);
  $upass  = trim($_POST['user_pass']);
  $h_upass = sha1($upass);
  
   if ($email == '' OR $upass == '') {

      message("Invalid Username and Password!", "error");
      redirect("login.php");
         
    } else {  
 
    $user = new User();
    $res = $user->userAuthentication($email, $h_upass);
    if ($res==true) { 
       message("You logon as ".$_SESSION['ROLE'].".","success");

        $_SESSION['ADMIN_USERID'] = $_SESSION['USERID'];
        $_SESSION['ADMIN_FULLNAME'] = $_SESSION['FULLNAME'] ;
        $_SESSION['ADMIN_USERNAME'] =$_SESSION['USERNAME'];
        $_SESSION['ADMIN_ROLE'] = $_SESSION['ROLE'];
     

        unset( $_SESSION['USERID'] );
        unset( $_SESSION['FULLNAME'] );
        unset( $_SESSION['USERNAME'] );
        unset( $_SESSION['PASS'] );
        unset( $_SESSION['ROLE'] );
       

         redirect(web_root."admin/index.php");
      // } 
    }else{
      message("Account does not exist! Please contact Administrator.", "error");
       redirect(web_root."admin/login.php"); 
    }
 }
 } 
 ?> 


<script src="<?php echo web_root;?>plugins/jQuery/jQuery-2.1.4.min.js"></script>
<script src="<?php echo web_root;?>bootstrap/js/bootstrap.min.js"></script>
<script src="<?php echo web_root;?>plugins/iCheck/icheck.min.js"></script>
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' 
    });
  });
</script>
</body>
</html>

 


 


