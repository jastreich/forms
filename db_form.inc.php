<?php
/**
 * @file db_form.inc.php Contains db_form class.
 * @author Jeremy Streich
 **/

require_once('crud_form.inc.php');
require_once('crud.inc.php');

ini_set('allow_call_time_pass_reference','true');

/** 
 * @class db_form 
 * Represents an HTML form, and saves form data in $db table named by the name attribue of this object.
 **/
class db_form extends crud_form implements crud
{

  /**
   * Inserts new record into database $db table.
   * @pre $db must be a mysqli connection and the table must exist
   * @return true if successful, otherwise false.
   */
  public function create()
  {
    global $db;
    $this->notify(new event($this,PRE_CREATE,array('table'=>$this->name)));
    $ret = true;
    $q  = 'insert into ';
    $r  = '';
    $q .= $this->name;
    $q .= '(';

    $f = array();
    $f[0] = '';
    $count_fields = count($this->fields);
    $i = 0;
    foreach($this->fields as $n => $field)
    {
      $q .= $field->name;
      $r .= '?';

      if($i + 1 < $count_fields)
      {
        $q .= ',';
        $r .= ',';
      }

      if($field->type == 'number' || $field->type == 'range')
      {
        $f[0] .= 'i';
      }
      else
      {
        $f[0] .= 's';
      }

      if(is_array($field->value))
      {
        $f[] = &$this->fields[$n]->value;
      }
      else
      {
        $f[] = &$this->fields[$n]->value;
      }
      ++$i;
    }
    $q .= ') values (';
    $q .= $r;
    $q .= ')';

    $stmnt = $db->prepare($q) or $ret = false;

    call_user_func_array(array($stmnt,'bind_param'),$f) or $ret = false;

    $stmnt->execute() or $ret = false;

    if($ret)
    {
      $this->id = $stmnt->insert_id;
      $this->notify(new event($this,POST_CREATE,array('table'=>$this->name,'ids'=>array($this->id))));
    }
    else
    {
      $this->notify(new event($this,FORMS_ERROR,array('message' => 'Error inserting into ' . $this->name)));
    }
    $stmnt->close();
    return $ret;
  }


  /**
   * Reads an object back from database table.
   * @pre $db must be a mysqli connection and the table must exist
   * @return true if successful, otherwise false.
   **/
  public function read()
  {
    global $db;
    $this->notify(new event($this,PRE_READ,array('table'=>$this->name,'ids' => array($this->id))));
    $ret = true;
    $q = 'select ';
    $count_fields = count($this->fields);
    $i = 1;
    foreach($this->fields as $name => $field)
    {
      $q .= $name;
      if($count_fields > $i++)
      {
       	$q .= ',';
      }
    }
    $q .= ' from ' . $this->name . ' where id = ?';

    $stmnt = $db->prepare($q) or $ret=false;
    $stmnt->bind_param('i',$this->id) or $ret = false;
    $stmnt->execute() or $ret=false;

    $data = $stmnt->result_metadata();
    $fields = array();
    $out = array();

    foreach($this->fields as $name => $field)
    {
      $f_sql[] = &$out[$name];
    }

    call_user_func_array(array($stmnt,'bind_result'),$f_sql);
    $stmnt->fetch() or $ret = false;

    $stmnt->close();
    if($ret)
    {
      $this->values($out);
      $this->notify(new event($this,POST_READ,array('table' => $this->name,'ids' => array($this->id))));
    }
    else
    {
      $this->notify(new event($this,FORMS_ERROR,array('message' => 'Error reading from ' . $this->name)));
    }
    return $ret;
  }

  /**
   * Updates the base record for this form.
   * @pre $db must be a mysqli connection and <name> must exist
   **/
  public function update()
  {
    global $db;
    $this->notify(new event($this,PRE_READ,array('table'=>$this->name,'ids' => array($this->id))));
    $ret = true;
    $q = 'update ' . $this->name . ' set ';
    $count_fields = count($this->fields);
    $i = 0;
    $f = array();
    $f[0] = '';

    foreach($this->fields as $k => $v)
    {
      $i = $i+1;
      $q .= $k . ' = ?' . ( $i < $count_fields ? ', ' : ' ' );

      if($v->type == 'number' || $v->type == 'range')
      {
        $f[0] .= 'i';
      }
      else
      {
        $f[0] .= 's';
      }
      $f[] = &$this->fields[$k]->value;
    }

    $q .= ' where id = ?';
    $f[0] .= 'i';
    $f[] = &$this->id;

    $stmnt = $db->prepare($q) or $ret=false;

    call_user_func_array(array($stmnt,'bind_param'),$f) or $ret=false;

    $stmnt->execute() or $ret=false;
    $stmnt->close();
    if($ret)
    {
      $this->notify(new event($this,POST_UPDATE,array('table' => $this->name,'ids' => array($this->id))));
    }
    else
    {
      $this->notify(new event($this,FORMS_ERROR,array('message' => 'Error updating ' . $this->name)));
    }
    return $ret;
  }

  /**
   * Deletes the record for this form.
   * @pre $db must be a mysqli connection and <name> must exist
   */
  public function delete()
  {
    global $db;
    $this->notify(new event($this,PRE_DELETE,array('table'=>$this->name, 'ids' => array($this->id) )));
    $ret = true;
    $q =  'delete from ' . $this->name . ' where id = ?';
    $stmnt = $db->prepare($q) or $ret=false;
    $stmnt->bind_param('i',$this->id) or $ret=false;
    $stmnt->execute() or $ret=false;
    $stmnt->close();
    if($ret)
    {
      $this->notify(new event($this,POST_DELETE,array('table' => $this->name,'ids' => array($this->id))));
    }
    else
    {
      $this->notify(new event($this,FORMS_ERROR,array('message' => 'Error deleting from ' . $this->name)));
    }
    return $ret;
  }

  /**
   * Generates and returns the SQL to create the table for this form.
   * @todo
   **/
  public function create_sql()
  {
    $q = 'create ' . $this->name . ' (';
    foreach($this->fields as $k => $v)
    {
      $q .= '$k' . ' ' . ($v->type == 'number' || $v->type == 'range' ? 'int' : 'varchar');
    }
  }

};


?>