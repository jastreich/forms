<?php
/** @file hidden_input.inc.php
 * This file contains the hidden_input class.
 * @author Jeremy Streich
 **/

require_once('field.inc.php');

/** @class hidden_input
 *  @brief The class hidden_input describes a form element, it's attributes and how it is validated and sanitized.  Meant to be used with the class forms or it's dervative classes.
 **/
class hidden_input extends input
{

  /** Constructor, creates an hidden_input object.
   * @param string $name The name of the field used to identify this field in the database, and in the form.
   * @param mixed $value The current value of the field.
   * @param mixed $sanity_func A function run on this element to sanitize it, if null will use default sanitation and validation using attributes above.
   * @param mixed $valid_func A function run on this element to validate it, if null will use default sanitation and validation using attributes above.
   **/
  public function hidden_input
  (
    $name,
    $value = '',
    $sanity_func = null,
    $valid_func = null
  )
  {
    $this->label_text = '';
    $this->name = $name;
    $this->type = 'hidden';
    $this->value = $value;
    $this->min = '';
    $this->max = '';
    $this->maxlength = '';
    $this->pattern = '';
    $this->required = '';
    $this->placeholder = '';
    $this->sanity_funct = $sanity_func;
    $this->valid_func = $valid_func;
  }

  /** Generates the html for the hidden_input for inclusion in a form.
   * @param array $errors an accoiated array errors. If the field name appears in errors, the field's label will be a class of error.
   * @return array with two elements 'html' the HTML of the hidden_input field and 'js' any JavaScript that would assoicated with it (empty for basic hidden_input types at this time).
   **/
  public function form($errors = array())
  {
    $ret = array();
    $ret['js'] = '';
    $ret['html'] = '<input type="' . $this->type . '" name="' . $this->name . '"';
    $ret['html'] .= ('' !== $this->value ? ' value="' . htmlentities(trim($this->value)) . '"' : '');
    $ret['html'] .= '/>';
    return $ret;
  }

  /** Display the name value pair
   * @return A string containing the formated name value pair for this hidden_input.
   **/
  public function display()
  {
    return '<tr><td class="field_name">' . $this->name . '</td><td class="field_value">' . htmlentities(trim($this->value)) . '</td></tr>';
  }

};

?>
