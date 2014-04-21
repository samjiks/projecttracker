<script>
if($('#password').val() == $('#cpassword').val()){
  
}
</script>
<div class="wrapper"> <?php
echo form_open('user/signup');
?>
<<h4>Sign up - Registration Form</h4>
<table>
<tr>
  <td>
    <label for="username">Username</label>
  </td>
  <td>
    <input type="text" class="input-large" style="height:30px;" name="username" id="username" placeholder="Enter username">

  </td>
</tr>
<tr>
  <td>

    <label for="firstname">First name</label>
    </td>
    <td>
    <input type="text" class="input-large" style="height:30px;" name="firstname" id="firstname" placeholder="Enter First name">

  </td>
</tr>
<tr>
<td>
    <label for="lastname">Last name</label>
    </td>
    <td>
    <input type="text" class="input-large" style="height:30px;" name="lastname" id="lastname" placeholder="Enter Last name">

  </td>
</tr>
<tr>
<td>
    <label for="emailaddress">Email address</label>
    </td>
    <td>
    <input type="email" class="input-large" style="height:30px;" name="emailaddress" id="emailaddress" placeholder="Enter email">

  </tr>
</tr>
<tr>
<td>

    <label for="password">Password</label></td>
    <td>
    <input type="password" class="input-large" style="height:30px;" name="password" id="password" placeholder="Password">

  </td>
</tr>
<tr>
<td>
 
    <label for="confirmpassword">Confirm Password</label></td><td>
    <input type="password" class="input-large" style="height:30px;" name="cpassword" id="cpassword" placeholder="Confirm Password">

  </td>
</tr>
<tr>
<td>
  <button type="submit" class="btn btn-warning">Submit</button>
  </td>
</tr>
<?php
      echo form_close();
  ?>
</div>
</table>