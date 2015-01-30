<?php
/** @file api.php
 * This file defines the api for form building.
 * @author Jeremy Streich
 **/

  ini_set('display_errors', 'On');
  error_reporting( E_ALL );
  require_once('/var/www/error_handling.php');

  require_once('/var/www/dbinfo/travel/connection.php');

  require_once('database_form.inc.php');
  require_once('builder_form.inc.php');
  $builder = new builder_form();

  // White Lists
  $input_whitelist = array
  (
    'input',
    'color_input',
    'datalist_input',
    'date_input',
    'email_input',
    'hidden_input',
    'input_group',
    'number_input',
    'password_input',
    'range_input',
    'tel_input',
    'text_input',
    'textarea',
    'zip_input',
    'get_input',
    'texteditor'
  );

  $required_values = array
  (
    'yes' => true,
    'no' => false,
    'y' => true,
    'n' => false,
    '1' => true,
    '0' => false,
    'on' => true,
    'off' => false,
    true => true,
    false => false
  );

  $form_names = array();
  $stmnt = $db->prepare('select distinct name from forms');
  $stmnt->bind_result($v);
  $stmnt->execute();
  while($stmnt->fetch())
  {
    $form_names[] = $v;
  }
  $stmnt->close();

 // ----

//echo('Hi');

  // Input type
  if(isset($_REQUEST['type']) && in_array($_REQUEST['type'],$input_whitelist))
  {
    $_SAFE['type'] = $_REQUEST['type'];
  }
  else if(!isset($_REQUEST['type']))
  {
    // Creating or deleting forms doesn't require an input.
  }
  else
  {
    http_response_code(201);
    die('Invalid type value');
  }

//echo(' there. ');


  // Input name
  /*&& ctype_alnum($_REQUEST['name'])*/
  if(isset( $_REQUEST['name'] ) && ctype_alnum($_REQUEST['name']) )
  {
    $_SAFE['name'] = $_REQUEST['name'];
  }
  else if(!isset($_REQUEST['name']))
  {
    // Creating or deleting forms doesn't require an input, and thus no name.
  }
  else
  {
    http_response_code(201);
    die('Invalid value for name.');
  }

//echo('My name is ');

  if(isset($_REQUEST['text_label']) && ctype_alnum($_REQUEST['name']))
  {
    $_SAFE['text_label'] = $_REQUEST['text_label'];
  }
  else if(!isset($_REQUEST['text_label']) && isset($_SAFE['name']))
  {
    $_SAFE['text_label'] = $_SAFE['name'];
  }
  else if(!isset($_SAFE['text_label']))
  {
    // Creating or deleting formes doesn't require a test_label 
  }
  else
  {
    http_response_code(201);
    die('Invalid text_label');
  }

//echo('Zul. I am an ');

  // Input Required
  if(!isset($_REQUEST['required']))
  {
    $_SAFE['required'] = false;
  }
  else if(array_key_exists($_REQUEST['required'],$required_values))
  {
    $i = $_REQUEST['request'];
    $_SAFE['required'] = $required_values[ $i ];
  }
  else
  {
    http_response_code(201);
    die('Invalid value for required.');
  }


//echo('API. I know it is an odd name. ');


  // Input value
  if( isset($_REQUEST['value']) && $_SAFE['input'] != 'texteditor')
  {
    $_SAFE['value'] = htmlspecialchars($_REQUEST['value']);
  }
  else if( isset($_REQUEST['value']) )
  {
    // Pass sanitization off on texteditor class...
    $_SAFE['value'] = $_REQUEST['value'];
  }

