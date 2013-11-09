<?php
/** @file get_input.inc.php
 * Contains the get_input class.
 **/
require_once('hidden_input.inc.php');

/** @class get_input
 * An hidden_input that reads its value from the $_GET global array on creation.
 **/
class get_input extends hidden_input
{
  /** Constructor
   * @param string $name the name of the input.
   * @param function $sanity_func a sanitization function (optional)
   * @param function $valid_func a validation function (optional)
   **/
  public function get_input
  (
    $name,
    $sanity_func = null,
    $valid_func = null
  )
  {
    parent::hidden_input($name,(isset($_GET[$name])?$_GET[$name]:''),$sanity_func,$valid_func);
  }
}

?>
