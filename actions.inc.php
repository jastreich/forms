<?php
/**
 * @file actions.inc.php
 * Contains the classes email_form_values, 
 * @author Jeremy Streich
 **/

require_once('observer.inc.php');
require_once('forms.inc.php');
require_once('database_form.inc.php');

/**
 * @class email_form_values
 * This observer object emails the values of a form when the action in condition is performed.
 **/
class email_form_values extends observer
{
  /**
   * @var string $email_to The email address to send the values.
   **/
  public $email_to;

  /**
   * @var string $email_from The email address the email will appear to be sent from.
   **/
  public $email_from;

  /**
   * @var string $email_subject The subject line of the email.
   **/
  public $email_subject;

  /**
   * @var int $condition the number of the event action to take.
   * @see action_definitions.inc.php
   **/
  public $condition;

  /**
   * constructor
   * @param string $email_to The email address to send the values.
   * @param string $email_from The email address the email will appear to be sent from.
   * @param string $email_subject The subject line of the email.
   * @param int $condition the number of the event action to take.
   **/
  public function __construct($email_to = '',$email_from = '',$email_subject = '',$condition = null)
  {
    $this->email_to = $email_to;
    $this->email_from = $email_from;
    $this->email_subject = $email_subject;
    $this->condition = $condition;
  }


  /**
   * Email the values if the passed event type matches email_form_values::$condition
   * @param event $event The event that has just occured.
   * @post if $event->event_type === $this->condition, then an email is sent. Otherwise, there is no effect.
   **/
  public function notify($event)
  {

    if($event->event_type === $this->condition || ($this->condition === null && $event->event_type == POST_VALIDATE && count($event->parameters) === 0))
    {
      if(isset($_GET['dev']))
      {
        echo 'email action fired.';
      }
      $f = $event->subject;
      $fields = $f->fields;

      // if the email_to is not an email address, it should be a field name
      $to = '';
      if(filter_var($this->email_to, FILTER_VALIDATE_EMAIL))
      {
        $to=$this->email_to;
      }
      else if(array_key_exists($this->email_to,$fields) && filter_var($fields[$this->email_to]->get_value(), FILTER_VALIDATE_EMAIL))
      {
        $to = $fields[$this->email_to]->get_value();
      }
      else
      {
        return false;
      }

     // if the email_from is not an email address, if should be a field name
      $from = '';
      if(filter_var($this->email_from, FILTER_VALIDATE_EMAIL))
      {
        $from=$this->email_from;
      }
      else if(array_key_exists($this->email_from,$fields) && filter_var($fields[$this->email_from]->get_value(), FILTER_VALIDATE_EMAIL))
      {
        $from = $fields[$this->email_from]->get_value();
      }
      else
      {
        return false;
      }

      $email_msg = $f->display_text();

      if(isset($_GET['dev']))
      {
        $email .= '\n\n' . $event->event_type;
      }

      $headers = 'From:' . $from . "\r\n" .
      'Reply-To:' . $from . "\r\n" .
      'X-Mailer: PHP/' . phpversion();
      return mail($to,$this->email_subject,$email_msg,$headers);
    }
    return false;
  }

  /**
   * Multi-mutator for the attributes of this object.
   * @param array $v An associated array with keys matching the attributes of this object, and values of the new values to assign.
   **/
  public function values($v)
  {
    if(isset($v['email_to']))
    {
      $this->email_to = $v['email_to'];
    }
    if(isset($v['email_from']))
    {
      $this->email_from = $v['email_from'];
    }
    if(isset($v['email_subject']))
    {
      $this->email_subject = $v['email_subject'];
    }
    if(isset($v['condition']))
    {
      $this->condition = $v['condition'];
    }
  }

  /**
   * Creates a form to collect the vales of this observer. If the user logged using UWM's 1Login, the person's email will be added to the HTML5 datalists on the form fields.
   * @param forms $the_form If passed, all values of email_inputs are added to a datalist on the form fields (optional).
   * @return a forms object that captures data to assign to this object using email_form_values::values()
   **/
  public function form($the_form = '')
  {
    $fields = array();
    if($the_form !== '')
    {
      $fields = $the_form->fields;
    }
    $email_fields = array();

    if(isset($_SERVER['eppn']))
    {
      $user_email = strstr($_SERVER['eppn'], '@', true) . '@uwm.edu';
      $email_fields[$user_email] = $user_email;
    }

    foreach($fields as $k => $v)
    {
      if(trim($v->type) == 'email' || trim($v->type) == 'email_input')
      {
        $email_fields[$k] = $k;
      }
    }

    $form = new forms
    (
      'Add Form Values Action',
      array
      (
        new datalist_input
        (
          new text_input('To','email_to',$this->email_to,true),
          $email_fields
        ),
        new datalist_input
        (
          new text_input('From','email_from',$this->email_from,true),
          $email_fields
        ),
        new text_input('Subject','email_subject',$this->email_subject,true)
      )
    );
    return $form;
  }

}

/**
 * @class message
 * Display a message on event. Useful for setting the accknoledgement page.
 **/
class message extends observer
{
  /**
   * @var string $msg The message.
   **/
  public $msg;

  /**
   * @var int $condition The event code of the event to display the message on.
   **/
  public $condition;

  /**
   * Constructor
   * @param string $msg The message.
   * @param int $condition The event code of the event to display the message on (optional). Default is successful for validation.
   **/
  public function message($msg,$condition=null)
  {
    $this->msg = $msg;
    $this->condition = $condition;
  }

  /**
   * Displays the message if the passed event's type matches message::$condition.
   * @param event $event The event that just occured.
   * @post if $this->condition === $event->event_type then the message is displayed, else no effect.
   **/
  public function notify($event)
  {
    if($event->event_type === $this->condition || ($this->condition === null && $event->event_type == POST_VALIDATE && count($event->parameters) === 0))
    {
      echo $this->msg;
    }
  }

  /**
   * Multi-mutator for the attributes of this object.
   * @param array $v An associated array, where the keys are name of the attributes you want to set, and the values are the new vales of the attributes.
   **/
  public function values($v)
  {
    if(isset($v['msg']))
    {
      $this->msg = $v['msg'];
    }
    if(isset($v['condition']))
    {
      $this->condition = $v['condition'];
    }
  }

  /** 
   * Return a forms object that catpures the message you want to display. For use with message::values().
   * @return a forms object to capture the message for this message object.
   **/
  public function form()
  {

    $form = new forms
    (
      'Add Message Action',
      array
      (
        new texteditor('Message','msg',$this->msg,true)
      )
    );
    return $form;
  }

}

?>
