<?php
/**
 * @file matrix_input.inc.php
 * Contains the maxtrix_input class.
 * @author Jeremy Streich
 **/

require_once('input.inc.php');

/**
 * @class matrix_input
 * This class represents a matrix_input.
 **/
class matrix_input extends input
{
  private $inputs;
  private $value_list;

  /**
   * @var array $table_attributes Attributes to the able elements. Where $table_attributes['attribute'] = 'value'
   **/
  public $table_attributes;

  /**
   * @var string $beofre_table HTML to display before the form/table.
   **/
  public $before_table;

  /**
   * @var string $after_table HTML to display after the form/table.
   **/
  public $after_table;

  /**
   * Constructor
   * @param array $inputs An array of Labels, with index of the input name.  Such that $inputs[$name] = $label
   * @param array $value_list An array of the options for each input. Such that $value_list[$option] = $value
   * @param string $type What type of input each should be. (Optional) Default is  'radio'.
   * @param boolean $required weather the inputs are required or not. (Optional) Default is true.
   * @param $sanity_func A function to run on this element to sanitize it.
   * @param $valid_func A function to run on this element to validate it.
   **/
  public function __construct($inputs,$value_list,$type='radio',$required=true,$sanity_func = null,$valid_func=null)
  {
    $this->inputs = $inputs;
    $this->value_list = $value_list;
    $this->type = $type;
    $this->required = $required;
    $this->placeholder = '';
    $this->sanity_func = $sanity_func;
    $this->valid_func = $valid_func;

    $this->table_attributes = array();
    $this->attributes = array();
  }

  /**
   * Display the form.
   * @param array $errors An array of accumulated validation errors. (Optional)
   * @return an associative array where 'html' => The HTML of the input, and 'js' => any necessary javascript.
   * @see input::form()
   * @todo Selected vales.
   **/
  public function form($errors = array())
  {
    $ret = array();
    $ret['html'] = '';
    $ret['js'] = '';


    $ret['html'] = $this->before_table;
    $ret['html'] .= '<table class="table table-stripped"';
    foreach($this->table_attributes as $k => $v)
    {
      $ret['html'] .= $k . '="' . $v . '"';
    }
    $ret['html'] .= '>';

    $ret['html'] .= '<thead><tr><th>Question</th>';
    $f_inputs = array();

    $attr_line = '';
    foreach($this->attributes as $k => $v)
    {
      $attr_line .= ' ' . $k . '="' . $v . '"';
    }

    foreach($this->value_list as $k => $v)
    {
      $ret['html'] .= '<th>' . $v . '</th>';
      $f_inputs[$k] = '<input type="' . $this->type . '" value="' . $v . '" ' 
                    . ($this->required ? 'required ' : '') 
                    . (isset($this->values[$k]) && $this->values[$k] == $v ? 'checked="checked"' : '')
                    . $attr_line;
    }

    $ret['html'] .= '</tr></thead><tbody>';

    foreach($this->inputs as $name => $label)
    {
      $ret['html'] .= '<tr><td>' . $label . '</td>';
      foreach($f_inputs as $html)
      {
        $ret['html'] .= '<td>' . $html . ' name=' . $name . '[]"/></td>';
      }
    }

    $ret['html'] .= '</tbody></table>';
    $ret['html'] .= $this->after_table;

    return $ret;
  }

  /**
   * Takes an associated array of vales and assignes the values to input fields...
   * @param array $values an associated array of values. Ignores keys that aren't in this matrix_input.
   **/
  public function values($values)
  {
    foreach ($values as $key => $value)
    {
      foreach($this->inputs as $name => $label)
      {
        if($key == $name)
        {
          $this->value[$key] = $value;
        }
      }
    }
  }

}

?>