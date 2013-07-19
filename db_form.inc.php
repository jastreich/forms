<?php
require_once('forms.inc.php');
/** @file db_form.inc.php Contains db_form class.
 * @author Jeremy Streich
 **/

/** @class db_form 
 * Represents an HTML form, and saves form data in $db table named by the name attribue of this object.
 * @todo: decide it this is the way to do this. perhaps write the alternative menthod.
 **/
class db_form extends forms
{

  /** Inserts new record into database $db table <name>.
   * @pre $db must be a mysqli connection and <name> must exist
   */
  public function create()
  {
    global $db;
    $q  = 'insert into ';
    $r  = '';
    $q .= $this->name;
    $q .= '(';
    for($i = 0;count($fields) > $i;++$i)
    {
      $q .= $fields[$i]->name;
      $r .= '?';
      if(count($fields) > $i)
      {
        $q .= ',';
        $r .= ',';
      }
    }
    $q .= ') values (';
    $q .= $r;
    $q .= ')';

    $stmnt = $db->prepare($q);

    $f = array();
    $f[0] = '';
    for($i = 0;count($fields) > $i;++$i)
    {
      if($this->fields[$i]->type == 'number')
      {
        $f[0] .= 'i';
      }
      else
      {
        $f[0] .= 's';
      }
      $f[] = $this->fields[$i]->value;
    }

    call_user_func_array(array($stmnt,'mysqli_stmt_bind_param'),$f);

    $stmnt->execute();
    $this->id = $stmnt->insert_id;
    $stmnt->close();
  }


  /** Reads an object back from database table <name>.
   * @pre $db must be a mysqli connection and <name> must exist
   **/
  public function read()
  {
    global $db;
    $q = 'select ';
    for($i = 0;count($fields) > $i;++$i)
    {
      $q .= $fields[$i]->name;
      if(count($fields) > $i)
      {
       	$q .= ',';
      }
    }
    $q .= ' from ' . $this->name . ' where form_id = ';
    $q .= $this->id;

    $stmnt = $db->prepare($q);
    
    $stmnt->bind_param('i',$this->form_id);
    $stmnt->execute();
    $stmnt->store_result();
    $res = $stmnt->get_result():
    $r = $res->fetch_assoc();
    $res->free();
    $stmnt->close();

    foreach($r as $k=> $v)
    {
      $this->fields[$k]->value = $v;
    }
  }

  /** Updates the base record for this form.
   * @pre $db must be a mysqli connection and <name> must exist
   * @todo
   **/
  public function update()
  {
  }

  /** Deletes the record for this form.
   * @pre $db must be a mysqli connection and <name> must exist
   * @todo
   */
  public function delete()
  {
  }

  /** Generates and returns the SQL to create the table for this form.
   * @todo
   **/
  public function create_sql()
  {
  }

};


?>
