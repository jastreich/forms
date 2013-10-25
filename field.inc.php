<?php
/** @file field.inc.php
 * Contains the field interface.
 **/


/** @interface field
 *
 **/
interface field
{

  /** Takes an assoicated array of values and assigns the values to input fileds, and the id of this form.
   * @param array $values an associated array of values. Ignores values of keys that aren't fields in this form.
   **/
  public function values($values);

  /** Creates HTML output of a form or form part (input) from this field
   * @param array $errors The errors that have been found, should be used to add error styles or display error messages.
   * @return an associated array with two element 'html' => the HTML of this object 'js' => the Javascript of this object
   **/
  public function form($errors);

  /** Validate the value(s) of this field, and append any errors onto the passed array.
   * @param array $errors An array of errors already encountered (optional).
   * @return The passed array with any added errors.
   **/
  public function validate($errors);

  /** This function should sanitize the form for display and/or storage into a database.
   * @post the field's value should be considered 'safe'.
   **/
  public function sanitize();

  /** Display the key value pairing for this object as a table.
   * @return the HTML representation of the field
   **/
  public function display();

  /** Display the key value pairing for this object int text format.
   * @return the text representation of the field
   **/
  public function display_text();


};

?>
