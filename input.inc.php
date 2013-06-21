<?php
/** @file input.inc.php
 * This file contains the input class, input_group class, and some other classes that make input objects easier to use.
 * @author Jeremy Streich
 **/

/** Regex for phone numbers in 10 or 7 digit format with option leading +1, 1, +0 or 0.
 **/
$RX_PHONE = '((\+?)((1|0)?)([\s-./]?)((\(\d{3}\)?)|(\d{3}))([\s-./]?)(\d{3})([\s-./]?)(\d{4}))';

/** Regex for zipcodes.
 *
 **/
$RX_ZIP = '([0-9]{5}([-][0-9]{4})?)';

/** @class input The class input describes a form element, it's attributes and how it is validated and sanitized.  Meant to be used with the class forms or it's dervative classes. 
 *
 */
class input
{
  public $label_text;
  public $name;
  public $type;
  public $value;
  public $min;
  public $max;
  public $maxlength;
  public $pattern;
  public $required;
  public $placeholder;
  public $sanity_func;
  public $valid_func;

  /** Constructor, creates an input object.
   * @param $label_text The text label on the form field.
   * @param $name The name of the field used to identify this field in the database, and in the form.
   * @param $type The type of input, should be a valid HTML type.
   * @param $value The current value of the field.
   * @param $required Boolean value, weather or not the user is required to enter a value for the field.
   * @param $maxlength The maximum characters this field's value can have, and still be valid. null or empty string will make this be ignored.
   * @param $min The minimum value allowed for this imput, when type is date, time or some type that has a numberic value. null or empty string willl make this be ignored.
   * @param $pattern The regex pattern that this field's value must match to be valid. null or empty string will make this ignored.
   * @param $placeholder The placeholder text for this item. null or empty string will suppress this attribute from being printed.
   * @param $sanity_func A function run on this element to sanitize it, if null will use default sanitation and validation using attributes above.
   * @param $valid_func A function run on this element to validate it, if null will use default sanitation and validation using attributes above.
   **/
  public function input
  (
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
  )
  {
    $this->label_text = $label_text ;
    $this->name = $name;
    $this->type = $type;
    $this->value = $value;
    $this->min = $min;
    $this->max = $max;
    $this->maxlength = $maxlength;
    $this->pattern = $pattern;
    $this->required =	$required;
    $this->placeholder = $placeholder;
    $this->valid_func	= $valid_func;
  }

  /** Generates the html for the input for inclusion in a form.
   * @param $errors an accoiated array errors. If the field name appears in errors, the field's label will be a class of error.
   * @return array with two elements 'html' the HTML of the input field and 'js' any JavaScript that would assoicated with it (empty for basic input types at this time).
   **/
  public function form($errors = array())
  {
    $ret = array();
    $ret['js'] = '';
    $ret['html'] = '<label';
    if(array_key_exists($this->name,$errors) || $this->required)
    {
      $ret['html'] .= ' class="' 
                   .  ($this->required ? 'required' . (array_key_exists($this->name,$errors) ? ' ' : '') : '') 
                   .  (array_key_exists($this->name,$errors) ? 'error' : '') . '"';
    }

    $ret['html'] .= '>' . $this->label_text . ': ';
    $ret['html'] .= '<input type="' . $this->type . '" name="' . $this->name . '"';
    $ret['html'] .= ('' !== $this->min ? ' min="' . $this->min . '"' : '');
    $ret['html'] .= ('' !== $this->max ? ' max="' . $this->max . '"' : '');
    $ret['html'] .= ('' !== $this->maxlength ? ' maxlength="' . $this->maxlength . '"' : '');
    $ret['html'] .= ('' !== $this->pattern ? ' pattern="' . $this->pattern . '"' : '');
    $ret['html'] .= ($this->required ? ' required' : '');
    $ret['html'] .= ('' !== $this->value ? ' value="' . $this->value . '"' : '');
    $ret['html'] .= '/></label>';
    return $ret;
  }

