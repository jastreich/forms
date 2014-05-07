<?php
/** @file private_get_input.inc.php
 * @author Jeremy Streich
 **/

require_once('get_input.inc.php');

/** @class private_get_input
 * This class represents a hidden input that reads its value from the $_GET[] global array on creation, but when displaying display_text() shows no output.
 *
 **/
class private_get_input extends get_input
{
  function public __construct
  (
    $name,
    $sanity_func = null,
    $valid_func = null
  )
  {
    parent::__construct($name,(isset($_GET[$name])?$_GET[$name]:''),$sanity_func,$valid_func);
  }

  function display_text()
  {
    return '';
  }

?>
