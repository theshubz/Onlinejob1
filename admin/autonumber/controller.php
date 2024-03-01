
<?php
require_once ("../../include/initialize.php");
 	 if (!isset($_SESSION['USERID'])){
      redirect(web_root."admin/index.php");
     }


$action = (isset($_GET['action']) && $_GET['action'] != '') ? $_GET['action'] : '';

switch ($action) {
	case 'add' :
	doInsert();
	break;
	
	case 'edit' :
	doEdit();
	break;
	
	case 'delete' :
	doDelete();
	break;

 
	}
   
	function doInsert(){
		if(isset($_POST['save'])){


		if ( $_POST['AUTOSTART'] == "" ) {
			$messageStats = false;
			message("All field is required!","error");
			redirect('index.php?view=add');
		}else{	
			$autonumber = New Autonumber();
			$autonumber->AUTOSTART	= $_POST['AUTOSTART'];
			$autonumber->AUTOINC	= $_POST['AUTOINC'];
			$autonumber->AUTOEND	= $_POST['AUTOEND'];
			$autonumber->AUTOKEY	= $_POST['AUTOKEY'];
			$autonumber->create();

			message("New Autonumber created successfully!", "success");
			redirect("index.php");
			
		} 
		}

	}

	function doEdit(){
		if(isset($_POST['save'])){

			$autonumber = New Autonumber();
			$autonumber->AUTOSTART	= $_POST['AUTOSTART'];
			$autonumber->AUTOINC	= $_POST['AUTOINC'];
			$autonumber->AUTOEND	= $_POST['AUTOEND'];
			$autonumber->AUTOKEY	= $_POST['AUTOKEY'];
			$autonumber->update($_POST['AUTOID']);

			message(" Autonumber has been updated!", "success");
			redirect("index.php");
		}

	}


	function doDelete(){
		

			$id = $_GET['id'];

			$autonumber = New Autonumber();
			$autonumber->delete($id);

			message("autonumber already Deleted!","info");
			redirect('index.php');

	
		
	}
?>