  /** Sanitizes value to help protect against HTML, SQL, PHP or other injections. Returns false if the value can't be cleaned in a sensible way.
   * @return mixed often the value of the field or true if sanitization occured properly, but false if we are unable to sanitize.
   * Use identical test '===' instaead of equality as input may have values of '' or 0.
   **/
  public function sanitize()
  {
    if($this->sanity_func != null)
    {
      $ret = $this->sanity_func($this->value);
      if($ret === false)
      {
        return false;
      }
      $this->value = $ret;
    }
    if(!isset($this->type) || !$this->type)
    {
      return false;
    }
    switch($this->type)
    {
      case 'text':
      case 'search':
      case 'hidden':
       return $this->value = filter_var($this->value,FILTER_SANITIZE_FULL_SPECIAL_CHARS);
      case 'email':
        return $this->value = filter_var($this->value, FILTER_SANITIZE_EMAIL);

      case 'url':
        if(strpos($this->value,'data:'))
        {
          return false;
        }
        return $this->value = filter_var($$this->value, FILTER_SANITIZE_URL);
      case 'color':
        $this->value = ltrim($this->value, '#');
        if(!ctype_xdigit($this->value))
        {
          $this->value = '#' . chr(hexdec($this->value));
        }
        else
        {
          return $this->value = '#' . $this->value;
        }

      case 'date':
      case 'datetime':
      case 'month':
        date_default_timezone_set('America/Chicago');
        if(($date = strtotime($this->value)) === false)
        {
          return false;
        }
        if('month' == $this->type)
        {
          return $this->value = date_format(date_create_from_format('U',$date),'Y-m');
        }
        elseif('date' == $this->type)
        {
          return $this->value = date_format(date_create_from_format('U',$date),'Y-m-d'); 
        }
        else if('datetime' == $this->type)
        {
          return $this->value =	date_format(date_create_from_format ('U',$date),'c');
        }

      case 'time':
        return date_format(date_create_from_format('U',strtotime($this->value),'g:i A'));

      case 'tel':
      case 'number':
      case 'range':
        return $this->value = preg_replace("/[^0-9,.]/", "", $this->value);
    }
  }

  /** Validates input's value, and adds errors to the $errors array if the value isn't valid, based on the attributes of this object or the input's valid_func.
   * @param $errors an array of errors previously in the form, errors will be added to the array and the array returned.
   * @return array errors is returned, possibly with errors appended.
   **/
  public function validate($errors = array())
  {
    if($this->valid_func != null)
    {
      $ret = $this->valid_func($this->value);
      if($ret !== '')
      {
        $errors[$this->name] = $ret;
        return $errors;
      }
    }

    if($this->pattern && !preg_match($this->pattern,$this->value))
    {
      $errors[$this->name] .= '<b>' . $this->label_text . '</b> does not contain a valid value.';
      return $errors;
    }

    if($this->required && '' === $this->value)
    {
      $errors[$this->name] .= '<b>' . $this->label_text . '</b> is required.';
      return $errors;
    }
    else if(!$this->required && '' === $this->value)
    {
      return $errors;
    }

    switch($this->type)
    {
      case 'text':
      case 'search':
      case 'hidden':
        if($this->maxlength && $this->maxlength < strlen($this->value))
        {
          $errors[$this->name] = '<b>' . $this->label_text . '</b> cannot be longer than ' . $this->maxlength . '.';
        }
        break;

      case 'email':
        if(!filter_var($this->value, FILTER_VALIDATE_EMAIL))
        {
          $errors[$this->name] = '<b>' . $this->label_text . '</b> must be a valid email address';
        }
        break;

      case 'url':
        if(!filter_var($$this->value, FILTER_VALIDATE_URL))
        {
          $errors[$this->name] = '<b>' . $this->label_text . '</b> must	be a valid URL.';
        }
        break;

      case 'color':
        if(4 != strlen($this->value) && 7 != strlen($this->value))
        {
          $error[$this->name] = '<b>' . $this->label_text . '</b> is not a valid Hex color code.';
        }
        break;

      case 'date':
      case 'datetime':
      case 'month':
      case 'time':
        $v = strtotime($this->value);
        if(isset($this->min) && '' !== $this->min)
        {
          $c = strtotime($this->min);
          if($v < $c)
          {
            $errors[$this->name] = '<b>' . $this->label_text . '</b> must be on or after ' . $this->min . '.';
          }
        }
        else if($this->max && '' !== $this->max)
        {
          $errors[$this->name] = '<b>' . $this->label_text . '</b> must be on or before ' . $this->min . '.';
        }
        break;

      case 'tel':
      case 'number':
      case 'range':
        if(isset($this->max) && '' !== $this->max && $this->max < $this->value)
        {
          $errors[$this->name] = '<b>' . $this->label_text . '</b> must be greater or equal to ' . $this->max . '.';
        }
        else if(isset($this->min) && '' !== $this->max && $this->min > $this->value)
        {
          $errors[$this->name] = '<b>' . $this->label_text . '</b> must be less than or equal to ' . $this->min . '.';
        }
        break;
      default:
        break;
    }
    return $errors;
  }
};

/** @class input_group Defines a group of related inputs like raido buttons or checkboxes that have the same name, but different values.
 *
 **/
class input_group extends input
{
  public $value_list;

  /** Constructor for input_group object.
   * @param $label_text The label for the group, will be displayed as the legend in the rendered html.
   * @param $name The name of the item in html, and the fields of the form.
   * @param $value_list the values for the input tags.
   * @param $type the HTML type of input each will be.
   * @param $value an array or single value, the currently checked/activated inputs.
   * @param $required boolean on weather or not a selection is required.
   * @param $placeholder The placeholder text for this item. null or empty string will suppress this attribute from being printed.
   * @param $sanity_func A function run on this element to sanitize it, if null will use default sanitation and validation using attributes above.
   * @param $valid_func A function run on this element to validate it, if null will use default sanitation and validation using attributes above.
   * @todo work out required, and single values.
   **/
  public function input_group
  (
    $label_text,
    $name,
    $value_list,
    $type = 'checkbox',
    $value = '',
    $required = '',
    $placeholder = '',
    $sanity_func = null,
    $valid_func = null
  )
  {
    $this->label_text = $label_text ;
    $this->name = $name;
    $this->value_list = $value_list;
    $this->type = $type;
    $this->value = $value;
    $this->required = $required;
    $this->placeholder = $placeholder;
    $this->valid_func   = $valid_func;
  }

