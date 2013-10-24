<?php
require_once('page.inc.php');
$page = new page('Sample Page');
$page->set_features(array(GOOGLE_ANALYTICS,FORMS,FANCY_BOX));
$page->add_css('path/to/my/style.css');
echo $page->head();
?>

HTML MARKUP HERE

<?php
echo $page->foot();
?>

