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



    <div class="pageheader">
      <h2><i class="fa fa-cog"></i> Manage Shop Document</h2>
    </div>

    
    <div class="contentpanel" style="box-shadow: 2px 4px 14px 12px rgba(0,0,0,0.12);
-webkit-box-shadow: 2px 4px 14px 12px rgba(0,0,0,0.12);
-moz-box-shadow: 2px 4px 14px 12px rgba(0,0,0,0.12);padding:10px">
      <div class="panel panel-default">

        <div class="panel-body">
		
		   
<?php

if($_POST)
{

$title = $_POST["title"];


$title = $_POST["title"];
$detail = $_POST["detail"];



// IMAGE UPLOAD /////////////// 
	$folder = "img/documents/"; 
	$bgimg =$_FILES['bgimg']['name'];
   
  $imageFileType = strtolower(pathinfo($bgimg,PATHINFO_EXTENSION));
   if($imageFileType=="jpg" ||$imageFileType =="png"||$imageFileType=="pdf" ||$imageFileType=="docx")
   { 
	$uploaddir = $folder . $bgimg;
	move_uploaded_file($_FILES['bgimg']['tmp_name'], $uploaddir);
//////////////////////////////////////////////////////////////////////////


$res = $pdo->exec("INSERT INTO documents SET title='".$title."', detail='".$detail."', img='".$bgimg."'");
 
	echo "<div class='alert alert-success alert-dismissable'>
<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>	

Added Successfully!

</div>";

}else{
	echo "<div class='alert alert-danger alert-dismissable'>
<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>	
 Extension are not allowed,please follow the extension png,jpg,pdf,docx 

</div>";
}
}


?>	
		
		
		
				
		<form name="" id="" action="" method="post" enctype="multipart/form-data" >
	            <div class="form-group">
                  <label class="col-sm-3 control-label">Document Title</label>
                  <div class="col-sm-6"><input name="title" value="" class="form-control" /></div><br/>
                </div>
                
                <div class="form-group">
                  <label class="col-sm-3 control-label">Document Description</label>
                  <div class="col-sm-6"><input name="detail" value="" class="form-control" /></div>
                </div>
			
              	<div class="form-group">
                  <label class="col-sm-3 control-label">Document Image</label>
                  <div class="col-sm-6"><input name="bgimg" type="file" id="bgimg" /></div>
                </div>
			  
		
		  
				<div class="col-sm-6 col-sm-offset-3"><br/>
				  <button class="btn btn-primary btn-block" style="width:200px; height: 40px;" name="upload">UPLOAD</button><br/><br/>
				</div>
			
			 
			 
          </form>
		  
		  
		  <div class="clearfix"></div>
		  
			
                 <div class="panel panel-default">
            
                    <div class="panel-body">
                    
                     <div class="clearfix mb30"></div>
            
                      <div class="table-responsive">
                      <table class="table table-striped" id="table2">

                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Title</th>
                                            <th>Document Description</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                     <tbody>		  
		  
		  				<?php

$ddaa = $pdo->query("SELECT id, title, detail, img FROM documents ORDER BY id");
    while ($data = $ddaa->fetch(PDO::FETCH_ASSOC))
    {
		
echo "                                 <tr>
                                            <td>$data[id]</td>
                                            <td>$data[title]</td>
											<td>$data[detail]</td>
                                   
                                            
											<td>
<a href='img/documents/$data[img]' class='btn btn-info btn-xs'>View</a>
<a class='btn btn-danger btn-xs' href='deldoc?id=$data[id]'>Delete</a>
";

echo "</td></tr>";
	}
?>
	 </tbody>
                                </table>
                            </div><!-- table-responsive -->
		  
        </div>
      </div>
                  
      

      
    </div><!-- contentpanel -->
    </div>
	
	
		  
                  
      

      
    </div><!-- contentpanel -->
    
  </div><!-- mainpanel -->

  
</section>


<?php
 include ('footer.php');
 ?>


<script src="js/bootstrap-timepicker.min.js"></script>


<script src="js/wysihtml5-0.3.0.min.js"></script>
<script src="js/bootstrap-wysihtml5.js"></script>
<script src="js/ckeditor/ckeditor.js"></script>
<script src="js/ckeditor/adapters/jquery.js"></script>



<script>
jQuery(document).ready(function(){
    
    "use strict";
    
  // HTML5 WYSIWYG Editor
  jQuery('#wysiwyg').wysihtml5({color: true,html:true});
  
  // CKEditor
  jQuery('#ckeditor').ckeditor();
  
  jQuery('#inlineedit1, #inlineedit2').ckeditor();
  
  // Uncomment the following code to test the "Timeout Loading Method".
  // CKEDITOR.loadFullCoreTimeout = 5;

  window.onload = function() {
  // Listen to the double click event.
  if ( window.addEventListener )
	document.body.addEventListener( 'dblclick', onDoubleClick, false );
  else if ( window.attachEvent )
	document.body.attachEvent( 'ondblclick', onDoubleClick );
  };

  function onDoubleClick( ev ) {
	// Get the element which fired the event. This is not necessarily the
	// element to which the event has been attached.
	var element = ev.target || ev.srcElement;

	// Find out the div that holds this element.
	var name;

	do {
		element = element.parentNode;
	}
	while ( element && ( name = element.nodeName.toLowerCase() ) &&
		( name != 'div' || element.className.indexOf( 'editable' ) == -1 ) && name != 'body' );

	if ( name == 'div' && element.className.indexOf( 'editable' ) != -1 )
		replaceDiv( element );
	}

	var editor;

	function replaceDiv( div ) {
		if ( editor )
			editor.destroy();
		editor = CKEDITOR.replace( div );
	}

	 jQuery('#timepicker').timepicker({defaultTIme: false});
  jQuery('#timepicker2').timepicker({showMeridian: false});
  jQuery('#timepicker3').timepicker({minuteStep: 15});

	
	
});



</script>
</body>
</html>



