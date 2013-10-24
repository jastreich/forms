<?php include ("config.php"); ?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
			<meta charset="utf-8">
			<meta http-equiv="X-UA-Compatible" content="IE=edge">
      
			<title><?php echo($title) ?> | LSITO Web Development Team</title>
      
			<meta name="description" content="<?php echo($metaContent) ?>">
			<meta name="viewport" content="width=device-width, initial-scale=1">

			<link rel="stylesheet" href="<?php echo ($resPath); ?>/css/prettify.css">
			<link rel="stylesheet" href="<?php echo ($resPath); ?>/css/normalize.css">
			<link rel="stylesheet" href="<?php echo ($resPath); ?>/css/grid.css">
			<link rel="stylesheet" href="<?php echo ($resPath); ?>/css/base.css">
			<link rel="stylesheet" href="<?php echo ($resPath); ?>/css/global.css">
			
      <script src="<?php echo ($resPath); ?>/js/vendor/modernizr-2.6.2.min.js"></script>
			<!--[if lt IE 9]>
				<script src="<?php echo ($resPath); ?>/js/vendor/respond.min.js"></script>
			<![endif]-->
      <?php
        if ( $page == "forms" ) {
            include ($incPath."/includes/scripts-forms.inc.php");
        }
      ?>
    </head>
    <body>
        
				<?php include ($incPath."/includes/header.inc.php"); ?>
        
				<article>
          
          <?php include ($incPath."/includes/hero.inc.php"); ?>
          
          <?php if(isset($content)) {
              echo($content);
            } 
          ?>
          
				</article>
				
				<?php include ($incPath."/includes/footer.inc.php"); ?>
        
        <?php include ($incPath."/includes/scripts.inc.php"); ?>
        
    </body>
</html>
