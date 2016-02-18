<?php
/** @file database_form.inc.php
 * @author Jeremy Streich
 **/

require_once('forms.inc.php');
require_once('crud.inc.php');
require_once('actions.inc.php');

/** 
 * @class database_form 
 * This class allows the both the structure and the data for this form to be written out to a database.
 *
 **/
class database_form extends forms implements crud
{

  /** Constructor
   * @see forms::__construct
   **/
  public function __construct($name,$fields,$id='',$pre='')
  {
    parent::__construct($name,$fields,$id,$pre);
  }



  /** Writes form structure into database $db to table forms.
   * @pre Must have mysqli database connection object in scope named '$db'.
   * @post The form in serialized form will be written to the database.
   **/
  public function create_form()
  {
    global $db;
    $this->notify(new event($this,PRE_CREATE_FORM));
    $stmnt = $db->prepare('insert into forms (name,form) values (?,?)');
    $t = serialize($this);
    $stmnt->bind_param('ss',$this->name,$t);
    $stmnt->execute();
    $stmnt->close();
    $this->notify(new event($this,POST_CREATE_FORM));
  }

  /** Reads form structure out of database $db table forms.
   * @pre Must have mysqli database connection object in scope named '$db'.
   * @post This form will take on the structure that was saved to the database.
   **/
  public function read_form()
  {
    global $db;
    $this->notify(new event($this,PRE_READ_FORM));
    $stmnt = $db->prepare('select form from forms where name = ?');
    echo $db->error;
    $stmnt->bind_param('s',$this->name);
    echo $stmnt->error;
    echo $db->error;
    $stmnt->execute();
    echo $stmnt->error;
    echo $db->error;
    $stmnt->bind_result($t);
    echo $stmnt->error;
    $stmnt->fetch();
    echo $stmnt->error;
    $theform = unserialize($t);
    if(isset($_GET['dev']))
    {
      echo $stmnt->error;
      var_dump($t);
    }
    $stmnt->close();
    $this->fields = $theform->fields;
    $this->name = $theform->name;
    $this->id = $theform->id;
    $this->observers = $theform->observers;
//           observers             observers
    $this->notify(new event($this,POST_READ_FORM));
  }

  /** Writes form structure into database $db to table forms.
   * @pre Must have mysqli database connection object in scope named '$db'.
   * @post The form in serialized form will be written to the database.
   **/
  public function update_form()
  {
    global $db;
    $this->notify(new event($this,PRE_UPDATE_FORM));
    $stmnt = $db->prepare('update forms set form = ? where name = ?');
    $t = serialize($this);
    $stmnt->bind_param('ss',$t,$this->name);
    $stmnt->execute();
    $stmnt->close();
    $this->notify(new event($this,POST_UPDATE_FORM));
  }

  /** Delete this form from the database $db table forms
   * @pre Must have mysqli database connection object in scope named '$db'.
   * @post this form will no loger be in the database.
   **/
  public function delete_form()
  {
    global $db;
    $this->notify(new event($this,PRE_DELETE_FORM));
    $stmnt = $db->prepare('delete from forms where name = ?');
    $stmnt->bind_param('s',$this->name);
    $stmnt->execute();
    $stmnt->close();
    $this->notify(new event($this,POST_DELETE_FORM));
  }

  /** Write the values of this form out to database $db table forms_data.
   * @pre Must have mysqli database connection object in scope named '$db'.
   * @post This forms data will be written out to the database.
   **/
  public function create()
  {
    global $db;
    $this->notify(new event($this,PRE_CREATE));
if(isset($_GET['dev']))
{
  echo 'database_form::create()';
}
    // Aquire lock, creating file if it doesn't exist.
    $fp = fopen('/tmp/dblock.txt', 'w');
    // Wait for lock. This is not fair lock, so I don't know if it is worth it.
    $i=0;
    if(!flock($fp, LOCK_EX))
    {
        die('could not aquire lock.'); // Die.
    }

    $stmnt = $db->prepare('select max(id)+1 from forms_data');
    $stmnt->execute();
    $stmnt->bind_result($this->id);
    //$stmnt->fetch();
    if(!$stmnt->fetch() || !isset($this->id) || $this->id === null )
    {
      $this->id = 1;
if(isset($_GET['dev']))
{
  echo 'Set to 1.';
}
    }
    $stmnt->close();

    $stmnt = $db->prepare('insert into forms_data (id,form_name,name,value) values (?,?,?,?)');
    $stmnt->bind_param('isss',$this->id,$this->name,$k,$v);
$ret = true;
    foreach($this->fields as $k => $fv)
    {

      if(is_array($fv->get_value()))
      {
        $v = serialize($fv->get_value());
      }
      else
      {
        $v = $fv->get_value();
      }
      $ret = $ret && $stmnt->execute();
    }

    $stmnt->close();
    flock($fp, LOCK_UN);
    fclose($fp);
    $this->notify(new event($this,POST_CREATE));
    return $ret;
  }

  /** Read the data into this form from database $db table forms_data
   * @pre Must have mysqli database connection object in scope named '$db'.
   * @post This object will be populated with data from the database.
   **/
  public function read()
  {
    global $db;
    $this->notify(new event($this,PRE_READ));
    $stmnt = $db->prepare('select name, value from forms_data where id = ? and form_name = ?');
    $stmnt->bind_param('is',$this->id,$this->name);
    $stmnt->execute();
    $stmnt->bind_result($k,$v);
    while($stmnt->fetch())
    {
      if(isset($this->fields[$k]))
      {
        if($this->fields[$k]->type == 'radio' || $this->fields[$k]->type == 'checkbox')
        { 
          
          $ans = unserialize($v);
          if($ans !== false)
          {
            $this->fields[$k]->set_value($ans);
          }
          else
          {
            $this->fields[$k]->set_value(explode(',',$v));
          }
        }
        else
        {
          $this->fields[$k]->set_value($v);
        }
      }
    }
    $stmnt->close();
    $this->notify(new event($this,POST_READ));
  }

