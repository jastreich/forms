<?php
/** @file crud.inc.php
 * Contains the interface for crud
 **/

/** @interface crud
 * Describes an object that knows how to Create, Read, Update and Delete iteself.
 **/
interface crud
{
  /** Create $this object in database or file.
   * @post $this object is created in the storage medium.
   **/
  public function create();

  /** Read the object from database into $this object.
   * @post If successful $this object will have the data that was in the storage medium.
   **/
  public function read();

  /** Update the record for $this object.
   * @post The record for $this object in the storage medium will be changed to match $this object's current state.
   **/
  public function update();

  /** Delete the record for $this object.
   * @post The record for $this object will be removed from the storage medium.
   **/
  public function delete();

};

?>
