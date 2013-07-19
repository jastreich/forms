<!Doctype html>
<head>
		<style>

  *:focus
  {
    outline:none; /* Prevents blue border in Webkit */
  }

  body
  {
    font-family: "Helvetica Neue", Helvetica, Arial, sans-serif; /*  */
  }

  #top_bit
  {
    width:760px;
    margin: 0 auto;
  }

  form
  {
    width:300px;
    margin: 20px auto;
  }

  p
  {
    line-height: 1.6;
  }

  input, textarea
  {
    font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
    background-color:#fff;
    border:1px solid #ccc;
    font-size:20px;
    width:300px;
    min-height:30px;
    display:block;
    margin-bottom:16px;
    margin-top:8px;

    -webkit-border-radius:5px;
    -moz-border-radius:5px;
    border-radius:5px;

    -webkit-transition: all 0.5s ease-in-out;
    -moz-transition: all 0.5s ease-in-out;
    -ms-transition: all 0.5s ease-in-out;
    -o-transition: all 0.5s ease-in-out;
    transition: all 0.5s ease-in-out;
  }

  textarea
  {
    min-height:200px;
    overflow: hidden;
  }

  input:focus, textarea:focus
  {
    -webkit-box-shadow:0 0 25px #ccc;
    -moz-box-shadow:0 0 25px #ccc;
    box-shadow:0 0 25px #ccc;
    -webkit-transform: scale(1.05);
    -moz-transform: scale(1.05);
    -ms-transform: scale(1.05);
    -o-transform: scale(1.05);
    transform: scale(1.05);
  }

  input[type="number"]:focus
  {
    -o-transform: none !important;
  }

  /* The interesting bit */

  input:not(:focus), textarea:not(:focus)
  {
    opacity:0.5;
  }

  input:required, textarea:required
  {
    background:url("asterisk_orange.png") no-repeat right 7px;
  }

  [required] {
    background:url("asterisk_orange.png") no-repeat right 7px;
  }

  input:valid, textarea:valid
  {
    /* Make this important if you want IE10 to work right. */
    background:url("tick.png") no-repeat right 5px !important;
  }

  .wf2_valid
  {
    background:url("tick.png") no-repeat right 5px;
  }

  input:focus:invalid, textarea:focus:invalid
  {
    background:url("cancel.png") no-repeat right 7px;
  }

  input.wf2_invalid:focus
  {
    background:url("cancel.png") no-repeat right 7px;
  }

  input[type=submit]
  {
    padding:10px;
    background:none;
    opacity:1.0;
  }
  </style>

  <script type="text/javascript" src="html5Forms.js-master/shared/js/EventHelpers.js"></script>

  <script type="text/javascript" src="html5Forms.js-master/shared/js/modernizr.com/Modernizr-2.5.3.forms.js">
  </script>

  <script type="text/javascript" src="html5Forms.js-master/shared/js/html5Forms.js" data-webforms2-support="validation,number,range,date,color" data-webforms2-force-js-validation="true">
  </script>


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
