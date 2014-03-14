<?php
error_reporting (E_ALL);
ini_set('display_errors',1);
//ini_set('display_errors', 'On');
//error_reporting( E_ALL );
require_once('page.inc.php');
$page = new page('Form');
$page->set_features(array(PIWIK,FORMS,FANCY_BOX));
$page->add_css('path/to/my/style.css');
echo $page->head();
?>

<header class="navbar"></header>
<article>
  <section id="hero">
    <div class="container cf">
      <h1>
<?php 
  $_GET['form_name'] = htmlentities($_GET['form_name']);
  echo (isset($_GET['form_name']) ? $_GET['form_name'] : 'Error: No form selected');
?>
      </h1>
    </div>
  </section>
  <div class="container cf">
    <div class="row">
      <div class="col-xs-12">

<?php
if( isset($_GET['form_name']) )
{
  require_once('database_form.inc.php');
  require_once('builder_form.inc.php');
  require_once('actions.inc.php');
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
      echo '<form action="form.php?form_name=' . $_GET['form_name'] . (isset($_GET['dev']) ? '&dev' : '') . '" method="post">';
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
    echo '<form action="form.php?form_name=' . $_GET['form_name'] . (isset($_GET['dev']) ? '&dev' : '') . '" method="post">';
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

      </div>
    </div>
  </div>
</article>
<footer>
  <div class="container">
    <div class="row">
      <div class="col-xs-12">
        <h2>LSITO <small>Web Development Team</small></h2>
        <address>University of Wisconsin&ndash;Milwaukee<br/>Holton Hall (check the basement…over by the water heater…and the sump pump)</address>

      </div>
    </div>
  </div>
</footer>


<?php
echo $page->foot();
?>

