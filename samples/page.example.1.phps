<?php
require_once('page.inc.php');
$page = new page('Sample Page');
$page->set_features(array(GOOGLE_ANALYTICS,FORMS,FANCY_BOX));
$page->add_css('path/to/my/style.css');
$my_content = '...';
$page->set_content($my_content);
echo $page->render();
?>
