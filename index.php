
<?php 
  $title = "Welcome"; 
  $metaContent = "Time to build some internets.";
  $heroTitle = "Framework";
  $page = "home";
?>

<?php $content =				
				"<div class='container'>
					<section>
						<div class='row'>
							<div class='col-sm-12'>
								<h2>Intro</h2>
								<p>This framework exists to give the LSITO web team a baseline starting point for new web applications and sites.</p>
							</div>
						</div>
					</section>
					<section>
						<div class='row'>
							<div class='col-sm-12'>
								<hr class='dotted' />
								<h2>Basic Template</h2>
								<pre class='prettyprint'><code>&lt;!DOCTYPE html&gt;
&lt;!--[if lt IE 7]&gt;      &lt;html class=&quot;no-js lt-ie9 lt-ie8 lt-ie7&quot;&gt; &lt;![endif]--&gt;
&lt;!--[if IE 7]&gt;         &lt;html class=&quot;no-js lt-ie9 lt-ie8&quot;&gt; &lt;![endif]--&gt;
&lt;!--[if IE 8]&gt;         &lt;html class=&quot;no-js lt-ie9&quot;&gt; &lt;![endif]--&gt;
&lt;!--[if gt IE 8]&gt;&lt;!--&gt; &lt;html class=&quot;no-js&quot;&gt; &lt;!--&lt;![endif]--&gt;
    &lt;head&gt;
			&lt;meta charset=&quot;utf-8&quot;&gt;
			&lt;meta http-equiv=&quot;X-UA-Compatible&quot; content=&quot;IE=edge&quot;&gt;
			&lt;title&gt;&lt;/title&gt;
			&lt;meta name=&quot;description&quot; content=&quot;&quot;&gt;
			&lt;meta name=&quot;viewport&quot; content=&quot;width=device-width, initial-scale=1&quot;&gt;

			&lt;link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro:400,600,400italic,600italic' rel='stylesheet' type='text/css'&gt;
			&lt;link rel=&quot;stylesheet&quot; href=&quot;css/base.css&quot;&gt;
			&lt;link rel=&quot;stylesheet&quot; href=&quot;css/global.css&quot;&gt;
			
			&lt;script src=&quot;js/vendor/modernizr-2.6.2.min.js&quot;&gt;&lt;/script&gt;
			&lt;!--[if lt IE 9]&gt;
				&lt;script src=&quot;js/vendor/respond.min.js&quot;&gt;&lt;/script&gt;
			&lt;![endif]--&gt;
			
    &lt;/head&gt;
    &lt;body&gt;
		
		&lt;!-- Content goes here --&gt;
		
		&lt;script src=&quot;//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js&quot;&gt;&lt;/script&gt;
        &lt;script src=&quot;js/plugins.js&quot;&gt;&lt;/script&gt;
        &lt;script src=&quot;js/global.js&quot;&gt;&lt;/script&gt;
				
        &lt;!-- Google Analytics: change UA-XXXXX-X to be your site's ID. --&gt;
        &lt;script&gt;
            (function(b,o,i,l,e,r){b.GoogleAnalyticsObject=l;b[l]||(b[l]=
            function(){(b[l].q=b[l].q||[]).push(arguments)});b[l].l=+new Date;
            e=o.createElement(i);r=o.getElementsByTagName(i)[0];
            e.src='//www.google-analytics.com/analytics.js';
            r.parentNode.insertBefore(e,r)}(window,document,'script','ga'));
            ga('create','UA-XXXXX-X');ga('send','pageview');
        &lt;/script&gt;
				
    &lt;/body&gt;
&lt;/html&gt;</code></pre>
							</div>
						</div>
					</section>
					<section>
						<div class='row'>
							<div class='col-sm-12'>
								<hr class='dotted' />
								<h2>Form Page Template</h2>
								<p>This template adds extra scripts for form polyfills and validation.</p>
								<pre class='prettyprint'><code>&lt;!DOCTYPE html&gt;
&lt;!--[if lt IE 7]&gt;      &lt;html class=&quot;no-js lt-ie9 lt-ie8 lt-ie7&quot;&gt; &lt;![endif]--&gt;
&lt;!--[if IE 7]&gt;         &lt;html class=&quot;no-js lt-ie9 lt-ie8&quot;&gt; &lt;![endif]--&gt;
&lt;!--[if IE 8]&gt;         &lt;html class=&quot;no-js lt-ie9&quot;&gt; &lt;![endif]--&gt;
&lt;!--[if gt IE 8]&gt;&lt;!--&gt; &lt;html class=&quot;no-js&quot;&gt; &lt;!--&lt;![endif]--&gt;
    &lt;head&gt;
			&lt;meta charset=&quot;utf-8&quot;&gt;
			&lt;meta http-equiv=&quot;X-UA-Compatible&quot; content=&quot;IE=edge&quot;&gt;
			&lt;title&gt;&lt;/title&gt;
			&lt;meta name=&quot;description&quot; content=&quot;&quot;&gt;
			&lt;meta name=&quot;viewport&quot; content=&quot;width=device-width, initial-scale=1&quot;&gt;

			&lt;link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro:400,600,400italic,600italic' rel='stylesheet' type='text/css'&gt;
			&lt;link rel=&quot;stylesheet&quot; href=&quot;css/base.css&quot;&gt;
			&lt;link rel=&quot;stylesheet&quot; href=&quot;css/global.css&quot;&gt;
			
			&lt;script src=&quot;js/vendor/modernizr-2.6.2.min.js&quot;&gt;&lt;/script&gt;
			&lt;!--[if lt IE 9]&gt;
				&lt;script src=&quot;js/vendor/respond.min.js&quot;&gt;&lt;/script&gt;
			&lt;![endif]--&gt;
			&lt;script src=&quot;js/shared/js/EventHelpers.js&quot;&gt;&lt;/script&gt;
			&lt;script src=&quot;js/shared/js/html5Forms.js' data-webforms2-support=&quot;validation, placeholder&quot; data-webforms2-force-js-validation=&quot;true&quot;&gt;&lt;/script&gt;
			
    &lt;/head&gt;
    &lt;body&gt;
		
		&lt;!-- Content goes here --&gt;
		
		&lt;script src=&quot;//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js&quot;&gt;&lt;/script&gt;
        &lt;script src=&quot;js/plugins.js&quot;&gt;&lt;/script&gt;
        &lt;script src=&quot;js/global.js&quot;&gt;&lt;/script&gt;
				
        &lt;!-- Google Analytics: change UA-XXXXX-X to be your site's ID. --&gt;
        &lt;script&gt;
            (function(b,o,i,l,e,r){b.GoogleAnalyticsObject=l;b[l]||(b[l]=
            function(){(b[l].q=b[l].q||[]).push(arguments)});b[l].l=+new Date;
            e=o.createElement(i);r=o.getElementsByTagName(i)[0];
            e.src='//www.google-analytics.com/analytics.js';
            r.parentNode.insertBefore(e,r)}(window,document,'script','ga'));
            ga('create','UA-XXXXX-X');ga('send','pageview');
        &lt;/script&gt;
				
    &lt;/body&gt;
&lt;/html&gt;</code></pre>
							<hr class='dotted' />
							</div>
						</div>
					</section>
				</div>"      
?>

<?php include("layout.tpl.php"); ?>
