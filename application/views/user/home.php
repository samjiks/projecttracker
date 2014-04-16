<script>
 $(function() {  
	 $('#activity-form').dialog({modal:true,autoOpen:false,width:600}); 
 	   $('.editprojecttask').click(function(e) {
 	       $('#activity-form').dialog('open');
       });
    });


$(document).ready(function(){
		$('.formactivity_button').click(function(event) {
			event.preventDefault();
			var data = $(this).closest('form').serialize();
			
			$.ajax({
				type: "post",
				cache: "false",
				url: "<?php echo base_url(); ?>index.php/project/create_activity",
				data: data,
				dataType: "json",
				success: function(response){
						if(response.length < 0){
						   $('#activityresponse').append("No Activities created");
						}
						$('#activityresponse').empty();
		  			 	for(x in response){
		  			       $('#activityresponse').append('<div>'+response[x].col_taskname+'</div>');
		  			 	}
				},
				error: function(jqXHR, textStatus, errorThrown){
					 $('#activityresponse').append(response);
    			    console.log("The following error occured: "+textStatus, errorThrown);
				}
			});
		});

		$( ".startdate,.enddate,.completeddate" ).datepicker({ dateFormat: 'dd-mm-yy'});


			  $('#projectlink').on("click", this, function (e) {
	    		var href = $(this).attr('href');
	    		e.preventDefault();
			  });

			$('.addtask').on("click", this, function (e) {
	
    				$(this).next().next().next().toggle('medium');
       		 });
	


		$('.formbutton').click(function(event){
			event.preventDefault()
				var data = $(this).closest('form').serialize();

			$.ajax({
				type: "post",
				cache: "false",
				url:  "<?php echo base_url(); ?>index.php/project/create_task",
				data: data,
				//dataType: "json",
	  			 success: function(response){
	  			 	if(!response){
	  			 		//$('#response').append("No Tasks created for this project");
	  			 		$('#response').append(response);
	  			 		exit;
	  			 	}
					$('#response').empty();
	  			 	for(x in response){
	  			 		$('#activityresponse').append('<div>'+response[x].col_taskname+'</div>');
	  			 	}
    			},
    			error: function(jqXHR, textStatus, errorThrown){
    				$('#response').append(response);
    			    console.log("The following error occured: "+textStatus, errorThrown);
   				 }
			});		  
		});
		

		//LIST TASK ANCHOR CLICK
		$('.listtask').click(function(e){
			
				//e.stoppropgation();
			//	alert("CLICK");
				//e.preventDefault(); 
				self = $(this);
				self.parent().find('.listresponse').toggle();
				var data = $(this).data('projectname');

			$.ajax({
					type: "POST",
					cache: "false",
					url: "<?php echo base_url(); ?>index.php/project/list_tasks",
					data : { 'projectname' : data },
					dataType: "json",
					success: function(response){
						console.log(response[0].col_enddate);						
						self.parent().find('.listresponse').html('<table class="table tbltsklist"><thead><tr><th>Task name</th><th>Start Date</th><th>End Date</th><th>Status</th><th>Percentage complete</th><th>Edit Task</th><th>Create Activity</th></tr></thead><tbody>');
						
						for(x in response){
							var item = "<tr><td>"+response[x].col_taskname+"</td><td>"+response[x].col_startdate+"</td><td>"+response[x].col_enddate+"</td><td>"+response[x].col_statustasks+"</td><td>"+response[x].col_percentage_complete+"</td><td><input type='button' class='edittask' value='Edit Task'></td><td><input type='button' class='createactivity' value='Create Activity'></td></tr>";
						 	self.parent().find('.listresponse .tbltsklist').append(item);
						 }	
 	       				self.parent().find('.listresponse').append("</tbody></table>");
 	       				
					},	
					error: function(jqXHR, textStatus, errorThrown){
					 $('#activityresponse').append(response);
    			    console.log("The following error occured: "+textStatus, errorThrown);
				}
				});
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
				   <h4 class="content-header"> <u>Projects</u></h4>  
				     <div class="row">           
						 <div class="col-md-12" >
						 <?php echo validation_errors(); ?>

							<div class="gui">
								<div id="listprojects">
						 		<?php
										foreach ($projectlist as $value) {
											foreach ($value as $values){
											    echo "<div class='projects'>";
												echo "<p class='loadalltasks' href='".base_url()."index.php/project/get_by_projectname/$values'>".strtoupper($values)."</p>";
												echo "<a class='addtask' data-projectname='$values'>Add Task</a>  ";
												echo "<a class='listtask' name='projectname' data-projectname='$values'>List Task</a>";
												echo "<div class='listresponse'  style='display:none'></div>";
												echo "<div class='panel' style='padding:10px; display:none'>
												<div id='response'></div>
												<form id ='form' class='form-horizontal' role='form'>
												 <div class='form-group'>
												  <label for='projectid' class='col-sm-3 control-label'>Project Name</label>
												    <div class='col-sm-9'>
												      <input type='text' class='form-control projectid' value='$values' name='projecthiddenid' id='projecthiddenid'>
												    </div>
												  </div>
												  <div class='form-group'>
												    <label for='taskname' class='col-sm-3 control-label'>Task Name</label>
												    <div class='col-sm-9'>
												      <input type='text' class='form-control taskname' name='taskname' id='taskname' placeholder='Task Name'>
												    </div>
												  </div>
												    <div class='form-group'>
												    <label for='startdate' class='col-sm-3 control-label'>Start Date</label>
												    <div class='col-sm-9'>
												     <input type='text' class=' form-control startdate' name='startdate'  placeholder='Start Date'>
												    </div>
												  </div>
												   <div class='form-group'>
												    <label for='enddate' class='col-sm-3 control-label'>End Date</label>
												    <div class='col-sm-9'>
												      <input type='text' class='form-control enddate' name='enddate'  placeholder='End Date'>
												    </div>
												  </div>
												  <div class='form-group'>
												    <label for='status' class='col-sm-3 control-label'>Status</label>
												    <div class='col-sm-9'>
												      <input type='text' class='form-control status' id='status' name='status' placeholder='Status'>
												    </div>
												  </div>
												   <div class='form-group'>
												    <label for='Percentage Completed' class='col-sm-3 control-label'>Percentage Completed</label>
												    <div class='col-sm-9'>
												      <input type='text' class='form-control percentage' id='percentage' name='percentage' placeholder='Percentage Completed'>
												    </div>
												  </div>
										
											
												  <div class='form-group'>
												    <div class='col-sm-offset-2 col-sm-10'>
												      <input type='submit' value='Create Task' class='formbutton' class='btn btn-default'>
												    </div>
												  </div>
												  </form>
												</div>";
												 echo "</div>";
											}
									}
									?>
								</div>
							</div>
						</div>
					</div>
				</div>
</div>
		<div id="activity-form" title="Create Activty for users">
		<div id="activityresponse" style="display: none"></div>
			<form id ='form' class='form-horizontal' role='form'>
				<div class='form-group'>
						  <label for='Task Name' class='col-sm-3 control-label'>Task  Name</label>
						    <div class='col-sm-9'>
						      <input type='text' class='form-control taskname' name='taskname' id='taskname'>
						    </div>
				</div>
				<div class='form-group'>
				 	<label for='ActivityDescription' class='col-sm-3 control-label'>Activity Description</label>
				 	    <div class='col-sm-9'>
						     <textarea type='text' class='form-control ActivityDescription' name='ActivityDescription' id='ActivityDescription'></textarea>
						</div>
			    </div>
				<div class='form-group'>
				 	<label for='DateCompleted' class='col-sm-3 control-label'>Completed Date</label>
				 	    <div class='col-sm-9'>
						     <input type='text' class='form-control completeddate' name='completeddate' id='completeddate'>
						</div>
			    </div>
			    <div class='form-group'>
				 	<label for='durationworked' class='col-sm-3 control-label'>Duration worked</label>
				 	    <div class='col-sm-9'>
						     <input type='text' class='form-control durationworked' name='durationworked' id='durationworked'>
						</div>
			    </div>
				  <div class='form-group'>
					    <div class='col-sm-offset-2 col-sm-10'>
						      <input type='submit' value='Create Activity' class='formactivity_button' class='btn btn-default'>
					    </div>
				</div>
			</form>
		</div>
