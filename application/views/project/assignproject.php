

<?php 
//print_r($get_projects);

 echo form_open('project/assign_project_save');
 ?>
<?php  if(isset($result)) { echo "<p class='alert'>$result</p>"; } 	?>
 <?
    echo form_label('Project Name', 'projectname');
    if(isset($get_projects) && isset($get_users)){
		if(is_array($get_projects)){
			echo "<select name='projects'>";
			foreach ($get_projects as $key => $value) {
				echo "<option value=".$value['col_projectname'].">".$value['col_projectname']."</option>";		
			}
			echo "</select>";
		}
			echo "assign to =>";

		if(is_array($get_users)){
		    echo form_label('Username', 'username');
		echo "<select name='users'>";
		foreach ($get_users as $key => $value) {
				echo "<option value=".$value['col_username'].">".$value['col_username']."</option>";		
		}
		$js = 'onClick="test()"';
		echo form_submit('save', 'Save', $js);
		echo "</select>";
		}
	}else{
		echo "not set";
	}

echo form_close();
?>
