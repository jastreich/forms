<?php
/** @file input.inc.php
 * This file contains the input class.
 * @author Jeremy Streich
 **/

require_once('field.inc.php');

/** Defines the RegEx that a phone number must match to be valid.
 *
 **/
define('RX_PHONE','^((\+?)((1|0)?)([\s-./]?)((\(\d{3}\)?)|(\d{3}))([\s-./]?)(\d{3})([\s-./]?)(\d{4}))$');

/** Defines the RegEx a US ZIP code must match to be valid.
 *
 **/
define('RX_ZIP','^([0-9]{5}([-][0-9]{4})?)$');

$state_list = array
(
    'AL'=>"Alabama",
    'AK'=>"Alaska",
    'AZ'=>"Arizona",
    'AR'=>"Arkansas",
    'CA'=>"California",
    'CO'=>"Colorado",
    'CT'=>"Connecticut",
    'DE'=>"Delaware",
    'DC'=>"District Of Columbia",
    'FL'=>"Florida",
    'GA'=>"Georgia",
    'HI'=>"Hawaii",
    'ID'=>"Idaho",
    'IL'=>"Illinois",
    'IN'=>"Indiana",
    'IA'=>"Iowa",
    'KS'=>"Kansas",
    'KY'=>"Kentucky",
    'LA'=>"Louisiana",
    'ME'=>"Maine",
    'MD'=>"Maryland",
    'MA'=>"Massachusetts",
    'MI'=>"Michigan",
    'MN'=>"Minnesota",
    'MS'=>"Mississippi",
    'MO'=>"Missouri",
    'MT'=>"Montana",
    'NE'=>"Nebraska",
    'NV'=>"Nevada",
    'NH'=>"New Hampshire",
    'NJ'=>"New Jersey",
    'NM'=>"New Mexico",
    'NY'=>"New York",
    'NC'=>"North Carolina",
    'ND'=>"North Dakota",
    'OH'=>"Ohio",
    'OK'=>"Oklahoma",
    'OR'=>"Oregon",
    'PA'=>"Pennsylvania",
    'RI'=>"Rhode Island",
    'SC'=>"South Carolina",
    'SD'=>"South Dakota",
    'TN'=>"Tennessee",
    'TX'=>"Texas",
    'UT'=>"Utah",
    'VT'=>"Vermont",
    'VA'=>"Virginia",
    'WA'=>"Washington",
    'WV'=>"West Virginia",
    'WI'=>"Wisconsin",
    'WY'=>"Wyoming"
);

$state_abrs =array( "AK", "AL", "AR", "AZ", "CA", "CO", "CT", "DC",
      "DE", "FL", "GA", "HI", "IA", "ID", "IL", "IN", "KS", "KY", "LA",
      "MA", "MD", "ME", "MI", "MN", "MO", "MS", "MT", "NC", "ND", "NE",
      "NH", "NJ", "NM", "NV", "NY", "OH", "OK", "OR", "PA", "RI", "SC",
      "SD", "TN", "TX", "UT", "VA", "VT", "WA", "WI", "WV", "WY");


/** @class input
 *  @brief The class input describes a form element, it's attributes and how it is validated and sanitized.  Meant to be used with the class forms or it's dervative classes.
 **/
class input implements field
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
   * @param string $label_text The text label on the form field.
   * @param string $name The name of the field used to identify this field in the database, and in the form.
   * @param string $type The type of input, should be a valid HTML type.
   * @param mixed $value The current value of the field.
   * @param bool $required Boolean value, weather or not the user is required to enter a value for the field.
   * @param mixed $maxlength The maximum characters this field's value can have, and still be valid. null or empty string will make this be ignored.
   * @param mixes $min The minimum value allowed for this imput, when type is date, time or some type that has a numberic value. null or empty string willl make this be ignored.
   * @param string $pattern The regex pattern that this field's value must match to be valid. null or empty string will make this ignored.
   * @param string $placeholder The placeholder text for this item. null or empty string will suppress this attribute from being printed.
   * @param mixed $sanity_func A function run on this element to sanitize it, if null will use default sanitation and validation using attributes above.
   * @param mixed $valid_func A function run on this element to validate it, if null will use default sanitation and validation using attributes above.
   **/
  public function __construct
  (
    $label_text,
    $name,
    $type = 'text',
    $value = '',
    $required = false,
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
   * @param array $errors an accoiated array errors. If the field name appears in errors, the field's label will be a class of error.
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
    $ret['html'] .= ('' !== $this->value ? ' value="' . htmlentities(trim($this->value)) . '"' : '');
    $ret['html'] .= '/></label>';
    return $ret;
  }

  /** Display the name value pair
   * @return A string containing the HTML formated name value pair for this input.
   **/
  public function display()
  {
    return '<tr><td class="field_name">' . $this->label_text . '</td><td class="field_value">' . htmlentities(trim($this->value)) . '</td></tr>';
  }



  /** Display the name value pair
   * @return A string containing the TEXT formated name value pair for this input.
   **/
  public function display_text()
  {
    return $this->label_text . ':' . trim($this->value) . "\n";
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
   * @param array $errors an array of errors previously in the form, errors will be added to the array and the array returned.
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
      $errors[$this->name] = '<b>' . $this->label_text . '</b> does not contain a valid value.';
      return $errors;
    }

    if($this->required && '' === $this->value)
    {
      $errors[$this->name] = '<b>' . $this->label_text . '</b> is required.';
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
        if(!filter_var($this->value, FILTER_VALIDATE_URL))
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

  /** Inspector function for this input's value
   * $return The current value of this input.
   **/
  public function get_value()
  {
    return $this->value;
  }

  /** Mutator function for this input's value.
   * @param mixed $v The new value of this input
   * #post The value of this input will be set to $v
   **/
  public function set_value($v)
  {
    $this->value = $v;
  }

  /** Takes an assoicated array of values and assigns the values to input fileds, and the id of this form.
   * @param array $values an associated array of values. Ignores values of keys that aren't fields in this form.
   **/
  public function values($values)
  {
    if(isset($values[$this->name]))
    {
      $this->value = $values[$this->name];
    }
  }

};

?>
