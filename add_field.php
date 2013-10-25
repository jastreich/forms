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


if(isset($_POST['form_name']))
{
  $form = new database_form($_POST['form_name'],array());
  $form->read_form();
  $builder_form = new builder_form();
  $builder_form->values($_POST);


  if(isset($_GET['dev']))
  {
    echo '<pre>';
    echo '<b>POST</b><br/>';
    var_dump($_POST);
    echo '<b>Builder</b><br/>';
    var_dump($builder_form);
    echo '</pre>';
  }

  if(false === $builder_form->sanitize())
  {
    die('Input error.');
  }

  $errors = $builder_form->validate();

  if(0 == count($errors))
  {
    $f = $builder_form->make_field();
    $form->add_field($f);
    $form->update_form();
    echo '<h1>Field added Successfully</h1>';
    echo '<ul>';
    echo '<li><a href="add_field.php?form_name=' . $_POST['form_name'] . '">Add another field to this form</a></li>';
    echo '<li><a href="form_fields.php?form_name=' . $_POST['form_name'] . '">View all fields in this form</a></li>';
    echo '<li><a href="form_data_crud.php?form_name=' . $_POST['form_name'] . '">View data collected with this form</a></li>';
    echo '<li><a href="crud.php">All forms</a></li>';
    echo '</ul>';
  }
  else
  {
    echo '<ol>';
    foreach($errors as $error)
    {
      echo $error;
    }
    echo '</ol>';
    echo '<h2>Add a Field</h2>';
    echo '<form action="add_field.php" method="post">';
    echo '<input type="hidden" name="form_name" value="' .  $_POST['form_name'] . '" />';
    $dis = $builder_form->form();
    echo $dis['html'];
    echo '<input type="submit" name="submit" /></form>';
  }
}
else if(isset($_GET['form_name']))
{
    $form = new database_form($_GET['form_name'],array());
    $form->read();
    $builder_form = new builder_form();
    echo '<h2>Add a Field</h2>';
    echo '<form action="add_field.php" method="post">';
    echo '<input type="hidden" name="form_name" value="' .  $_GET['form_name'] . '" />';
    $dis = $builder_form->form();
    echo $dis['html'];
    echo '<input type="submit" name="submit" /></form>';
}

?>
</body>
</html>
