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
        Forms
      </h1>
    </div>
  </section>
  <div class="container cf">
    <div class="row">
      <div class="col-md-9">





<?php
$stmnt = $db->prepare('select name from forms');
$stmnt->execute();
$stmnt->bind_result($name);

echo '<h2>Existing Forms</h2>
<table class="table">';
echo '<thead><tr><th>Select</th><th class="text-left">Form Name</th><th>Actions</th></tr></thead><tbody>';
while($stmnt->fetch())
{
  echo '<tr><td class="text-center"><input type="checkbox" name="select" value="' . $name . '" /></td>'
     . '<td><a href="form_data_crud.php?form_name=' . $name . '">' . $name . '</td>'
     . '<td>'
       . '<a href="form_data_crud.php?form_name=' . $name . '">Data</a> | '
       . '<a href="form_fields.php?form_name=' . $name . '">Fields</a> | '
       . '<a href="add_field.php?form_name=' . $name . '">Add Field</a> | '
       . '<a href="add_action.php?form_name=' . $name . '">Add Action</a> | '
       . '<a href="form.php?form_name=' . $name . '">Form</a></td></tr>';
}
echo '<tbody></table>';

$stmnt->close();

?>

</div>
<div class="col-md-3">
<form action="create_form.php" method="post">
<h2>New Form</h2>
<label>Form Name:  <input type="text" name="new_name" /></label>
  <input type="submit" />
</form>
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
