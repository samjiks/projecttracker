<?php

echo form_open('signup');
$username = array(
              'name'        => 'username',
              'id'          => 'username',
              'value'       => '',
              'maxlength'   => '20',
              'size'        => '50',
              'style'       => 'width:50%',
            );

echo form_input($username);

$firstname = array(
              'name'        => 'firstname',
              'id'          => 'firstname',
              'value'       => '',
              'maxlength'   => '20',
              'size'        => '50',
              'style'       => 'width:50%',
            );

echo form_input($firstname);

$lastname = array(
              'name'        => 'lastname',
              'id'          => 'lastname',
              'value'       => '',
              'maxlength'   => '20',
              'size'        => '50',
              'style'       => 'width:50%',
            );

echo form_input($lastname);

$password = array(
              'name'        => 'firstname',
              'id'          => 'firstname',
              'value'       => '',
              'maxlength'   => '20',
              'size'        => '50',
              'style'       => 'width:50%',
            );

echo form_password($firstname);

echo form_close();
?>