<?php

ini_set('display_errors', 'On');
error_reporting( E_ALL );


  $_GET['form_name'] = htmlentities($_GET['form_name']);

require_once('database_form.inc.php');
require_once('builder_form.inc.php');


if(isset($_POST['form_name']))
{
  $form = new database_form($_POST['form_name'],array());
  $form->read_form();
  $builder_form = new builder_form();
  $builder_form->values($_POST);
  $builder_form->before_input = '<div class="form-row">';
  $builder_form->after_input = '</div>';

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
    echo 'Field Created.';
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
    $builder_form->before_input = '<div class="form-row">';
    $builder_form->after_input = '</div>';
    echo '<h2>Add a Field</h2>';
    echo '<form action="add_field.php?form_name=' . $_GET['form_name'] . '" method="post">';
    echo '<input type="hidden" name="form_name" value="' .  $_GET['form_name'] . '" />';
    $dis = $builder_form->form();
    echo $dis['html'];
    echo '<input type="submit" name="submit" /></form>';
}

?>

