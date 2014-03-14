<?php
ini_set('display_errors', 'On');
error_reporting( E_ALL );
require_once('/var/www/dbinfo/travel/connection.php');
require_once('page.inc.php');
$page = new page('Forms');
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
  echo (isset($_GET['form_name']) ? $_GET['form_name'] . ' Fields' : 'Error: No form selected');
?>
      </h1>
    </div>
  </section>
  <div class="container cf">
    <div class="row">
      <div class="col-md-9">
<?php
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
  echo '<a href="add_field.php?form_name=' . $_GET['form_name'] . '" class="btn">Add Field</a>';
  echo $structs['html'];
  echo '<a href="add_field.php?form_name=' . $_GET['form_name'] . '" class="btn">Add Field</a>';
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

