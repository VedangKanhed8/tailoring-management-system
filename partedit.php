<?php
require_once('function.php');
dbconnect();
session_start();

if (!is_user()) {
	redirect('index.php');
}

?>

		

<?php
 $user = $_SESSION['username'];
$usid = $pdo->query("SELECT id FROM users WHERE username='".$user."'");
$usid = $usid->fetch(PDO::FETCH_ASSOC);
 $uid = $usid['id'];
 include ('header.php');
 ?>



 
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Edit Measurement Part</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                
                <div class="col-md-10 col-md-offset-1">
				
				
	

		<?php
$eid = $_GET["id"];

if($_POST)
{

$type = $_POST["type"];
$title = $_POST["title"];
$detail = $_POST["detail"];


if ($_FILES['bgimg']['name']){
// IMAGE UPLOAD //////////////////////////////////////////////////////////
	$folder = "img/part/";
	$extention = strrchr($_FILES['bgimg']['name'], ".");
	$bgimg = $_FILES['bgimg']['name'];
	//$bgimg = $new_name.'.jpg';
	$uploaddir = $folder . $bgimg;
	move_uploaded_file($_FILES['bgimg']['tmp_name'], $uploaddir);
//////////////////////////////////////////////////////////////////////////


///////////////////////-------------------->> Catid  ki 0??
$error = 0;




	
$res = $pdo->exec("UPDATE `part` SET `type`='".$type."',`title`='".$title."', description='".$detail."', image='".$bgimg."' WHERE id='".$eid."'");
}
else{
	$res = $pdo->exec("UPDATE `part` SET `type`='".$type."',`title`='".$title."', description='".$detail."' WHERE id='".$eid."'");
}

	if($res){
		echo "<div class='alert alert-success alert-dismissable'>
	<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>	
	
	UPDATED Successfully!
	
	</div>";
	}else{
		echo "<div class='alert alert-danger alert-dismissable'>
	<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>	
	
	Some Problem Occurs, Please Try Again. 
	
	</div>";
	} 
}
?>
		


	 <script>
  $(function() {
    $( "#datepicker" ).datepicker();
  });
  </script>		
				
<?php
$oldd = $pdo->query("SELECT type, title, description, image FROM part WHERE id='".$eid."'");
$old = $oldd->fetch(PDO::FETCH_ASSOC)
?>				
				
				
				
				    <form action="partedit?id=<?php echo $eid ?>" method="post" enctype="multipart/form-data">
					<div class="card" style="width:500px;height:550px;background-color:white;padding: 40px;border-radius:10px;box-shadow: 2px 4px 14px 12px rgba(0,0,0,0.12);
-webkit-box-shadow: 2px 4px 14px 12px rgba(0,0,0,0.12);
-moz-box-shadow: 2px 4px 14px 12px rgba(0,0,0,0.12);">   
        
                    <div class="form-group">
					
					<label>Select Measurment Type</label>
					
					<select name="type"  class="form-control" style="width:100%">
                    <?php

					$details = $pdo->query("SELECT title FROM type WHERE id='".$old['type']."'");
					$details = $details->fetch(PDO::FETCH_ASSOC);
					echo ("<option value='$old[type]'>$details[title]</option> ");
					?>
					<option value="0">Please Select Type</option>
					<?php

						$ddaa = $pdo->query("SELECT id, title FROM type ORDER BY id");
							
							while ($data = $ddaa->fetch(PDO::FETCH_ASSOC))
							{									
						 echo "<option value='$data[id]'>$data[title]</option>";
							}
						?>
					
					</select><br/>

</div>
                
                <div class="form-group">
					
					<label>Measurement Name</label><br/>
                 	<input type="text" style="width:100%" name="title" style="width:100%; height: 40px;" value="<?php echo($old['title']) ?>" /><br/><br/>
				</div>
					
				<div class="form-group">
                  <label class="col-sm-3 control-label">Description</label><br/><br/>
				  <textarea name="detail" style="width:420px" class="form-control"> <?php echo($old['description']) ?></textarea>
                </div>
			
              	<div class="form-group">
                  <label class="col-sm-3 control-label">Image</label><br/><br/>
				  <img src="<?php echo('img/part/'.$old['image'])?>" width="200px" /><br/><br/>
                  <br/>
                  <input name="bgimg" style="width:100%" type="file" id="bgimg" />
                </div>
				
				
					<input type="submit"  style="width:100%" class="btn btn-lg btn-success btn-block" value="Update">
			    	</form>
                </div>
						
						
						
						
						
				
            </div>
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->
	    



<script src="js/bootstrap-timepicker.min.js"></script>


<script>
jQuery(document).ready(function(){
    
  
  jQuery("#ssn").mask("999-99-9999");
  
  // Time Picker
  jQuery('#timepicker').timepicker({defaultTIme: false});
  jQuery('#timepicker2').timepicker({showMeridian: false});
  jQuery('#timepicker3').timepicker({minuteStep: 15});

  
});
</script>







<?php
 include ('footer.php');
 ?>