  /** Update the data in the database to match the values of this form
   * @pre Must have mysqli database connection object in scope named '$db'.
   * @post the database records for the values of this form will be updated to match the values in this form.
   **/
  public function update()
  {
    global $db;
    $this->notify(new event($this,PRE_UPDATE));
    $stmnt = $db->prepare('update forms_data set value = ? where name = ? and id = ?');
    $stmnt->bind_param('ssi',$v,$k,$this->id);
    $ret = true;
    foreach($this->fields as $k => $fv)
    {
      $v = $fv->get_value();
      $ret = $ret && $stmnt->execute();
    }
    $stmnt->close();
    $this->notify(new event($this,POST_UPDATE));
    return $ret;
  }

  /** Deletes the data record for this form.
   * @pre Must have mysqli database connection object in scope named '$db'.
   * @post The data for for this form will be deleted.
   **/
  public function delete()
  {
    global $db;
    $this->notify(new event($this,PRE_DELETE));
    $stmnt = $db->prepare('delete from forms_data where id = ?');
    $stmnt->bind_param('i',$this->id);
    $stmnt->execute();
    $stmnt->close();
    $this->notify(new event($this,POST_DELETE));
  }


  public function display_structure()
  {
    $ret = array();
    $ret['html']  = '<table class="table"><thead>';
    $ret['html'] .= '<tr>';
    $ret['html'] .= '<th>Label</th>';
    $ret['html'] .= '<th>Name</th>';
    $ret['html'] .= '<th>Type</th>';
    $ret['html'] .= '<th>Value</th>';
    $ret['html'] .= '<th>Required</th>';
    $ret['html'] .= '<th>Maximum Length</th>';
    $ret['html'] .= '<th>Minimum</th>';
    $ret['html'] .= '<th>Maximum</th>';
    $ret['html'] .= '<th>RegEx Pattern</th>';
    $ret['html'] .= '<th>Placeholder Text</th>';
    $ret['html'] .= '</tr>';
    $ret['html'] .= '</thead><tbody>';
    foreach($this->fields as $field)
    {
      $ret['html'] .= '<tr>';
      $ret['html'] .= '<td>' . $field->label_text . '</td>';
      $ret['html'] .= '<td>' . $field->name . '</td>';
      $ret['html'] .= '<td>' . $field->type . '</td>';
      $ret['html'] .= '<td>' . $field->value . '</td>';
      if(is_array($field->required))
      {
        $ret['html'] .= '<td>' . $field->required[0] . '</td>';
      }
      else
      {
        $ret['html'] .= '<td>' . $field->required . '</td>';
      }
      $ret['html'] .= '<td>' . $field->maxlength . '</td>';
      $ret['html'] .= '<td>' . $field->min . '</td>';
      $ret['html'] .= '<td>' . $field->max . '</td>';
      $ret['html'] .= '<td>' . $field->pattern . '</td>';
      $ret['html'] .= '<td>' . $field->placeholder . '</td>';
      $ret['html'] .= '</tr>';
    }
    $ret['html'] .= '</tbody></table>';
    return $ret;
  }

  /** Returns HTML for all form data for this specific form.
   * @pre Must have mysqli database connection object in scope named '$db'.
   * @return array containting 'html' => The html table for all forms of this type filled out and 'js' => Any JavaScript to make the table more functional.
   **/
  public function display_table()
  {
    global $db;
    $this->notify(new event($this,PRE_DISPLAY_TABLE));

    $t_values = array();
    $ret = array();

    $stmnt = $db->prepare('select id, name, value from forms_data where form_name = ? order by id');
    $stmnt->bind_param('i',$this->name);
    $stmnt->execute();
    $stmnt->bind_result($id,$name,$value);
    while($stmnt->fetch())
    {
      if(!isset($t_values[$id]))
      {
        $t_values[$id] = array();
      }
      $t_values[$id][$name] = $value;
    }
    $stmnt->close();

    $ret['html'] = '<table class="table"><thead><tr><td>&nbsp;</td>';
    foreach($this->fields as $k => $v)
    {
      $ret['html'] .= '<th>' . $v->label_text . '</th>';
    }
    $ret['html'] .= '</tr></thead><tbody>';

    if(isset($_GET['dev']))
    {
      echo '<pre>';
      var_dump($t_values);
      echo '</pre>';
    }

    foreach($t_values as $i => $row)
    {
      $ret['html'] .= '<tr class="formdata" data-id="' . $i . '">';
      $ret['html'] .= '<td><input type="checkbox" name="select" value="' . $i . '" /></td>';
      foreach($this->fields as $k => $v)
      {
        if(isset($_GET['dev']))
        {
          echo $k . ': ';
        }
        $ret['html'] .= '<td>';
        if(isset($row[$k]))
        {
          $ret['html'] .= $row[$k];
          if(isset($_GET['dev']))
          {
            echo $row[$k];
          }
        }
        if(isset($_GET['dev']))
        {
          echo '<br/>';
        }
        $ret['html'] .= '</td>';
      }
      $ret['html'] .= '</tr>';
    }
    $ret['html'] .= '</tbody></table>';
    $this->notify(new event($this,POST_DISPLAY_TABLE,$ret));
    return $ret;
  }

}

?>
