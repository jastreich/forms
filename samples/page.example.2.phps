<?php
require_once('page.inc.php');
$page = new page('Sample Page');
echo $page->set_features(array(GOOGLE_ANALYTICS,FORMS,FANCY_BOX))->add_css('path/to/my/style.css')->set_content('...')->render();
?>
