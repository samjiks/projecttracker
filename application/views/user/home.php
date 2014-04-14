<script>

$(document).ready(function(){
alert("hi");
	$.post("<?php echo base_url(); ?>index.php/project/list_project_json", function(data) {
		$(".listprojects").append("<p id='list5'>");

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

		  $('.projectanchor').on("click", this, function (e) {
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
        $("#div-my-table").append("</table>");*/
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
    


<div class="col-md-6 col-md-offset-3" >
	<div class="gui">
	<div class="listprojects"></div>
	</div>

</div>
</div>

