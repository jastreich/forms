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

if( isset($_GET['form_name']) )
{
  require_once('database_form.inc.php');
  require_once('builder_form.inc.php');
  $form = new database_form($_GET['form_name'],array());
  $form->read_form();
  if(isset($_POST) && 0 != count($_POST))
  {
    $form->values($_POST);
    $form->sanitize();
    $errors = $form->validate();
    if(count($errors) == 0)
    {
      $form->create();
    }
    else
    {
      echo '<ol>';
      foreach($errors as $error)
      {
        echo '<li>' . $error . '</li>';
      }
      echo '</ol>';
      $dis = $form->form();
      echo '<form action="form.php?form_name=' . $$_GET['form_name'] . '" method="post">';
      echo $dis['html'];
      echo '<input type="submit" />';
      echo '</form>';

      if(isset($dis['jquery']) && $dis['jquery'])
      {
        echo '<script src="jquery.js" type="text/javascript"></script>';
      }

      if(isset($dis['tinymce']) && $dis['tinymce'])
      {
        echo '<script src="tinymce/jquery.tinymce.js" type="text/javascript"></script>';
      }

      if($dis['js'] != '')
      {
        echo '<script type="text/javascript">';
        echo $dis['js'];
        echo '</script>';
      }

    }
  }
  else
  {
    $dis = $form->form();
    echo '<form action="form.php?form_name=' . $_GET['form_name'] . '" method="post">';
    echo $dis['html'];
    echo '<input type="submit" />';
    echo '</form>';

    if(isset($dis['jquery']) && $dis['jquery'])
    {
      echo '<script src="jquery.js" type="text/javascript"></script>';
    }

   if(isset($dis['tinymce']) && $dis['tinymce'])
    {
      echo '<script src="tinymce/jquery.tinymce.min.js" type="text/javascript"></script>';
    }

    if($dis['js'] != '')
    {
      echo '<script type="text/javascript">';
      echo $dis['js'];
      echo '</script>';
    }
  }

  if(isset($_GET['dev']))
  {
    var_dump($form);
  }
}
?>
</body>
</html>
