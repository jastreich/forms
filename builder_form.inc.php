<?php
/** This file defines the builder forms, which builds other forms
 *
 **/

require_once('forms.inc.php');
require_once('input.inc.php');
require_once('extended_inputs.inc.php');
require_once('input_group.inc.php');
require_once('textarea.inc.php');
require_once('texteditor.inc.php');


/** @class builder_form
 * This form build up a form by creating fields.
 *
 **/
class builder_form extends forms
{

  /** Constructor for the builder form.
   *
   **/
  public function builder_form()
  {

    $type_opts = array
    (
      'textarea' => 'Text Area',
      'text_input' => 'Text',
      'number_input' => 'Number',
      'texteditor' => 'Rich Text Editor',
//      'input_group' => 'Input Group (checkboxes/radio buttons)',
      'range_input' => 'Slider',
      'tel_input' => 'Telephone',
      'zip_input' => 'US Zip Code',
      'password_input' => 'Password',
      'date_input' => 'Date'
    );

    $req_opts = array
    (
      'true' => 'Yes',
      'false' => 'No'
    );

    $this->fields['text_label'] = new text_input('Label','text_label','',true);
    $this->fields['name'] = new text_input('Name','name','',true);
    $this->fields['value'] = new text_input('Default Value','value','',false);
    $this->fields['type'] = new input_group('Input Type','type',$type_opts,'radio',array('text_input'));
    $this->fields['required'] = new input_group('Required','required',$req_opts,'radio',array('false'));
    $this->fields['maxlength'] = new number_input('Max Length','max_length','');
    $this->fields['min'] = new number_input('Min','min','');
    $this->fields['max'] = new number_input('Max','max','');
    $this->fields['pattern'] = new text_input('Pattern','pattern','');
    $this->fields['placeholder'] = new text_input('Place Holder','placeholder','');
  }

  /** Creates a field from this form to be added to the form we're building
   * @pre we have valid inputs, as checked with sanitize() and validate()
   * @return an input object with the user set parameters. 
   **/
  public function make_field()
  {
    $imp = null;
    $req = $this->fields['required']->get_value();
    $type = $this->fields['type']->get_value();

    switch($type[0])
    {
      case 'textarea':
        $imp = new textarea
        (
          $this->fields['text_label']->get_value(),
          $this->fields['name']->get_value(),
          $this->fields['value']->get_value(),
          $req[0],
          $this->fields['maxlength']->get_value()
        );
        break;
      case 'texteditor':
        $imp = new texteditor
        (
          $this->fields['text_label']->get_value(),
          $this->fields['name']->get_value(),
          $this->fields['value']->get_value(),
          $req[0],
          $this->fields['maxlength']->get_value()
        );
        break;
      case 'text_input':
        $imp = new text_input
        (
          $this->fields['text_label']->get_value(),
          $this->fields['name']->get_value(),
          $this->fields['value']->get_value(),
          $req[0],
          $this->fields['maxlength']->get_value(),
          $this->fields['pattern']->get_value(),
          $this->fields['placeholder']->get_value()
        );
        break;
      case 'number_input':
        $imp = new number_input
        (
          $this->fields['text_label']->get_value(),
          $this->fields['name']->get_value(),
          $this->fields['value']->get_value(),
          $req[0],
          $this->fields['min']->get_value(),
          $this->fields['max']->get_value(),
          $this->fields['placeholder']->get_value()
        );
        break;
      case 'input_group':
      case 'range_input':
        $imp = new range_input
        (
          $this->fields['text_label']->get_value(),
          $this->fields['name']->get_value(),
          $this->fields['value']->get_value(),
          $this->fields['min']->get_value(),
          $this->fields['max']->get_value(),
          $this->fields['placeholder']->get_value()
        );
        break;
      case 'tel_input':
        $imp = new tel_input
        (
          $this->fields['text_label']->get_value(),
          $this->fields['name']->get_value(),
          $this->fields['value']->get_value(),
          $req[0],
          $this->fields['placeholder']->get_value()
        );
        break;
      case 'zip_input':
        $imp = new zip_input
        (
          $this->fields['text_label']->get_value(),
          $this->fields['name']->get_value(),
          $this->fields['value']->get_value(),
          $req[0],
          $this->fields['placeholder']->get_value()
        );
        break;
      case 'date_input':
         $imp = new date_input
         (
           $this->fields['text_label']->get_value(),
           $this->fields['name']->get_value(),
           $this->fields['value']->get_value(),
           $req[0].
           $this->fields['min']->get_value(),
           $this->fields['max']->get_value()
         );
         break;
      case 'password_input':
        $imp = new password_input
        (
          $this->fields['text_label']->get_value(),
          $this->fields['name']->get_value(),
          $this->fields['value']->get_value(),
          $req[0],
          $this->fields['maxlength']->get_value(),
          $this->fields['pattern']->get_value(),
          $this->fields['placeholder']->get_value()
        );
    }
    return $imp;
  }

  /** Returns the HTML for this builder_form
   * @see forms::form()
   **/
  public function form($errors = array())
  {
    $ret = parent::form($errors);
    $ret['jquery'] = true;
/*
    $ret['js'] .= '

    if(
        "test_input" == $("[name=type]:selected").val() ||
        "texteditor"  == $("[name=type]:selected").val() ||
        "textarea" == $("[name=type]:selected").val()
      )
    {
      $("[name=min]").hide();
      $("[name=max]").hide();
      $("[name=max_length]").show();
    }

    if(
        "tel_input" == $("[name=type]:selected").val() ||
        "zip_input" == $("[name=type]:selected").val() ||
        "date_input" == $("[name=type]:selected").val() ||
        "range_input" == $("[name=type]:selected").val() ||
        "number_input" == $("[name=type]:selected").val()
      )
    {
      $("[name=max_length]").hide();
    }

    if(
        "date_input" == $("[name=type]:selected").val() ||
        "range_input" == $("[name=type]:selected").val() ||
        "number_input" == $("[name=type]:selected").val()
      )
    {
      $("[name=min]").show();
      $("[name=max]").show();

      $("[name=min]").attr('type','number');
      $("[name=max]").attr('type','number');

    }

    if(
        "tel_input" == $("[name=type]:selected").val() ||
        "zip_input" == $("[name=type]:selected").val() ||
      )
    {
      $("[name=min]").hide();
      $("[name=max]").hide();
    }

    if(
        "tel_input" == $("[name=type]:selected").val() ||
        "zip_input" == $("[name=type]:selected").val() ||
      )
    {
      $("[name=min]").hide();
      $("[name=max]").hide();
    }


';
*/
    return $ret;
  }


}

?>
