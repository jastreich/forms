<?php
ini_set('display_errors', 'On');
error_reporting( E_ALL );

require_once('database_form.inc.php');
require_once('input.inc.php');
require_once('input_group.inc.php');
require_once('extended_inputs.inc.php');
require_once('texteditor.inc.php');

if(isset($_GET['form_name']))
{
  $form = new database_form($_GET['form_name'],array());
  $form->read_form();
  $structs = $form->display_structure();
  echo '<h1>' . htmlentities(trim($_GET['form_name'])) . '</h1>';
  echo '<h2>Form Fields</h2>';
  echo '<a href="add_field.php?form_name=' . $_GET['form_name'] . '">Add Field</a>';
  echo $structs['html'];
  echo '<a href="add_field.php?form_name=' . $_GET['form_name'] . '">Add Field</a>';
  echo '<h2>Data</h2>';
  $table = $form->display_table();
  echo $table['html'];
}

?>
