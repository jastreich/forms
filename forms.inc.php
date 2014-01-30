<?php
require_once('sessions.inc.php');
/** @file forms.inc.php
 * Contains the forms class.
 * @author Jeremy Streich
 **/

require_once('field.inc.php');
require_once('observable.inc.php');
require_once('event.inc.php');

define('PRE_FORM',1);
define('POST_FORM',2);

define('PRE_SANITIZE',3);
define('POST_SANITIZE',4);

define('PRE_VALIDATE',5);
define('POST_VALIDATE',6);

define('PRE_DISPLAY',7);
define('POST_DISPLAY',8);

define('PRE_ADD_FIELD',9);
define('POST_ADD_FIELD',10);

define('PRE_VALUES',11);
define('POST_VALUES',12);


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
  public $observers;
  public $nonce;

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
    $this->notify(new event($this,PRE_FORM,$errors));
    $ret = array();
    $ret['html'] = '';
    $ret['js'] = '';
    if('' !== $this->id)
    {
      $ret['html'] .= '<input type="hidden" name="' . $this->pre. 'id" value="' . $this->id . '" />';
    }
    $ret['html'] .= '<input type="hidden" name="' . $this->pre . 'nonce" value="' . $this->generate_nonce() . '" />';
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
    $params = array($errors,$ret);
    $this->notify(new event($this,POST_FORM,$params));
    return $ret;
  }

  /** Sanitize field values to help protect against HTML, SQL, PHP or other injection.
   * @return bool true if form could be sanitized, returns false if input was too mangled to sanitize.
   **/
  public function sanitize()
  {
    $this->notify(new event($this,PRE_SANITIZE));
    foreach($this->fields as $field)
    {
      if(false === $field->sanitize())
      {
        $ret = false;
        $this->notify(new event($this,POST_SANITIZE,$ret));
       	return $ret;
      }
    }
    $this->notify(new event($this,POST_SANITIZE));
    return true;
  }

  /** Display this form's name values pairs.
   * @return string containing an HTML table of values.
   **/
  public function display()
  {
    $this->notify(new event($this,PRE_DISPLAY));
    $ret = '<table class="table"><tbody>';
    foreach($this->fields as $field)
    {
      $ret .= $field->display();
    }
    $ret .= '</tbody></table>';
    $this->notify(new event($this,POST_DISPLAY));
    return $ret;
  }


  /** Display this form's name values pairs.
   * @return string containing an txt table of values.
   **/
  public function display_text()
  {
    $ret = $this->name . "\n";
    foreach($this->fields as $field)
    {
      $ret .= $field->display_text();
    }
    return $ret;
  }

  /** Validates the values of the input of the form.
   * @param $errors an optional array to chain form validation with other inputs and forms.
   * @return $errors the passed array with new errors encountered.
   */
  public function validate($errors = array())
  {
    $this->notify(new event($this,PRE_VALIDATE, $errors ));
    foreach($this->fields as $field)
    {
      $errors = $field->validate($errors);
    }
    $this->notify(new event($this,POST_VALIDATE,$errors ));
    if(!$this->use_nonce())
    {
      $errors['nonce'] = 'There was a problem with the nonce. Please, try again.';
      echo('<pre>');
      var_dump($this->nonce);
      var_dump($_SESSION['nonce']);
      echo('</pre>');
    }
    return $errors;
  }

  /** Adds a field to this form.
   * @param field input $f The new input, Two fields cannot have the same name.
   * @return true if field is added
   **/
  public function add_field(field $f)
  {
    $this->notify(new event($this,PRE_ADD_FIELD));
    if(!isset($this->fields[$f->name]))
    {
      $this->fields[$f->name] = $f;
      $this->notify(new event($this,POST_ADD_FIELD,$f));
      return true;
    }
    $this->notify(new event($this,POST_ADD_FIELD,false));
    return false;
  }

  /** Takes an assoicated array of values and assigns the values to input fileds, and the id of this form.
   * @param array $values an associated array of values. Ignores values of keys that aren't fields in this form.
   **/
  public function values($values)
  {
    $this->notify(new event($this,PRE_VALUES,$values));
    foreach($this->fields as $field)
    {
      $field->values($values);
    }
    if(isset($values[$this->pre . 'id']))
    {
      $this->id = $values[$this->pre . 'id'];
    }
    if(isset($values[$this->pre . 'nonce']))
    {
      $this->nonce = $values[$this->pre . 'nonce'];
    }
    $this->notify(new event($this,POST_VALUES,$values));
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
    if(isset($_GET['dev']))
    {
      echo '<br/>Notifying (' . count($this->observers). ') observers of event ' . $event->event_type . '.<br/><br/>';
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
//                     observers
    {
      $this->observers = array();
    }
    $this->observers[] = $ob;
//           observers
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

  private function expire_nonce()
  {
    for($i = 0; isset($_SESSION['nonce']) && count($_SESSION['nonce']) > $i; ++$i)
    {
      if($_SESSION['nonce'][$i]['expire'] < time())
      {
        $_SESSION['nonce'] = array_splice($_SESSION['nonce'],$i,1);
      }
    }
  }

  private function use_nonce()
  {
    $this->expire_nonce();
    for($i = 0; isset($_SESSION['nonce']) && count($_SESSION['nonce']) > $i; ++$i)
    {
      if($_SESSION['nonce'][$i]['val'] == $this->nonce)
      {
        $_SESSION['nonce'] = array_splice($_SESSION['nonce'],$i,1);
        return true;
      }
    }
    return false;
  }

  private function generate_nonce()
  {
    $this->expire_nonce();
    $bits = 256;
    $this->nonce = uniqid('', true);
    $_SESSION['nonce'][] = array('val' => $this->nonce,'expire' => (time()+18000));
    return $this->nonce;
  }

};


?>
