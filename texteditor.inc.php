<?php
/** @file texteditor.inc.php
 * This file contains the class definition for the texteditor class.
 * @author Jeremy Streich
 **/

require_once('textarea.inc.php');

/** @class texteditor
 * This is a form element wrapping the testarea with javascript to turn it into a rich text editor
 **/
class texteditor extends textarea
{

  public function texteditor
  (
    $label_text,
    $name,
    $value = '',
    $required = false,
    $maxlength = '',
    $sanity_func = null,
    $valid_func = null
  )
  {
    parent::textarea
    (
      $label_text,
      $name,
      $value,
      $required,
      $maxlength,
      $sanity_func,
      $valid_func
    );
  }

  public function form($errors)
  {
    $ret = parent::form($errors);

    $ret['js'] = '$("textarea[name=' . $this->name . ']").tinymce({script_url : "tinymce/tinymce.min.js",theme : "modern",menubar:false, /* statusbar:false, */
      plugins: ["advlist autolink lists link image charmap anchor searchreplace table contextmenu paste"],
      toolbar: "undo redo copy paste | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link anchor image",
      max_height: 400,
      min_height: 100,
      height : 180
    });';

    $ret['jquery'] = true;
    $ret['tinymce'] = true;

    return $ret;
  }

};

?>
