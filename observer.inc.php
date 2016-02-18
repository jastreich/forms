<?php
/** @file observer.inc.php
 * Contains the observer class.
 * @author Jeremy Streich
 **/

require_once('action_definitions.inc.php');

/** @class observer
 * Impliments the observer in the observer patters.
 **/
class observer
{
  private $func;

  /** Constructor for the observer class.
   * @param function $f The function to call when an event is fired.
   **/
  public function __construct($f)
  {
    $this->func = $f;
  }

  /** Mutator function, to change the function that is called when the event is fired.
   * @param function $f The function to call when an event is fired.
   **/
  public function set_func($f)
  {
    $this->func = $f;
  }

  /** Take action. Called when an event is fired.
   * @param event $event The event that just occured.
   **/
  public function notify($event)
  {
    $this->func($event);
  }
};

?>
