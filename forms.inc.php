<?php
/** @file forms.inc.php
 * Contains the forms class.
 * @author Jeremy Streich
 **/


/** @class forms This class describes an HTML form, containing a collection of inputs, and does mass validation and sanitization on them.
 *
 **/
class forms
{
  public $name;
  public $id;
  public $pre;
  public $fields;


  /** Constructor for form class
   * @param $name The name of form.
   * @param #fields The fields of the form, as an array of input objects.
   **/
  public function forms($name,$fields,$id='',$pre='')
  {
    $this->name = $name;
    $this->fields = $fields;
    $this->id = $id;
    $this->fields = $fields;
  }

  /** Returns the HTML and JavaScript for this form.
   * @param $errors an array of errors, used to add class to fields which have an error
   * @return array of strings with 'html' => the HTML of the form, and 'js' => any JS the form elements may need
   * @see input::form()
   **/
  public function form($errors = array())
  {
    $ret = array();
    $ret['html'] = '';
    $ret['js'] = '';
    if('' !== $this->id)
    {
      $ret['html'] .= '<input type="hidden" name="id" value="' . $this->id . '" />';
    }
    foreach($this->fields as $field)
    {
      $form = $field->form($errors);
      $ret['html'] .= $form['html'];
      $ret['js'] .= $form['js'];
    }
    return $ret;
  }

  /** Sanitize field values to help protect against HTML, SQL, PHP or other injection.
   * @return bool true if form could be sanitized, returns false if input was too mangled to sanitize.
   **/
  public function sanitize()
  {
    foreach($this->fields as $field)
    {
      if(false === $field->sanitize())
      {
       	return false;   
      }
    }
    return true;
  }

  /** Validates the values of the input of the form.
   * @param $errors an optional array to chain form validation with other inputs and forms.
   * @return $errors the passed array with new errors encountered.
   */
  public function validate($errors = array())
  {
    foreach($this->fields as $field)
    {
      $errors = $field->validate($errors);
    }
    return $errors;
  }

  /** Adds a field to this form.
   * @param $f the new input, Two fields cannot have the same name.
   * @return true if field is added
   **/
  public function add_field($f)
  {
    if(!isset($this->fields[$f->name]))
    {
      $this->fields[$f->name] = $f;
      return true;
    }
    return false;
  }

  /** Takes an assoicated array of values and assigns the values to input fileds, and the id of this form.
   * @param values an associated array of values. Ignores values of keys that aren't fields in this form.
   **/
  public function values($values)
  {
    foreach($values as $k => $v)
    {
      if('id' == $k)
      {
        $this->id = $v;
      }
      else
      {
        if(isset($fields[$k]))
        {
          $fields[$k]->value = $v;
        }
      }
    }
  }

};


?>
