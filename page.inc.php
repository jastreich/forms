<?php
/** @file page.inc.php
 * Contains the page class
 * @author Jeremy Streich
 **/

/** Feature id for Google Analytics Async
 * @see page::add_feature()
 * @see page::set_features()
 **/
define("GOOGLE_ANALYTICS",1);

/** Feature id for Piwik analytics
 * @see page::add_feature()
 * @see page::set_features()
 **/
define("PIWIK",2);

/** Feature id for HTML5 forms with CSS and polyfill
 * @see page::add_feature()
 * @see page::set_features()
 **/
define("FORMS",3);

/** Feature id for FancyBox.
 * <code>.fancybox</code> - Will do the default fancybox treatment
 * <code>.fancybox-iframe</code> - Will do a fancybox in iframe mode
 * @see page::add_feature()
 * @see page::set_features()
 **/
define("FANCY_BOX",4);

/** The larges feature id. Update this features are added.
 *
 **/
define("MAX_FEATURES",4);


/** @class page
 * Holds the code to add to the head and foot.
 * You can call the head and a foot and fill in the middle like this. <a href="../../samples/page.example.0.phps">Example 1</a> | <a href="../../samples/page.example.1.phps">Example 2</a> | <a href="../../samples/page.example.2.phps">Example 3</a>
 *
 * @todo Finish class.
 * @todo create forms_page object. And derive a database_forms_page object from it.
 * 
 **/
class page
{
  private $css;
  private $scripts;
  private $js;
  private $features;
  private $content;
  private $gac;
  private $sid;

  /** Constructor for the page object
   * @param string $title The title of this page
   **/
  public function page($title)
  {
    $this->css = array();
    $this->scripts = array();
    $this->features = array();
    $this->js = '';
  }


  /** Adds a JavaScript file to the foot of this document
   * Files add using this function will be added to the foot before script added with page::set_js() and page::append_js()
   * @param string $js a JavaScript file to add to this document.
   * @return false if $js doesn't evaluate to a string, and true if $js is added
   **/
  public function add_script($js)
  { 
    $is = '';
    if($is = is_string($js))
    {
      $this->scripts[] = $js;
    }
    return ($is ? $this : false);
  }

  /** Sets the JS files to be included (outside of the features added), replacing the current value. 
   * Files added using this function will be added to the foot before script added with page::set_js() and page::append_js()
   * @param array $js an array of filenames
   * @return false if $js is not an array, otherwise <code>$this</code> 
   **/
  public function set_scripts($js)
  {
    $ia = '';
    if($ia = is_string($js))     
    {
      $this->css = $js;
    }
    return ($ia ? $this : false);
  }

  /** Adds a CSS file to the head of this document
   * @param string $css a CSS file to add to this document.
   * @return false if $css doesn't evaluate to a string, and true if $js is added
   **/
  public function add_css($css)
  { 
    $is = '';
    if($is = is_string($css))
    {
      $this->css[] = $css;
    }
    return ($is ? $this : false);
  }

  /** Sets the CSS files to be included (outside of the features added), replacing the current value. 
   * @param array $css an array of filenames
   * @return false if $css is not an array, otherwise <code>$this</code> 
   **/
  public function set_css($css)
  {
    $ia = '';
    if($ia = is_string($css))     
    {
      $this->scripts = $css;
    }
    return ($ia ? $this : false);
  }

  /** Sets the small script on the page, replacing any previously set or appended JavaScipt
   * @param string $js The js you would like on this page.
   * @return false if $js is not a string, <code>$this</code> otherwise.
   **/
  public function set_js($js)
  {
    $is = '';
    if($is = is_string($js))
    {
      $this->js = $js;
    }
    return ($is ? $this : false);
  }

  /** Append to the JavaScript on this page 
   * @param string $js The code you'd like to append.
   * @return false if $js is not a string, <code>$this</code> otherwise.
   **/
  public function append_js($js)
  {
    $is = '';
    if($is = is_string($js))
    {
      $this->js .= $js;
    }
    return ($is ? $this : false);

  }

  /** Adds a feature to the page.
   * @param int $fid the feature id you want to add. Availible are: GOOGLE_ANALYTICS, PIWIK, FORMS
   * @post calls to page::head() and page::foot() will include the code for the past feature.
   * @return false if $fid isn't valid, otherwise <code>$this</code>.
   **/
  public function add_feature($fid)
  {
    $ii = '';
    if($ii = (is_int($fid) && 0 <= $fid && MAX_FEATURES >= $fid))
    {
      $this->features[] = $fid;
    }
    return ($ii ? $this : false);
  }

  /** Sets the features on this page, replacing the current features
   * @param array $fid an array of feature ids
   * @see page::add_feature()
   * @return false if $fid is not an array or has a bad feature id, otherwise returns <code>$this</code>
   **/
  public function set_features($fid)
  {
    $ia = '';
    if($ia = is_array($fid))
    {
      $this->features = array();
      foreach($fid as $f)
      {
        $good = $this->add_feature($f);
        if(!$good)
        {
          $ia = false;
          break;
        }
      }
    }
    return ($ia ? $this : false);
  }

  /** Sets the content of the page
   * @param string $c The HTML body of the page.
   * @return false if $c is not a string, otherwise <code>$this</code>
   * @todo validation of types.
   **/
  public function set_content($c)
  {
    $is = '';
    if($is = is_string($c))
    {
      $this->content = $c;
    }
    return ($is ? $this : false);
  }

  /** The site id you'd like to track this page under in Piwik. 
   * @pre For this to have an effect it requires PIWIK to be a feature of this page.
   * @param int $sid The sight ID in Piwik
   **/
  public function set_site_id($sid)
  {
    $this->sid = $sid;
  }

  /** The analytics codes you'd like to track this page with.
   * @pre For this to work, GOOGLE_ANALYTICS must be a feautre of this page.
   * @param string $gac
   * @todo verification of types
   **/
  public function set_google_analytics($gac)
  {
    $this->gac = $gac;
    return $this;
  }

  /**
   *
   *
   **/
  public function head()
  {
    $head = file_get_contents('base.head.tpl');
    if(in_array(FORMS,$this->features))
    {
      $head .= file_get_contents('forms.head.tpl');
    }
    foreach($this->css as $v)
    {
      $head .= '<link type="text/css" rel="stylesheet" href="' . $v . '" />';
    }
    $head .= '</head><body>';
    return $head;
  }

  /**
   *
   *
   **/
  public function foot()
  {
    $foot = file_get_contents('base.foot.tpl');

    foreach($this->scripts as $v)
    {
      $foot .= '<script type="text/javascript" src="' . $v . '"></script>';
    }
    if(in_array(PIWIK,$this->features))
    {
      $piwik_user = (isset($_SERVER['eppn']) ? strstr($_SERVER['eppn'], '@', true) : 'not set');
      $sid = ('' !== $this->sid ? $this->sid : 1);
      $foot .= str_replace('[%SID%]',$sid,str_replace('[%USERNAME%]',$piwik_user,file_get_contents('piwik.foot.tpl')));
    }

    if('' != $this->js)
    {
      $foot .= '<script type="text/javascript">' . $this->js . '</script>';
    }
    $foot .= '</body></html>';
    return $foot;
  }

  public function render()
  {
    return $this->header() . $this->content . $this->footer();
  }

}

?>
