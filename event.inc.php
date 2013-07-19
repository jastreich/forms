<?php
/** @file event.inc.php
 * This file contains the event class
 **/

/** @class event
 * This describes an event in the observer pattern to pass information between the observable and observer.
 **/
class event
{
  public $subject;
  public $event_type;
  public $parameters;

  public function event($subject,$event_type,$parameters = null)
  {
    $this->subject = $subject;
    $this->event_type = $event_type;
    $this->parameters = $parameters;
  }
}

?>
