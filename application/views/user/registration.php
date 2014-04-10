<script>
if($('#password').val() == $('#cpassword').val()){
  alert("TEST");
}
</script>
<?php
echo "<div class='container'>";
echo form_open('user/signup');
?>
  <div class="form-group">
    <label for="username">Username</label>
    <input type="text" class="input-large" name="username" id="username" placeholder="Enter username">
  </div>
  <div class="form-group">
    <label for="firstname">First name</label>
    <input type="text" class="input-large" name="firstname" id="firstname" placeholder="Enter First name">
  </div>
  <div class="form-group">
    <label for="lastname">Last name</label>
    <input type="text" class="input-large" name="lastname" id="lastname" placeholder="Enter Last name">
  </div>
  <div class="form-group">
    <label for="emailaddress">Email address</label>
    <input type="email" class="input-large" name="emailaddress" id="emailaddress" placeholder="Enter email">
  </div>
  <div class="form-group">
    <label for="password">Password</label>
    <input type="password" class="input-large" name="password" id="password" placeholder="Password">
  </div>
  <div class="form-group">
    <label for="confirmpassword">Confirm Password</label>
    <input type="password" class="input-large" name="cpassword" id="cpassword" placeholder="Confirm Password">
  </div>

  <button type="submit" class="btn btn-warning">Submit</button>
  <?php
      echo form_close();
  ?>
</div>