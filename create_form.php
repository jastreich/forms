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

if(isset($_POST['new_name']) && '' != $_POST['new_name'])
{
  require_once('database_form.inc.php');
  require_once('builder_form.inc.php');
  $form = new database_form(htmlentities($_POST['new_name']),array());
  $form->create_form();
  echo '<h1>Form Creator</h1>';
  echo 'Form: <b>' . $_POST['new_name'] . '</b><br/>';
  echo '<h2>Add a Field</h2>';
  echo '<form action="add_field.php" method="post">';
  echo '<input type="hidden" name="form_name" value="' .  htmlentities($_POST['new_name']) . '" />';
  $builder_form = new builder_form();
  $dis = $builder_form->form();
  echo $dis['html'];
  echo '<input type="submit" name="submit" /></form>';
}

?>
</body>
</html>
