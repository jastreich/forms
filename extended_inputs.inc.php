<?php
/** @file extended_inputs.inc.php
 * @author Jeremy Streich
 **/

require_once('input.inc.php');

/** @class text_input 
 * convience function for creating text inputs
 * 
 **/
class text_input extends input
{
  public function text_input
  (
    $label_text,
    $name,
    $value,
    $required = false,
    $maxlength = '',
    $pattern = '',
    $placeholder = '',
    $sanity_func = null,
    $valid_func = null

  )
  {
    parent::input($label_text,$name,'text',$value,$required,$maxlength,'','',$pattern,$placeholder,$sanity_func,$valid_func);
  }
};


/** @class text_input 
 * convience function for creating text inputs
 * 
 **/
class password_input extends input
{
  public function password_input
  (
    $label_text,
    $name,
    $value,
    $required = false,
    $maxlength = '',
    $pattern = '',
    $placeholder = '',
    $sanity_func = null,
    $valid_func = null

  )
  {
    parent::input($label_text,$name,'password',$value,$required,$maxlength,'','',$pattern,$placeholder,$sanity_func,$valid_func);
  }
};

/** @class text_input 
 * convience function for creating text inputs
 * 
 **/
class email_input extends input
{
  public function email_input
  (
    $label_text,
    $name,
    $value,
    $required = false,
    $maxlength = '',
    $pattern = '',
    $placeholder = '',
    $sanity_func = null,
    $valid_func = null

  )
  {
    parent::input($label_text,$name,'email',$value,$required,$maxlength,'','',$pattern,$placeholder,$sanity_func,$valid_func);
  }
};



/** @class number_input 
 * This convience class allows easy creation of an input with type="number"
 *
 **/
class number_input extends input
{
  /** Constructor for number_input
   * @param $label_text The text label for this number_input.
   * @param $name The name of this field for internal use. (i.e. the name attribute in the render HTML and/or used in form)
   * @param $value The current value of this input. Optional. Default is ''.
   * @param $required Weather or not the user is required to enter this field. This effects both HTML5 element and validation. Optional. Default is false.
   * @param $min The minium value this number_input allows, used in validation and HTML5 min attribute. Optional. If not set, or set to '', this attribute is ignored.
   * @param $max The maximum value this number_input allows, used in validation and HTML5 max attribute. Optional. If not set, or set to '', this attribute is ignored.
   * @param $placeholder This is used for the HTML5 placeholder attribute. Optional. Default is false.
   * @param $sanity_func Optional function for sanitization. Defualt is null.
   * @param $valid_func Optional function for validation. Default is null.
   **/

  public function number_input
  (
    $label_text,
    $name,
    $value,
    $required = false,
    $min = '',
    $max = '',
    $placeholder = '',
    $sanity_func = null,
    $valid_func = null
  )
  {
    parent::input($label_text,$name,'number',$value,$required,'',$min,$max,'',$placeholder,$sanity_func,$valid_func);
  }

  /** Inspector for the value of this input.
   * @return mixed The value of this input.
   **/
  public function get_value()
  {
    return $this->value;
  }

  /** Mutator for the value of this input
   * @param mixed $v The new value of this input
   **/
  public function set_value($v)
  {
    $this->value = $v;
  }

};

/** @class range_input 
 * Represents a slider element, an input with type="range"
 *
 **/
class range_input extends input
{
  public $step;

  /** Constructor for range_input
   * @param $label_text The text label for this range_input.
   * @param $name The name of this field for internal use. (i.e. the name attribute in the render HTML and/or used in form)
   * @param $value The current value of this input. Optional. Default is ''.
   * @param $min The minium value this number_input allows, used in validation and HTML5 min attribute. Optional. If not set, or set to '', this attribute is ignored.
   * @param $max The maximum value this number_input allows, used in validation and HTML5 max attribute. Optional. If not set, or set to '', this attribute is ignored.
   * @param $step This is the HTML5 step attribute. Optional. If not set, or set to '', this attribute is ignored. 
   * @param $placeholder This is used for the HTML5 placeholder attribute. Optional. Default is false.
   * @param $sanity_func Optional function for sanitization. Defualt is null.
   * @param $valid_func Optional function for validation. Default is null.
   **/
  public function range_input
  (
    $label_text,
    $name,
    $value,
    $min = '',
    $max = '',
    $step = '',
    $placeholder = '',
    $sanity_func = null,
    $valid_func = null

  )
  {
    $this->step = $step;
    parent::input($label_text,$name,'range',$value,true,'',$min,$max,'',$placeholder,$sanity_func,$valid_func);
  }
  