//echo('Hopefully. I am very secure, ');


  // Form name
  if(isset($_REQUEST['form']))
  {
    $_SAFE['form'] = $_REQUEST['form'];
  }
  else if(isset($_REQUEST['form']))
  {
    http_response_code(201);
    die('Invalud value for form');
  }

  // Action to take.
  if(!isset($_REQUEST['action']))
  {
    $_REQUEST['action'] = 'form';
  }

  switch($_REQUEST['action'])
  {

    case 'make':
      if(!isset($_SAFE['form']))
      {
        http_response_code(201);
        die('No form name sent.');
      }
      else if( in_array($_SAFE['form'],$form_names) )
      {
        http_response_code(201);
        die('Form already exists.');
      }
      $form = new database_form($_SAFE['form'],array());
      $form->create_form();
      $ret = $form->form(array());
      header('Content-Type: application/json');
      echo(json_encode($ret));      
      break;

    case 'add':
      if(!isset($_SAFE['form']))
      {
        http_response_code(201);
        die('The form must be specified to add.');
      }
      if(!isset($_SAFE['type']))
      {
        http_response_code(201);
        die('The input must be specified to add.');
      }
      if(!isset($_SAFE['name']))
      {
        http_response_code(201);
        die('The name muse be specified to add.');
      }
      if(!in_array($_SAFE['form'], $form_names))
      {
        http_response_code(201);
        die('Add requires a valid existing form.');
      }
      $form = new database_form($_SAFE['form'],array());
      $form->read_form();
      if(!is_array($_SAFE['type']))
      {
        $_SAFE['type'] = array($_SAFE['type']);
      }

      $builder->values($_SAFE);
      if(!$builder->sanitize())
      {
        http_response_code(201);
        die('Unrecoverable Errors exist in input.');
      }

      $errors = $builder->validate();
      if(count(errors) > 0)
      {
        http_response_code(201);
        die('Unrecoverable Errors exist in input.');
      }
    
      $field = $builder->make_field();

      if($field !== null)
      {
        $form->add_field($field );
      }
      else
      {
        http_response_code(201);
        die('Unable to make input.');
      }

      $form->update_form();
      $ret = $form->form(array());
      header('Content-Type: application/json');
      echo(json_encode($ret));
      break;

    case 'validate':
    case 'form':

      if(!isset($_SAFE['form']))
      {
        http_response_code(201);
        die('No form name sent.');
      }
      else if(!in_array($_SAFE['form'],$form_names)) 
      {
        http_response_code(201);
        die('Form does not exists.');
      }

      $form = new database_form($_SAFE['form'],array());
      $form->read_form();
      if(isset($_REQUEST['values']))
      {
        $form->values(json_decode($_REQUEST['values']));
        if(!$form->sanitize())
        {
          http_response_code(201);
          die('Values contain potentially dangerous information.');
        }
      }
      $errors = array();
      if(isset($_REQUEST['errors']))
      {
        $errors = json_decode($_REQUEST['errors']);
        foreach($errors as $k => $v)
        {
          $errors[$k] = htmlentities($v);
        }
      }
      if($_REQUEST['action'] == 'validate')
      {
        $errors = $form->validate($errors);
      }
      $ret = $form->form($errors);
      $ret['errors'] = $errors;
      header('Content-Type: application/json');
      echo(json_encode($ret));
      break;
      
    case 'update':
      if(!isset($_SAFE['form']))
      {
        http_response_code(201);
        die('The form must be specified to add.');
      }
      if(!isset($_SAFE['type']))
      {
        http_response_code(201);
        die('The input type must be specified to update.');
      }
      if(!isset($_SAFE['name']))
      {
        http_response_code(201);
        die('The name muse be specified to update.');
      }
      if(!in_array($_SAFE['form'], $form_names))
      {
        http_response_code(201);
        die('Update requires a valid existing form.');
      }
      $form = new database_form($_SAFE['form'],array());
      $form->read_form();

      if(!is_array($_SAFE['type']))
      {
        $_SAFE['type'] = array($_SAFE['type']);
      }

      $builder->values($_SAFE);
      if(!$builder->sanitize())
      {
        http_response_code(201);
        die('Unrecoverable Errors exist in input.');
      }

      $errors = $builder->validate();
      if(count(errors) > 0)
      {
        http_response_code(201);
        die('Unrecoverable Errors exist in input.');
      }


      $field = $builder->make_field();

      if($field !== null)
      {
        $form->fields[ $_SAFE['name'] ] = $field;
      }
      else
      {
        http_response_code(201);
        die('Unable to make input.');
      }


      $form->update_form();
      $ret = $form->form(array());
      header('Content-Type: application/json');
      echo(json_encode($ret));      
      break;

/*
    case 'submit':
      if(!isset($_SAFE['form']))
      {
        http_response_code(201);
        die('The form must be specified to submit.');
      }
      if(!in_array($_SAFE['form'], $form_names)
      {
        http_response_code(201);
        die('Add requires a valid existing submit.');
      }
      if(!isset($_REQUEST['values'])
      {
        http_response_code(201);
        die('Submit requires a valid existing form.');
      }
      $form = new database_form($_SAFE['form'],array());
      $form->read_form();
      $form->values(json_decode($_REQUEST['values']));
      if($_REQUEST['values'])
      {
        $form->values(json_decode($_REQUEST['values']));
        if(!$form->sanitize())
        {
          http_response_code(201);
          die('Values contain potentially dangerous information.');
        }
      }
      $errors = $form->validate();
      if(0 !=== count($errors))
      {
          http_response_code(201);
          die('Values are not valid for this form.');       
      }
      $form->create();
      break;
*/
    case 'remove':
      if(!isset($_SAFE['form']))
      {
        http_response_code(201);
        die('The form must be specified to remove.');
      }
      if(!in_array($_SAFE['form'], $form_names))
      {
        http_response_code(201);
        die('Remove requires a valid existing form.');
      }
      if(!isset($_SAFE['name']))
      {
        http_response_code(201);
        die('Remove requires a valid input name.');
      }
      $form = new database_form($_SAFE['form'],array());
      $form->read_form();
      unset($form->fields[$_SAFE['name']]);
      $form->update_form();
      $ret = $form->form(array());
      header('Content-Type: application/json');
      echo(json_encode($ret));
      break;

    case 'delete':
      if(!isset($_SAFE['form']))
      {
        http_response_code(201);
        die('The form must be specified to delete.');
      }
      if(!in_array($_SAFE['form'], $form_names))
      {
        http_response_code(201);
        die('Delete requires a valid existing form.');
      }
      $form = new database_form($_SAFE['form'],array());
      $form->delete_form();
      break;

  }

?>
