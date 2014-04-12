<script>
$(document).ready(function(){
	$.post("<?php echo base_url(); ?>index.php/project/list_project_json", function(data) {
		$(".listprojects").append("<ul class='ulprojects'>");
		$.each( data, function( key, value ) {
			console.log(value['col_projectname']);
			  $('.listprojects').append("<li>"+value['col_projectname']+"</li>");	  

		});
		$(".listprojects").append("</ul>");

	

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
		echo "<p class='alert' style='float: right'>Welcome,"?><?php  if(isset($col_username)){ echo $col_username; } "</p>";
		echo "<script> $( '.login' ).css( 'display', function( index ) { index = 'none'; return index; });</script>";
	    echo "<script> $( '.logout' ).css( 'display', function( index ) { index = ''; return index; });</script>";
	}
?>
    


<div class="col-md-10" >
	<div class="gui">
	<div class="listprojects"></div>
	</div>

</div>


