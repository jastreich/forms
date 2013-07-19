<?php
/** @file textarea.inc.php
 * Contains the class for a textarea object which extends the input object
 * @author Jeremy Streich
 **/

require_once('input.inc.php');

/** @class textarea
 * Descibes a textarea, it's sanitzation and validation
 **/
class textarea extends input
{
  /** Constructor, creates a text_area object.
   * @param string $label_text The text label on the form field.
   * @param string $name The name of the field used to identify this field in the database, and in the form.
   * @param mixed $value The current value of the field.
   * @param bool $required Boolean value, weather or not the user is required to enter a value for the field.
   * @param mixed $maxlength The maximum characters this field's value can have, and still be valid. null or empty string will make this be ignored.
   * @param mixed $sanity_func A function run on this element to sanitize it, if null will use default sanitation and validation using attributes above.
   * @param mixed $valid_func A function run on this element to validate it, if null will use default sanitation and validation using attributes above.
   **/
  public function textarea
  (
    $label_text,
    $name,
    $value = '',
    $required = false,
    $maxlength = '',
    $sanity_func = null,
    $valid_func = null
  )
  {
    $this->label_text = $label_text;
    $this->name = $name;
    $this->value = $value = '';
    $this->required = $required;
    $this->maxlength = $maxlength;
    $this->sanity_func = $sanity_func;
    $this->valid_func = $valid_func;
    $this->type = 'textarea';
    $this->min = $this->max = $this->pattern = $this->placeholder = '';
  }

  /** Generates the html for the textarea for inclusion in a form.
   * @param array $errors an accoiated array errors. If the field name appears in errors, the field's label will be a class of error.
   * @return array with two elements 'html' the HTML of the input field and 'js' any JavaScript that would assoicated with it (empty for basic input types at this time).
   **/
  public function form($errors = array())
  {
    $ret = array();
    $ret['html']  = '<fieldset>';
    $ret['html'] .= '<legend><label';
    if(array_key_exists($this->name,$errors) || $this->required)
    {
      $ret['html'] .= ' class="' 
                   .  ($this->required ? 'required' . (array_key_exists($this->name,$errors) ? ' ' : '') : '') 
                   .  (array_key_exists($this->name,$errors) ? 'error' : '') . '"';
    }
    $ret['html'] .= '>' . $this->label_text . '</label></legend>';
    $ret['html'] .= '<textarea name="' . $this->name . '">' . htmlentities(trim($this->value)) . '</textarea>';
    $ret['html'] .= '</fieldset>';
    $ret['js'] = '';
    return $ret;
  }

};

?>
