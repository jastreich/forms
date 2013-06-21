<?php
/** @file file_form.inc.php
 *  This file contains the class file_form.
 *  @author Jeremy Streich
 **/

require_once('forms.inc.php');

/** @class file_form
 * This class represents an HTML form, it's values, how it is validated and allows to read/write form data to serialized files.
 **/
class file_form extends forms
{
  /** Serializes form values for storage in variable, cookie or file
   * @return string of serialized array of values.
   * @see file_form::deserialize_data()
   **/
  public function serialize_data()
  {
    $f = array();
    $f['id'] = $this->id;
    foreach($this->fields as $k => $v)
    {
      $f[$k] = $v->value;
    }
    return serialize($f);
  }

  /** Unserializes a string, and assigns the values to the field
   * @param $s the serialized version of an associated array. Ignores values whose keys are not fields of this form.
   * @see file_form::serialize_data()
   * @see forms::values()
   **/
  public function deserialize_data($s)
  {
    $f = unserialize($s);
    $this->values($f);
  }

  /** Saves form data out to disk as serialized associated array.
   * File is saved to <form name>.data/<id>.frm
   * @see file_form::serialize_data
   **/
  public function save()
  {
    if(!is_dir($this->name . '.data'))
    {
      if(!mkdir($this->name . '.data'))
      {
        echo 'Cannot make directory?';
      }
    }
    file_put_contents ($this->name . '.data/' . $this->id . '.frm',$this->serialize_data());
  }


  /** Creates a file from this form data.
   * @see file_form::save()
   * @todo get new id
   * @todo locking.
   **/
  public function create()
  {
    $this->save();
  }

  /** Reads the values back into
   * @see file_form::deserialize_data()
   * @todo locking.
   */
  public function read()
  {
    $s = file_get_contents($this->name . '.data/' . $this->id . '.frm');
    $this->deserialize_data($s);
  }

  /** Updates the disk copy of this form
   * @see file_form::save()
   * @todo locking.
   **/
  public function update()
  {
    $this->save();
  }

  /** Deletes the saved file containg this form.
   * @return true if successful otherwise false.
   * @todo locking.
   **/
  public function delete()
  {
    return unlink($this->name . '.data/' . $this->id . '.frm');
  }
};

?>
