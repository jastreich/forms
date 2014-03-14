<?php
ini_set('display_errors', 'On');
error_reporting( E_ALL );
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
  echo (isset($_GET['form_name']) ? 'Add Message Action to ' . $_GET['form_name'] : 'Error: No form selected');
?>
      </h1>
    </div>
  </section>
  <div class="container cf">
    <div class="row">
      <div class="col-xs-12">

<?php
require_once('database_form.inc.php');
require_once('builder_form.inc.php');
require_once('actions.inc.php');

if(isset($_POST['form_name']))
{
  $form = new database_form($_POST['form_name'],array());
  $form->read_form();
//  $builder_form = new builder_form();
//  $builder_form->values($_POST);

  $ema = new message($form);
  $ema->values($_POST);
  $builder_form = $ema->form($form);

  if(isset($_GET['dev']))
  {
    var_dump($builder_form);
  }

  if(false === $builder_form->sanitize())
  {
    die('Input error.');
  }

  $errors = $builder_form->validate();

  if(0 == count($errors))
  {
//    $f = $builder_form->make_field();
    $form->add_observer($ema);
    $form->update_form();
    echo '<h1>Action added Successfully</h1>';
    echo '<ul>';
    echo '<li><a href="add_message_action.php?form_name=' . $_POST['form_name'] . '">Add another message action to this form</a></li>';
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
    echo '<form action="add_message_action.php' . (isset($_GET['dev']) ? '?dev' : '') . '" method="post">';
    echo '<input type="hidden" name="form_name" value="' .  $_POST['form_name'] . '" />';
    $dis = $builder_form->form();
    echo $dis['html'];
    echo '<input type="submit" name="submit" /></form>';

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

}
else if(isset($_GET['form_name']))
{
    $form = new database_form($_GET['form_name'],array());
    $form->read();


    //$builder_form = new builder_form();
    $ema = new message($form);
    $ema->values($_POST);
    $builder_form = $ema->form($form);


    echo '<h2>Add a Field</h2>';
    echo '<form action="add_message_action.php' . (isset($_GET['dev']) ? '?dev' : '') . '" method="post">';
    echo '<input type="hidden" name="form_name" value="' .  $_GET['form_name'] . '" />';
    $dis = $builder_form->form();
    echo $dis['html'];
    echo '<input type="submit" name="submit" /></form>';

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