  public function form($errors = array())
  {
    $ret = array();
    $ret['js'] = '';
    $ret['html'] = '<label';
    if(array_key_exists($this->name,$errors) || $this->required)
    {
      $ret['html'] .= ' class="'
                   .  (array_key_exists($this->name,$errors) ? 'error' : '') . '"';
    }

    $ret['html'] .= '>' . $this->label_text . ': ';
    $ret['html'] .= '<input type="' . $this->type . '" name="' . $this->name . '" id="range_' . $this->name . '"';
    $ret['html'] .= ('' !== $this->min ? ' min="' . $this->min . '"' : '');
    $ret['html'] .= ('' !== $this->max ? ' max="' . $this->max . '"' : '');
    $ret['html'] .= ('' !== $this->maxlength ? ' maxlength="' . $this->maxlength . '"' : '');
    $ret['html'] .= ('' !== $this->pattern ? ' pattern="' . $this->pattern . '"' : '');
    $ret['html'] .= ('' !== $this->step ? ' step="' . $this->step . '"' : '');
    $ret['html'] .= ('' !== $this->value ? ' value="' . $this->value . '"' : '');
    $ret['html'] .= ' onchange="' . $this->name . '_out.value=this.value"/>';
    $ret['html'] .= '<output name="' . $this->name . '_out" for="ramge_' . $this->name . '">' . $this->value . '</output></label>';
    return $ret;
  }


};

/** @class tel_input 
 * This represents a telephone number input, has regex sanitization and validation to ensure valid format for phone 7 or 10 digit phone number.
 *
 **/
class tel_input extends input
{

  /** Constructor for tel_input object.
   * @param $label_text The text label for this tel_input.
   * @param $name The name of this field for internal use. (i.e. the name attribute in the render HTML and/or used in form)
   * @param $value The current value of this input. Optional. Default is ''.
   * @param $required Weather or not the user is required to enter this field. This effects both HTML5 element and validation. Optional. Default is false.
   * @param $placeholder This is used for the HTML5 placeholder attribute. Optional. Default is false.
   * @param $sanity_func Optional function for sanitization. Defualt is null.
   * @param $valid_func Optional function for validation. Default is null.
   **/
  public function tel_input
  (
    $label_text,
    $name,
    $value = '',
    $required = false,
    $placeholder = "(XXX) XXX-XXXX",
    $sanity_func = null,
    $valid_func = null
  )
  {
    //global RX_PHONE;
    parent::input($label_text,$name,'tel',$value,$required,'','','',RX_PHONE,$placeholder,$sanity_func,$valid_func);
  }
};

/** @class zip_input 
 * This convience class creates a text input with validation for long or short form US zip codes.
 *
 **/
class zip_input extends input
{
  /** Constructor for zip_input
   * @param $label_text The text label for this zip_input.
   * @param $name The name of this field for internal use. (i.e. the name attribute in the render HTML and/or used in form)
   * @param $value The current value of this input. Optional. Default is ''.
   * @param $required Weather or not the user is required to enter this field. This effects both HTML5 element and validation. Optional. Default is false.
   * @param $placeholder This is used for the HTML5 placeholder attribute. Optional. Default is false.
   * @param $sanity_func Optional function for sanitization. Defualt is null.
   * @param $valid_func Optional function for validation. Default is null.
   **/
  public function zip_input
  (
    $label_text,
    $name,
    $value,
    $required = false,
    $placeholder = "XXXXX[-XXXX]",
    $sanity_func = null,
    $valid_func	= null 
  )
  {
    //global $RX_ZIP;
    parent::input($label_text,$name,'text',$value,$required,'','','',RX_ZIP,$placeholder,$sanity_func,$valid_func);
  }
};