  public function form($errors = array())
  {
    $ret = array();
    $ret['js'] = '';
    $ret['html'] = '<fieldset><legend>' . $this->label_text . '</legend>';
    foreach($this->value_list as $k => $v)
    {
      $ret['html'] .= '<label';
      if(array_key_exists($this->name,$errors) || $this->required)
      {
        //Think about required display...
        $ret['html'] .= ' class="'
                     .  ($this->required ? 'required' . (array_key_exists($this->name,$errors) ? ' ' : '') : '')
                     .  (array_key_exists($this->name,$errors) ? 'error' : '') . '"';
      }
      $ret['html'] .= '>';
      $ret['html'] .= '<input type="' . $this->type . '" name="' . $this->name . '[]" value="' . $v . '"';

      $ret['html'] .= (isset($this->value) && '' != $this->value && in_array($v,$this->value)? ' checked' : '');

      $ret['html'] .= ($this->required ? ' required' : '');
      $ret['html'] .= '/>';
      $ret['html'] .= '&nbsp;' . $k . '</label>';
    }
    $ret['html'] .= '</fieldset>';
    return $ret;
  }

  public function sanitize()
  {
    return true;
  }

  public function validate($errors = array())
  {
    return $errors;
  }
};

class datalist
{
};

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

/** @class number_input This convience class allows easy creation of an input with type="number"
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
    parent::input($label_text,$name,'text',$required,'',$min,$max,'',$placeholder,$sanity_func,$valid_func);
  }

};

/** @class range_input Represents a slider element, an input with type="range"
 *
 **/
class range_input extends input
{
  public $step;

  /** Constructor for range_input
   * @param $label_text The text label for this range_input.
   * @param $name The name of this field for internal use. (i.e. the name attribute in the render HTML and/or used in form)
   * @param $value The current value of this input. Optional. Default is ''.
   * @param $required Weather or not the user is required to enter this field. This effects both HTML5 element and validation. Optional. Default is false.
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
    $required = false,
    $min = '',
    $max = '',
    $step = '',
    $placeholder = '',
    $sanity_func = null,
    $valid_func = null

  )
  {
    $this->step = $step;
    parent::input($label_text,$name,'range',$value,$required,'',$min,$max,'',$placeholder,$sanity_func,$valid_func);
  }
  
  public function form($errors = array())
  {
    $ret = array();
    $ret['js'] = '';
    $ret['html'] = '<label';
    if(array_key_exists($this->name,$errors) || $this->required)
    {
      $ret['html'] .= ' class="'
                   .  ($this->required ? 'required' . (array_key_exists($this->name,$errors) ? ' ' : '') : '')
                   .  (array_key_exists($this->name,$errors) ? 'error' : '') . '"';
    }

    $ret['html'] .= '>' . $this->label_text . ': ';
    $ret['html'] .= '<input type="' . $this->type . '" name="' . $this->name . '"';
    $ret['html'] .= ('' !== $this->min ? ' min="' . $this->min . '"' : '');
    $ret['html'] .= ('' !== $this->max ? ' max="' . $this->max . '"' : '');
    $ret['html'] .= ('' !== $this->maxlength ? ' maxlength="' . $this->maxlength . '"' : '');
    $ret['html'] .= ('' !== $this->pattern ? ' pattern="' . $this->pattern . '"' : '');
    $ret['html'] .= ('' !== $this->step ? ' step="' . $this->step . '"' : '');
    $ret['html'] .= ($this->required ? ' required' : '');
    $ret['html'] .= ('' !== $this->value ? ' value="' . $this->value . '"' : '');
    $ret['html'] .= '/>';
    $ret['html'] .= '<output name="' . $this->name . '_out" for="' . $this->name . '" onforminput="this.value = ' . $this->name . '.valueAsNumber"></output></label>';
    return $ret;
  }


};

/** @class tel_input This represents a telephone number input, has regex sanitization and validation to ensure valid format for phone 7 or 10 digit phone number.
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
    global $RX_PHONE;
    parent::input($label_text,$name,'tel',$value,$required,'','','',$RX_PHONE,$placeholder,$sanity_func,$valid_func);
  }
};

/** @class zip_input This convience class creates a text input with validation for long or short form US zip codes.
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
    global $RX_ZIP;
    parent::input($label_text,$name,'text',$value,$required,'','','',$RX_ZIP,$placeholder,$sanity_func,$valid_func);
  }
};



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
