<?php
/** @file forms.inc.php
 * Contains the forms class.
 * @author Jeremy Streich
 **/

require_once('field.inc.php');
require_once('observable.inc.php');
require_once('event.inc.php');

define('FORM',1);
define('SANITIZE',2);
define('VALIDATE',3);
define('DISPLAY',4);
define('ADD_FIELD',6);
define('VALUES',7);

/** @class forms
 * This class describes an HTML form, containing a collection of inputs, and does mass validation and sanitization on them.
 *
 **/
class forms implements field, observable
{
  public $name;
  public $id;
  public $pre;
  public $fields;
  private $observers;

  /** Constructor for form class
   * @param string $name The name of form.
   * @param array $fields The fields of the form, as an array of input objects.
   **/
  public function forms($name,$fields,$id='',$pre='')
  {
    $this->name = $name;
    $this->fields = $fields;
    $this->id = $id;
    $this->fields = $fields;
    $this->observers = array();
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

      if(isset($form['jquery']) && $form['jquery'])
      {
        $ret['jquery'] = true;
      }

      if(isset($form['tinymce']) && $form['tinymce'])
      {
        $ret['tinymce'] = true;
      }
    }
    $this->notify(new event($this,FORM,array($errors,$ret)));
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
        notify(new event($this,SANITIZE,false));
       	return false;   
      }
    }
    $this->notify(new event($this,SANITIZE,true));
    return true;
  }

  /** Display this form's name values pairs.
   * @return string containing an HTML table of values.
   **/
  public function display()
  {
    $ret = '<table><tbody>';
    foreach($this->fields as $field)
    {
      $ret .= $field->display();
    }
    $ret .= '</tbody></table>';
    $this->notify(new event($this,DISPLAY));
    return $ret;
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
    $this->notify(new event($this,VALIDATE, 0 == count($errors) ));
    return $errors;
  }

  /** Adds a field to this form.
   * @param field input $f The new input, Two fields cannot have the same name.
   * @return true if field is added
   **/
  public function add_field(field $f)
  {
    if(!isset($this->fields[$f->name]))
    {
      $this->fields[$f->name] = $f;
      $this->notify(new event($this,ADD_FIELD,$f));
      return true;
    }
    $this->notify(new event($this,ADD_FIELD,false));
    return false;
  }

  /** Takes an assoicated array of values and assigns the values to input fileds, and the id of this form.
   * @param array $values an associated array of values. Ignores values of keys that aren't fields in this form.
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
        if(isset($this->fields[$k]))
        {
          $this->fields[$k]->set_value($v);
        }
        else
        {
          if(isset($_GET['dev']))
          {
            echo $k . ' not found in object.';
          }
        }
      }
    }
    $this->notify(new event($this,VALUES,$values));
  }

  /** Notify observers an $event has taken place.
   * @param $event The event that's occured.
   **/
  public function notify($event)
  {
    if(!isset($this->observers))
    {
      $this->observers = array();
    }
    foreach($this->observers as $ob)
    {
      $ob->notify($event);
    }
  }

  /** Add an observer to watch $this object.
   * @param observer $ob The object waiting for state change.
   **/
  public function add_observer($ob)
  {
    if(!isset($this->observers))
    {
      $this->observers = array();
    }
    $this->observers[] = $ob;
  }

  /** Remove an observer of $this object.
   * @param observer $ob The oberserver we want to remove.
   * @return True if found and removed, false if not.
   **/
  public function remove_observer($ob)
  {
    if(!isset($this->observers))
    {
      $this->observers = array();
    }
    for($i = 0;count($this->observers) > $i; ++$i)
    {
      if($this->observers[$i] === $ob)
      {
        array_splice($this->observers,$i,1);
        return true;
      }
    }
    return false;
  }


};


?>