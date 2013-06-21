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

require_once('input.inc.php');
require_once('file_form.inc.php');
/*
$i = new input('Phone Number','phone','color',(isset($_POST['phone']) ? $_POST['phone'] : ''),true,30,'','','','(XXX) XXX-XXXX');
$j = new input('Phone Number 2','phone2','text',(isset($_POST['phone2']) ? $_POST['phone2'] : ''),true,30,'','',$RX_PHONE,'(XXX) XXX-XXXX');
$k = new input('Phone Number 3','phone3','email',(isset($_POST['phone3']) ? $_POST['phone3'] : ''),true,30,'','','','(XXX) XXX-XXXX');

$opts = array();
$opts['Apples'] = 'apples';
$opts['Oranges'] = 'oranges';
$opts['Turkey Turkey'] = 'turkey';
$opts['Goo Goo'] = 'goo';
$m = new input_group('Foodish Items','food',$opts,'radio',(isset($_POST['food']) ? $_POST['food'] : ''));
*/

$form = new file_form('my_form',array());
$form->add_field(new text_input('First Name','first_name','',true,30));
$form->add_field(new text_input('Last Name','last_name','',true,30));
$form->add_field(new tel_input('Phone Number','phone','',true));
$form->add_field(new text_input('Address','address','',true,50));
$form->add_field(new zip_input('Zip Code','zip','',true));
$form->add_field(new range_input('Input a Range','range',5,true,1,10,true));

$errors = array();
if(isset($_POST) && count($_POST) > 0)
{
  $form->values($_POST);

  try
  {
    $form->save();
  }
  catch(Exception $e)
  {
    echo 'NOPE!';
  }

  try
  {
    $form2 = new file_form('my_form',array());
    $form2->add_field(new text_input('First Name','first_name','',true,30));
    $form2->add_field(new text_input('Last Name','last_name','',true,30));
    $form2->add_field(new tel_input('Phone Number','phone','',true));
    $form2->add_field(new text_input('Address','address','',true,50));
    $form2->add_field(new zip_input('Zip Code','zip','',true));
    $form2->add_field(new range_input('Input a Range','range',5,true,1,10,true));
    $form2->read();
    echo '<pre>';
//    var_dump($form2);
    echo '</pre>';
  }
  catch(Exception $e)
  {
    echo 'No read for you!';

  }
}
$page = '';
if(isset($form2))
{
  $page = $form2->form($errors);
}
else
{
  $page = $form->form($errors);
}
echo '<form method="post" action="test_form.php">';
echo $page['html'];
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
