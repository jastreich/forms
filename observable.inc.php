<?php
/** @file observable.inc.php
 * Contains the interface observable.
 * @author Jeremy Streich
 **/

require_once('observer.inc.php');

/** @interface observable
 * Describes objects that are able to be observed by observer objects
 **/
interface observable
{
  /** Notify observers an $event has taken place.
   * @param $event The event that's occured.
   **/
  public function notify($event);

  /** Add an observer to watch $this object.
   * @param observer $ob The object waiting for state change.
   **/
  public function add_observer($ob);

  /** Remove an observer of $this object.
   * @param observer $ob The oberserver we want to remove.
   **/
  public function remove_observer($ob);
}

?>
