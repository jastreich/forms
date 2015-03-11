<?php
/**
 * @file crud_form.inc.php
 *
 **/

require_once('forms/forms.inc.php');


/**
 * @class crud_form
 * 
 *
 **/
class crud_form extends forms
{
  public function do_form($values = array(),$page = ,$errors = array(),$create = true,$edit = true)
  {

    // If page is empty, resubmit to the page we're on.
    if($page === '')
    {
      $page = 'http';
      if ($_SERVER["HTTPS"] == "on")
      {
        $pageURL .= "s";
      }
      $page .= "://";
      $page .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
    }


    if(count($values) == 0)
    {
      // Form not submitted yet.
      $f = $this->form();
      echo '<form action="' . $page .'" method="post">';
      echo $f['html'];
      echo '<input type="submit" />';
      echo '</form>';

      if($f['jquery'])
      {
        echo '<script src="/js/jquery.js" type="text/javascript"></script>';
      }

      if($f['tinymce'])
      {
        echo '<script src="/js/tinymce/jquery.tinymce.min.js" type="text/javascript"></script>';
      }

      echo '<script>' . $f['js'] . '</script>';

    }
    else
    {
      $this->values($values);
      if($this->sanitize())
      {
        $errors = $this->validate($errors);
        if(count($errors) == 0)
        {
          // No problems.  Do the stuff.
          if($edit && isset($this->id))
          {
            $this->update();
          }
          else if($create)
          {
            $this->create();
          }
          else
          {
            echo 'An error has occured.';
          }
        }
        else
        {
          // Errors.
          echo '<ul>';
          foreach ($errors as $error)
          {
            echo '<li>' . $error . '</li>';
          }
          echo '</ul>';
          $f = $this->form($errors);
          echo '<form action="' . $page .'" method="post">';
          echo $f['html'];
          echo '<input type="submit" />';
          echo '</form>';

          if($f['jquery'])
          {
            echo '<script src="/js/jquery.js" type="text/javascript"></script>';
          }

          if($f['tinymce'])
          {
            echo '<script src="/js/tinymce/jquery.tinymce.min.js" type="text/javascript"></script>';
          }

          echo '<script>' . $f['js'] . '</script>';
        }
      }
      else
      {
        throw new Exception('Failed sanitization check.');
      }
    }
  }
}


?>