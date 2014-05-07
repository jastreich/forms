<?php
/** @file input_group.inc.php Holds the class for input_group.
 * @author Jeremy Streich
 **/

require_once('input.inc.php');

/** @class input_group
 * Defines a group of related inputs like raido buttons or checkboxes that have the same name, but different values.
 **/
class input_group extends input
{
  public $value_list;

  /** Constructor for input_group object.
   * @param $label_text The label for the group, will be displayed as the legend in the rendered html.
   * @param $name The name of the item in html, and the fields of the form.
   * @param $value_list the values for the input tags.
   * @param $type the HTML type of input each will be.
   * @param $value an array or single value, the currently checked/activated inputs.
   * @param $required boolean on weather or not a selection is required.
   * @param $placeholder The placeholder text for this item. null or empty string will suppress this attribute from being printed.
   * @param $sanity_func A function run on this element to sanitize it, if null will use default sanitation and validation using attributes above.
   * @param $valid_func A function run on this element to validate it, if null will use default sanitation and validation using attributes above.
   * @todo work out required, and single values.
   **/
  public function input_group
  (
    $label_text,
    $name,
    $value_list,
    $type = 'checkbox',
    $value = '',
    $required = '',
    $placeholder = '',
    $sanity_func = null,
    $valid_func = null
  )
  {
    $this->label_text = $label_text ;
    $this->name = $name;
    $this->value_list = $value_list;
    $this->type = $type;
    $this->value = $value;
    $this->required = $required;
    $this->placeholder = $placeholder;
    $this->valid_func   = $valid_func;
  }

  /** Generates the HTML for this input to be included in a form.
   * @param array $errors an array of accumulated errors.
   * @return array with two elements 'html'=> The HTML for the object, 'js' => Any JS for the element (currently none).
   **/
  public function form($errors = array())
  {
    $ret = array();
    $ret['js'] = '';
    $ret['html'] = '<fieldset><legend>' . $this->label_text . '</legend>';
    foreach($this->value_list as $k => $v)
    {
      $ret['html'] .= '<label';
      if(array_key_exists($this->name,$errors) || $this->required)
      {
        //Think about required display...
        $ret['html'] .= ' class="'
                     .  ($this->required ? 'required' . (array_key_exists($this->name,$errors) ? ' ' : '') : '')
                     .  (array_key_exists($this->name,$errors) ? 'error' : '') . '"';
      }
      $ret['html'] .= '>';
      $ret['html'] .= '<input type="' . $this->type . '" name="' . $this->name . '[]" value="' . $k . '"';

      $ret['html'] .= (isset($this->value) && '' != $this->value && in_array($k,$this->value)? ' checked' : '');

      $ret['html'] .= ($this->required ? ' required' : '');
      $ret['html'] .= '/>';
      $ret['html'] .= '&nbsp;' . $v . '</label>';
    }
    $ret['html'] .= '</fieldset>';
    return $ret;
  }

  /** Display the name value pair
   * @return A string containing the HTML formated name value pair for this input.
   **/
  public function display()
  {
    $list = '';
    if(isArray($this->value))
    {
      foreach($this->value as $v)
      {
        $list .= '<li>' . $v . '</li>';
      }
    }
    else
    {
      parent::display();
    }
    return '<tr><td class="field_name">' . $this->name . '</td><td class="field_value"><ul>' . $list . '</ul></td></tr>';
  }


  /** Display the name value pair
   * @return A string containing the text formated name value pair for this input.
   **/
  public function display_text()
  {
    $list = '';
    if(is_array($this->value))
    {
      foreach($this->value as $v)
      {
        $list .= "\t" . $v . "\n";
      }
    }
    else
    {
      parent::display();
    }
    return $this->label_text . ":\n" . $list;
  }




  /** Sanitize this form's values
   * @todo Write this.
   * @bug always returns true.
   **/
  public function sanitize()
  {
    return true;
  }

  /** Validate this form's values
   * @todo Write this.
   * @bug always returns true.
   **/
  public function validate($errors = array())
  {
    if($this->valid_func != null)
    {
if(isset($_GET['dev']))
{
  echo('Trying to validate group using passed validate function');
}
      $ret = call_user_func($this->valid_func,$this->value);
      if($ret != '')
      {
        $errors[$this->name] = $ret;
        return $errors;
      }
    }

    return $errors;
  }
};

?>
