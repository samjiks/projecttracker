<script>

	function gotoactivity(taskid, projectid){
		$('.activityresponse').empty();
	     var data =  $('.activity-form').data();
		 data.taskid  = taskid;
		 data.projectid =  projectid;
		 $('.activity-form').dialog('open');
	 }

	function edittask(){
	      $('.tasknametd').attr('contenteditable', 'true');
	      alert($('td.tasknametd').eq(0).text());
	      alert($('td.tasknametd').eq(0).text());

	}

	function listactivity(taskid, projectid){
		$.ajax({
				type: "post",
				cache: "false",
				url: "<?php echo base_url(); ?>index.php/project/list_project_tasks",
				data: {'taskid': taskid },
				dataType: "json",
				success: function(response){
					$('.list-activity-table').empty();	
						$('.list-activity-table').html("<thead><tr><th>S. No<th>Activity Description</th><th>Date Completed</th><th>Duration hours</th></tr></thead>>tbody>");
					for(x in response){
						var item = "<tr><td>"+x+"</td><td>"+response[x].col_activitydescription+"</td><td>"+response[x].col_completeddate+"</td><td>"+response[x].col_durationworked+"</td><td><a class='editactivity'>Edit Activity</a></td><td><a class='deleteactivity'>Delete Activity</a></td></tr>";
						$('.list-activity-table').append(item);	
					}

					$('.listresponse').append("</tbody></table>");

				console.log(response);

				},
				 error: function(jqXHR, textStatus, errorThrown){
    			    console.log("The following error occured: "+textStatus, errorThrown);
				}
		});
 			$('.list-activity-form').dialog('open');
		}

		$(document).ready(function(){


		    $('#editask').click(function(){
		        	alert("HI");
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
				dataType: "json",
	  			 success: function(response){
	  			 	console.log(response['errors']);
					$('.response').empty();
					$('.response').append(response['errors']);
    			},
    			error: function(jqXHR, textStatus, errorThrown){
    				$('.response').append(errorThrown);
    			    console.log("The following error occured: "+textStatus, errorThrown);
   				 }
			});		  
		});
		
	    $('.list-activity-form').dialog({modal:true,autoOpen:false,width:800,title: "Listing Activities for Task",
			buttons:{
				"Close": function(){
					 $( this ).dialog( "close" );	
				 }
   			}			
	    });

		 $('.activity-form').dialog({modal:true,autoOpen:false,width:500,
		 	buttons: {
              "Create Activity": function() {
				var taskid = $(this).data('taskid');
				var projectid = $(this).data('projectid');
				var ActivityDescription = $('#ActivityDescription').val();
				var completeddate = $('#completeddate').val();
				var durationworked = $('#durationworked').val();
              	$.ajax({
					type: "post",
					cache: "false",
					url: "<?php echo base_url(); ?>index.php/dproject/create_activity",
					data: {'taskid' : taskid, 'projectid': projectid, 'ActivityDescription': ActivityDescription, 'completeddate' : completeddate, 'durationworked' : durationworked },
					dataType: "json",
					success: function(response){
						$('.activityresponse').empty()
						$('.activityresponse').append(response['message']);
						$('#ActivityDescription').val("");
					    $('#completeddate').val("");
					    $('#durationworked').val("0hours");
					  //  $( '.activity-form' ).dialog("close");
					},
					error: function(jqXHR, textStatus, errorThrown){
	    			    console.log("The following error occured: "+textStatus, errorThrown);
					}
				});
	              		
	              },
	              Cancel: function() {
	         		 $( this ).dialog( "close" );
	         		 $('#ActivityDescription').val("");
					 $('#completeddate').val("");
					 $('#durationworked').val("0hours");
	       		 }/*,
	       		 Close: function(){
	       		 
	         		 $('#ActivityDescription').val("");
					 $('#completeddate').val("");
					 $('#durationworked').val("0hours");
	       		 }*/

	            }
		 });

 	 /*	  $('.editprojecttask').on('click', function(e) {
 	 	  	e.preventDefault();
 				alert("Clucked");
 	    	   $('.activity-form').dialog('open');
   		    });*/
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
										
						self.parent().find('.listresponse').html('<table class="table tbltsklist"><thead><tr><th>Task name</th><th>Start Date</th><th>End Date</th><th>Status</th><th>Percentage complete</th><th>Edit Task</th><th>Create Activity</th></tr></thead><tbody>');
						
						for(x in response){
							var item = "<tr><td class='tasknametd'>"+response[x].col_taskname+"</td><td>"+response[x].col_startdate+"</td><td>"+response[x].col_enddate+"</td><td>"+response[x].col_statustasks+"</td><td>"+response[x].col_percentage_complete+"</td><td><a class='edittask' id='edittask' >Edit Task</a></td><td><a class='editprojecttask' data-taskid='"+response[x].col_tasksid+"' onClick='gotoactivity("+response[x].col_tasksid+", "+response[x].col_projectid+");' >Create Activity</a></td><td><a onClick='listactivity("+response[x].col_tasksid+", "+response[x].col_projectid+")' id='clickme' class='glyphicon glyphicon-chevron-up'>Open Activities for the Task</a></td></tr>";
						 	self.parent().find('.listresponse .tbltsklist').append(item);
						 }	
 	       				self.parent().find('.listresponse').append("</tbody></table>");
 	       				
					},	
					error: function(jqXHR, textStatus, errorThrown){
					 $('#activityresponse').append(errorThrown);
    			    console.log("The following error occured: "+textStatus, errorThrown);
				}
				});
		});


		   $( "#slider-range-min" ).slider({
		      range: "min",
		      value: 0,
		      min: 0,
		      max: 100,
		      slide: function( event, ui ) {
		        $( "#percentage" ).val( ui.value + "%" );
		      }
		    });
		    $( "#percentage" ).val($( "#slider-range-min" ).slider( "value" ) + "%");

		    $( "#slider-range-min-1" ).slider({
		      range: "min",
		      value: 0,
		      min: 1,
		      max: 1000,
		      slide: function( event, ui ) {
		        $( "#durationworked" ).val( ui.value + "hours" );
		      }
		    });
		    $( "#durationworked" ).val($( "#slider-range-min-1" ).slider( "value" ) + "hours");

		    $('.lptasks').click(function(e){
		    	e.preventDefault();
		    	$('.content-header').empty();
		    	$('.projects').empty();
		    	

		    	$.ajax({
					type: "post",
					cache: "false",
					url: "<?php echo base_url(); ?>index.php/project/list_project_tasks",
					//dataType: "json",
					success: function(response){
						$('.projects').append(response);
					},
					error: function(jqXHR, textStatus, errorThrown){
						 $('#activityresponse').append(errorThrown);
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
				   <h4 class="content-header">PROJECTS</h4>  
				     <div class="row">           
						 <div class="col-md-12" >
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
												<div class='response'></div>
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
												    	<select id='status' class='form-control status' name='status'>
												    		<option>In Progress</option>
												    		<option>Waiting</option>
												    		<option>Completed</option>
												    		</select>
												    </div>
												  </div>
												   <div class='form-group'>
												    <label for='Percentage Completed' class='col-sm-3 control-label'>Percentage Completed</label>
												    <div class='col-sm-9'>
												      <input type='text' class='form-control percentage' id='percentage' name='percentage' placeholder='Percentage Completed'>
												  		 <div id='slider-range-min'></div>
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

<div class="activity-form" style="background: color;" title="Create Activty for users">
		<div class="activityresponse"></div>
			<form id ='form' class='form-horizontal' role='form'>
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
						     <div id='slider-range-min-1'></div>
						</div>
			    </div>
			</form>
		</div>
<div class="list-activity-form">
	<table class='table list-activity-table'>
		<thead>
			<tr><th>S. No<th>Activity Description</th><th>Date Completed</th><th>Duration hours</th></tr>
		</thead>

		</table>
</div>