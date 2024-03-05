<?php 
	  if (!isset($_SESSION['USERID'])){
      redirect("admin/index.php");
     } 
?>

<section id="feature" class="transparent-bg">
        <div class="container">
           <div class="center wow fadeInDown">
                 <h2 class="page-header">List of Users</h2>
            </div>
               
            <div class="row">
                <div class="features">
                	<div class="wow fadeInDown">
						<div class="row">
							<form action="controller.php?action=delete" Method="POST">  	 		
								<table id="example" class="table table-striped table-bordered table-hover"  style="font-size:12px" cellspacing="0">
								
								  <thead>
								  	<tr> 
								  		<th>
								  		 Autonumber</th> 
								  		  <th>Key</th>
								  		 <th width="10%" align="center">Action</th>
								  	</tr>	
								  </thead>  
								  <tbody>
								  	<?php 
								  		$mydb->setQuery("SELECT * FROM `tblautonumbers`");
								  		$cur = $mydb->loadResultList();

										foreach ($cur as $result) {
								  		echo '<tr>'; 
							  			echo '<td>' . $result->AUTOSTART.'' . $result->AUTOEND.'</td>';
							  			echo '<td>' . $result->AUTOKEY.'</td>';
								  		echo '<td align="center"><a title="Edit" href="index.php?view=edit&id='.$result->AUTOID.'" class="btn btn-info btn-xs  ">  <span class="fa fa-edit fw-fa"></a>
								  		     <a title="Delete" href="controller.php?action=delete&id='.$result->AUTOID.'" class="btn btn-danger btn-xs  ">  <span class="fa  fa-trash-o fw-fa "></a></td>';
								  		echo '</tr>';
								  	} 
								  	?>
								  </tbody>
									
								</table>
								     <div class="btn-group">
								  <a href="index.php?view=add" class="btn btn-default">New</a>
									<?php
									if($_SESSION['UROLE']=='Administrator'){
									; }?>
								</div>
			
			
							</form>
					    </div>
   					</div>
    			</div>
    		</div>
    	</div>
 </section>
	 		    
	 