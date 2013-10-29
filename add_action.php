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
<?php echo (isset($_GET['form_name']) ? $_GET['form_name'] : 'Error: No form selected');?>
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

