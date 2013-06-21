<!Doctype html>
<head>
<style type="text/css">
  label{display:block;}
  label.required{color:red;}
  .required:after{content:'*';font-weight:bold;vertical-align:super;color:red;}
  :valid{box-shadow:0 0 5px #5cd053;border-color: #28921f;}
  :invalid{box-shadow:0 0 5px #d45252;border-color:#b03535;}
  input[type=submit]{box-shadow:0 0 5px #ccc;border-color:#ccc;}
</style>
</head>
<body>
<?php
ini_set('display_errors', 'On');
error_reporting( E_ALL );
require_once('input.inc.php');
var_dump($_POST);
$i = new input('Phone Number','phone','color',(isset($_POST['phone']) ? $_POST['phone'] : ''),true,30,'','','','(XXX) XXX-XXXX');
$opts = array();
$opts['Apples'] = 'apples';
$opts['Oranges'] = 'oranges';
$opts['Turkey Turkey'] = 'turkey';
$opts['Goo Goo'] = 'goo';
$m = new input_group('Foodish Items','food',$opts,'radio',(isset($_POST['food']) ? $_POST['food'] : ''));

$f  = $i->form();
$f2 = $m->form();
if(isset($_POST['phone']))
{
 var_dump($i->sanitize());
}
echo '<form method="post" action="test_input.php">';
echo $f['html'];
echo $f2['html'];
echo '<input type="submit" />';
echo '</form>';

/*
    $label_text,
    $name,
    $type = 'text',
    $value = '',
    $required = '',
    $maxlength = '',
    $min = '',
    $max = '',
    $pattern = '',
    $placeholder = '',
    $sanity_func = null,
    $valid_func = null
*/


?>
</body>
</html>
