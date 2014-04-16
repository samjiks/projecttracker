<script>
 $(function() {  
	 $('#activity-form').dialog({modal:true,autoOpen:false,width:600}); 
 	   $('.editprojecttask').click(function(e) {
 	   	alert('test');
 	       $('#activity-form').dialog('open');
       });
    });
$(document).ready(function(){


		$( ".startdate,.enddate" ).datepicker({ dateFormat: 'dd-mm-yy'});

		  $('#projectlink').on("click", this, function (e) {
    		var href = $(this).attr('href');
    		e.preventDefault();
		  });

			$('.addtask').on("click", this, function (e) {
	
    				$(this).next().toggle('medium');
			//	var project = $(this).data('projectname');

				// var project = $(this).prev('.projectlink').text();
		   		 //var userid = $(this).prev('#addtask').attr('href');
        	//	alert(project);
        });
	


		$('.formbutton').click(function(event){
			event.preventDefault()
				var data = $(this).closest('form').serialize();

		//	var formserialize = $(this).serialize());
			$.ajax({
				type: "post",
				cache: "false",
				url:  "<?php echo base_url(); ?>index.php/project/create_task",
				data: data,
				dataType: "json",
	  			 success: function(response){
	  			 	if(response.length < 0){
	  			 		$('#response').append("Less than 0");
	  			 	}
					$('#response').empty();
	  			 	for(x in response){
	  			 	 	$('#response').append('<div>'+response[x].col_taskname+'<input type='button' id='editprojecttask' value='Edit Task'><input type='button' value='Create Activity' id='createactivitytask'></div>');
	  			 	}
    			},
    			error: function(jqXHR, textStatus, errorThrown){
    				$('#response').append(response);
    			    console.log("The following error occured: "+textStatus, errorThrown);
   				 }

			});		  
		});


/*   $(function() {
    $( ".editprojecttask" ).dialog({
      modal: true,
      buttons: {
        Ok: function() {
          $( this ).dialog( "close" );
        }
      }
    });
  });
*/


/*		$('#form').on( "submit", function( event ) {
			  alert("Submitted");
			  		alert($('#form').serializeArray());
				event.preventDefault();
	
		});*/

});

/*$(document).ready(function(){
	$.post("<?php echo base_url(); ?>index.php/user/get_project_username", function(data) {
	/*$.post("<?php echo base_url(); ?>index.php/project/list_project_json", function(data) {*/
/*		$(".listprojects").append("<p id='list5'>");

		$.each( data, function( key, value ) {
			 
			  $('#list5').append("<p id='box'><a class='projectanchor' href='<?php echo base_url(); ?>index.php/project/get_by_projectname/"+value['col_projectname']+"'>"+value['col_projectname']+"</a></p>");	 
	

			   var $div = $('<button>', {type: 'button', id: 'taskbutton', name: "+value['col_projectname']+",  class:'btn btn-warning'});
			   		$('#list5 button').text("ADD TASK");
			   		  $( '#list5 button' ).on( 'click', 'button', function() {
  							alert('TEST0');
  				 	   });
		
			 	     $('#list5 button').append($div);
			    
			   
		});

		$('.listprojects').append("</p>");
*/
/*		  $('.projectanchor').on("click", this, function (e) {
    			var href = $(this).attr('href');
              	alert(this);
                event.preventDefault();
		  });


		  $('#uname').on("click", this, function (e) {
    			var href = $(this).attr('href');
              	alert(this);
                event.preventDefault();
		  });



/*		 $("#div-my-table").text("<table>");
		 $.each(data, function(i, item) {
     	       $("#div-my-table").append("<tr><td>" + item[0] +"</td><td>" + item[1] + "</td></tr>");
        });
        $("#div-my-table").append("</table>");
	});

}); 
*/

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
				   <h4 class="content-header">
	                      <u>Projects</u>
	                      

	                </h4>
				     <div class="row">           
						 <div class="col-md-12" >
						 <?php echo validation_errors(); ?>

							<div class="gui">
								<div id="listprojects">
						 		<?php
								
										foreach ($projectlist as $value) {
											foreach ($value as $values){
											
												echo "<p class='lead' href='".base_url()."index.php/project/get_by_projectname/$values'>$values</p>";
												echo "<input type='button' class='addtask' data-projectname='$values' value='Add Task'>";
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
				 	<label for='durationworked' class='col-sm-3 control-label'>Duration worked</label>
				 	    <div class='col-sm-9'>
						     <input type='text' class='form-control durationworked' name='durationworked' id='durationworked'>
						</div>
			    </div>
				  <div class='form-group'>
					    <div class='col-sm-offset-2 col-sm-10'>
						      <input type='submit' value='Create Activity' class='formbutton' class='btn btn-default'>
					    </div>
				</div>
			</form>
		</div>
