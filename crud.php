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

require_once('/var/www/dbinfo/travel/connection.php');
?>

<form action="create_form.php" method="post">
  <input type="text" name="new_name" />
  <input type="submit" />
</form>

<?php
$stmnt = $db->prepare('select name from forms');
$stmnt->execute();
$stmnt->bind_result($name);

echo '<table>';
echo '<thead><tr><th colspan="2">Forms</th></tr><tr><th>Select</th><th>Form Name</th></tr></thead><tbody>';
while($stmnt->fetch())
{
  echo '<tr><td><input type="checkbox" name="select" value="' . $name . '" /></td><td>' . $name . '</td></tr>';
}
echo '<tbody></table>';

$stmnt->close();

?>
</body>
</html>
