<?php
require_once('observer.inc.php');
require_once('forms.inc.php');
require_once('database_form.inc.php');


class email_form_values extends observer
{
  public $email_to;
  public $email_from;
  public $email_subject;
  public $condition;

  public function email_form_values($email_to = '',$email_from = '',$email_subject = '',$condition = null)
  {
    $this->email_to = $email_to;
    $this->email_from = $email_from;
    $this->email_subject = $email_subject;
    $this->condition = $condition;
  }

  public function notify($event)
  {
    if(isset($_GET['dev']))
    {
      echo 'notify called.';
    }

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

  public function form($the_form)
  {
    $fields = $the_form->fields;
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


class message
{
  public $msg;
  public $condition;

  public function message($msg,$condition=null)
  {
    $this->msg = $msg;
    $this->condition = $condition;
  }

  public function notify($event)
  {
    if(isset($_GET['dev']))
    {
      echo 'notify called.';
    }

    if($event->event_type === $this->condition || ($this->condition === null && $event->event_type == POST_VALIDATE && count($event->parameters) === 0))
    {
      echo $this->msg;
    }
  }

  public function values($v)
  {
    if(isset($_GET['dev']))
    {
      echo 'values called with: <br/>';
      var_dump($v);
      echo '<br/>';
    }
    if(isset($v['msg']))
    {
      $this->msg = $v['msg'];
      if(isset($_GET['dev']))
      {
        echo 'Message set. <br/>';
      }
    }
    if(isset($v['condition']))
    {
      $this->condition = $v['condition'];
    }
  }

  public function form($the_form)
  {
    $fields = $the_form->fields;
    $email_fields = array();

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


/*
class email_message extends email_form_values
{
  public $email_msg;


  public static function email_message()
  {
  }
}
*/
?>
