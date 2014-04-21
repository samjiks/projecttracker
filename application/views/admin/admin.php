<script>
$(document).ready(function(){
	$('.cproject').click(function(){


	});

	$('.lproject').click(function(){
		$('.content-header').empty();
		$('.content-header').append("LIST PROJECT");
		$('.project').empty();
		$('.project').append("<p></p>");
		$('.project').load('<?php echo base_url(); ?>index.php/project/assign_project');

	});
	
	$('.assignproject').click(function(){


	});
});

</script>
<?php
	$session_id = $this->session->userdata('session_id');

	if(!isset($session_id)){
			redirect(base_url().'index.php/user/login');
	}else{
		echo "<p class='alert' id='uname'  style='float: right'>Welcome,"?><?php  if(isset($col_username)){ echo $col_username; } "</p>";
		echo "<script> $( '.login' ).css( 'display', function( index ) { index = 'none'; return index; });</script>";
	    echo "<script> $( '.logout' ).css( 'display', function( index ) { index = ''; return index; });</script>";
	}
?>
 <div id="page-content-wrapper">
			 <div class="page-content inset">
				   <h4 class="content-header">CREATE PROJECT</h4>  
				     <div class="row">           
						 <div class="col-md-9 col-md-offset-2" >
							<div class="project" >
							 <?php echo form_open("project/create_project_submit") ?>
			   		   		       <label> Project Name: </label>
							        <input type="textbox" name="projectname"  placeholder="Create Project Name" >
							        <br/>
							        <label> Project Desription: </label>
							        <textarea type="textbox" name="projectdescription"  placeholder="Enter Project Description" ></textarea><br/>
							        <input class="btn btn-large" type="submit" name="submit" value="Register" type="submit" required autofocus>
							  </form>
							 </div>
							</div>
						</div>
					</div>
				</div>
</div>
