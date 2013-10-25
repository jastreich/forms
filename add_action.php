<!Doctype html>
<head>
<style type="text/css">
  label{display:block;}
  label.required{color:red;}
  .required:after{content:'*';font-weight:bold;vertical-align:super;color:red;}
  :valid{box-shadow:0 0 5px #5cd053;border-color: #28921f;}
  :invalid,.error>input{box-shadow:0 0 5px #d45252;border-color:#b03535;}
  input[type=submit]{box-shadow:0 0 5px #ccc;border-color:#ccc;}
</style>
</head>
<body>

<?php
ini_set('display_errors', 'On');
error_reporting( E_ALL );

require_once('database_form.inc.php');
require_once('builder_form.inc.php');
require_once('actions.inc.php');

if(isset($_GET['form_name']))
{
//  $form->add_observer($ema);
//  $form->update_form();
  echo '<h1>Action added Successfully</h1>';
  echo '<ul>';
  echo '<li><a href="add_email_action.php?form_name=' . $_GET['form_name'] . '">Add Email Action to this Form</a></li>';
  echo '<li><a href="add_message_action.php?form_name=' . $_GET['form_name'] . '">Add Message Action to this Form</a></li>';
  echo '<li><a href="form_data_crud.php?form_name=' . $_GET['form_name'] . '">View data collected with this form</a></li>';
  echo '<li><a href="crud.php">All forms</a></li>';
  echo '</ul>';
}

?>
</body>
</html>
