
		<div>
                    <p class='alert'> <?php isset($result)? print_r($result) : "No data"; ?></p> <!-- Problem here -->
				 </div>
      <?php echo form_open("project/create_project_submit") ?>
        <h4 class="form-signin-heading">Create Project</h4>
        <label> Project Name: </label>
        <input type="textbox" name="projectname"  placeholder="Create Project Name" >
        <br/>
        <label> Project Desription: </label>
        <textarea type="textbox" name="projectdescription"  placeholder="Enter Project Description" ></textarea><br/>
        <input class="btn btn-small" type="submit" name="submit" value="Register" type="submit" required autofocus>
      </form>