/** @class color_input
 * This convience class creates a color input with validation and sanitization.
 **/
class color_input extends input
{
  public function color_input
  (
    $label_text,
    $name,
    $value,
    $required = false,
    $sanity_func = null,
    $valid_func = null
  )
  {
     parent::input($label_text,$name,'color',$value,$required,'','','','','#fffffff',$sanity_func,$valid_func);
  }
};


/** @class date_input
 * This convience class creates a date input.
 * @todo Polyfill.
 **/
class date_input extends input
{
  /** constructor for date_input
   * @param string $label_text The text label for this zip_input.
   * @param string $name The name of this field for internal use. (i.e. the name attribute in the render HTML and/or used in form)
   * @param string $value The current value of this input. Optional. Default is ''.
   * @param bool $required Weather or not the user is required to enter this field. This effects both HTML5 element and validation. Optional. Default is false.
   * @param string $min a string representing the minimum date. Optional.
   * @param string $max a string representing the maximum date. Optional.
   * @param $sanity_func Optional function for sanitization. Defualt is null.
   * @param $valid_func Optional function for validation. Default is null.
   **/
  public function date_input
  (
    $label_text,
    $name,
    $value,
    $required = false,
    $min = '',
    $max = '',
    $sanity_func = null,
    $valid_func = null
  )
  {
    date_default_timezone_set('America/Chicago');
    parent::input($label_text,$name,'date',$value,$required,'','','','',date('Y-m-j'),$sanity_func,$valid_func);
  }

}

/** Adaptor to input class, adds a datalist.
 * @extends input
 **/
class datalist_input extends input
{
  private $input;
  private $datalist;

  /** Generates the html for the input for inclusion in a form.
   * @param array $errors an accoiated array errors. If the field name appears in errors, the field's label will be a class of error.
   * @return array with two elements 'html' the HTML of the input field and 'js' any JavaScript that would assoicated with it (empty for basic input types at this time).
   * @todo fix so it doesn't require JS.
   **/
  public function form($errors = array())
  {
    $ret = $this->input->form($errors);
    $ret['jquery'] = true;
    $ret['js'] .= '$("input[name=' . $this->input->name . ']").attr("list","' . $this->input->name . '_data");';
    $ret['html'] .= '<datalist id="' . $this->input->name . '_data">';
    foreach($this->datalist as $i)
    {
      $ret['html'] .= '<option>' . $i . '</option>';
    }
    $ret['html'] .= '</datalist>';
    return $ret;
  }

  /** Constructor
   * @param input $input The input we are wrapping
   * @param array $datalist The list of values we want in the datalist
   **/
  public function datalist_input($input,$datalist)
  {
    $this->input = $input;
    $this->datalist=$datalist;
  }

  /** Display function wraps input::display()
   * @return A string containing the formated name value pair for this input.
   * @see input::display()
   **/
  public function display()
  {
    return $this->input->display();
  }

  /** Sanitization function wraps input::sanitize()
   * @see input::sanitize
   **/
  public function sanitize()
  {
    return $this->input->sanitize();
  }

  /** Validation function wraps input::valudate()
   * @param array $errors an array of errors previously in the form, errors will be added to the array and the array returned.
   @ return array errors is returned, possibly with errors appended.
   * @see input::validate()
   **/
  public function validate($errors = array())
  {
    return $this->input->validate($errors);
  }

  /** Inspector for value of input, wraps input::get_value()
   * @return the current value of $this input
   **/
  public function get_value()
  {
    return $this->input->value;
  }

  /** Mutator function wraps input::set_value()
   * @param mixed $v The new value of this input
   **/
  public function set_value($v)
  {
    $this->input->value = $v;
  }


}

/*
    $label_text,
    $name,
    $type = 'text',
    $value = '',
    $required = '',
    $maxlength = '',
    $min = '',
    $max = '',
    $pattern = '',
    $placeholder = '',
    $sanity_func = null,
    $valid_func = null

*/

?>
