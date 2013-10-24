<?php 
  $title = "Typography"; 
  $metaContent = "Make it readable.";
  $heroTitle = "Typography";
  $page = "typography";
?>

<?php $content =	
          "<div class='container typography'>
						<section>
							<div class='row'>
								<div class='col-xs-12'>
									<h3>Typeface</h3>
									<p><a href='http://store1.adobe.com/cfusion/store/html/index.cfm?event=displayFontPackage&code=1959'>Source Sans Pro</a> 400, <strong>600</strong> (regular &amp; <strong>semi-bold</strong>)</p>
									<p>Font stack call in CSS</p>
									<pre class='prettyprint'><code>font-family: 'Source Sans Pro', 'Helvetica Neue', Helvetica, Arial, sans-serif;</code></pre>
								</div>
							</div>
						</section>
						<section>
							<div class='row'>
								<div class='col-xs-12'>
									<hr class='dotted' />
									<h3>Headings</h3>
									<h1>h1 &ndash; Lorem ipsum dolor sit amet, consectetur adipiscing elit.</h1>
									<h2>h2 &ndash; Lorem ipsum dolor sit amet, consectetur adipiscing elit.</h2>
									<h3>h3 &ndash; Lorem ipsum dolor sit amet, consectetur adipiscing elit.</h3>
									<h4>h4 &ndash; Lorem ipsum dolor sit amet, consectetur adipiscing elit.</h4>
									<h5>h5 &ndash; Lorem ipsum dolor sit amet, consectetur adipiscing elit.</h5>
									<h6>h6 &ndash; Lorem ipsum dolor sit amet, consectetur adipiscing elit.</h6>
									<pre class='prettyprint'><code>&lt;h1&gt;&hellip;&lt;/h1&gt;
&lt;h2&gt;&hellip;&lt;/h2&gt;
&lt;h3&gt;&hellip;&lt;/h3&gt;
&lt;h4&gt;&hellip;&lt;/h4&gt;
&lt;h5&gt;&hellip;&lt;/h5&gt;
&lt;h6&gt;&hellip;&lt;/h6&gt;</code></pre>
								</div>
							</div>
						</section>
						<section>
							<div class='row'>
								<div class='col-xs-12'>
									<hr class='dotted' />
									<h3>Body copy</h3>
									<div class='row'>
										<div class='col-sm-6'>
									<p>Curabitur ut neque at sem sollicitudin eleifend vel id dui. <strong>Praesent nec tellus</strong> at lorem convallis pharetra semper eget neque. Nullam vel varius diam. Aliquam semper nulla ut pellentesque eleifend. Proin feugiat et justo ut iaculis. Cras ante metus, vehicula vitae volutpat vitae, vestibulum eu neque. Vivamus quis facilisis elit. Curabitur feugiat urna at sem lobortis, vel congue felis mollis. Integer eget egestas sem. Aenean nec consequat purus. Ut malesuada lacus in orci pellentesque ullamcorper. Donec vitae tempus lectus. Praesent vitae egestas arcu, ac pharetra nisi.</p>
										</div>
										<div class='col-sm-6'>
									<p>Duis tellus risus, tempor tempor accumsan eget, tristique quis odio. Cras id fermentum felis. <em>Maecenas bibendum tempus lacus</em>. Fusce eros nibh, viverra in quam gravida, fermentum rhoncus lorem. Pellentesque a elit odio. Sed tempus quam in ipsum cursus, at consequat felis tempor. Curabitur vulputate feugiat leo. Maecenas ultrices ligula quis lectus pellentesque, ut dapibus justo tincidunt. Sed interdum sapien eu enim blandit porttitor. Aenean ac lorem urna. Praesent feugiat ut erat non condimentum. Curabitur non euismod urna. Donec pulvinar orci non velit viverra, in pretium ligula suscipit.</p>
										</div>
									</div>
									<pre class='prettyprint'><code>&lt;p&gt;&hellip;&lt;/p&gt;</code></pre>
								</div>
							</div>
						</section>
						<section>
							<div class='row'>
								<div class='col-xs-12'>
									<hr class='dotted' />
									<h3>Blockquote</h3>
									<blockquote>
										<p>Nam ultrices fringilla dui sit amet ornare. Integer tristique mi turpis, nec pharetra risus faucibus id. Pellentesque auctor odio suscipit purus commodo, eu varius justo rhoncus. </p>
										<p><small>&ndash; Sombody Famous</small></p>
									</blockquote>
									<pre class='prettyprint'><code>&lt;blockquote&gt;
	&lt;p&gt;Nam ultrices fringilla dui sit amet ornare. Integer tristique mi turpis, nec pharetra risus faucibus id. Pellentesque auctor odio suscipit purus commodo, eu varius justo rhoncus.&lt;/p&gt;
	&lt;p&gt;&lt;small&gt;&ndash; Sombody Famous&lt;/small&gt;&lt;/p&gt;
&lt;/blockquote&gt;</code></pre>
								</div>
							</div>
						</section>
						<section>
							<div class='row'>
								<div class='col-xs-12'>
									<hr class='dotted' />
									<h3>Description List</h3>
									<dl>
										<dt>Lorem</dt>
										<dd>Ipsum dolor sit amet, consectetur adipiscing elit.</dd>
										<dt>Suspendisse</dt>
										<dd>Quis augue lacinia, euismod augue eget, sollicitudin nibh.</dd>
										<dt>Pellentesque</dt>
										<dd>Facilisis ultricies leo quis sollicitudin.</dd>
										<dt>Interdum</dt>
										<dd>Et malesuada fames ac ante ipsum primis in faucibus. Nunc ut elit vitae nunc commodo ornare.</dd>
									</dl>
									<pre class='prettyprint'><code>&lt;dl&gt;
	&lt;dt&gt;Lorem&lt;/dt&gt;
	&lt;dd&gt;Ipsum dolor sit amet, consectetur adipiscing elit.&lt;/dd&gt;
	&lt;dt&gt;Suspendisse&lt;/dt&gt;
	&lt;dd&gt;Quis augue lacinia, euismod augue eget, sollicitudin nibh.&lt;/dd&gt;
	&lt;dt&gt;Pellentesque&lt;/dt&gt;
	&lt;dd&gt;Facilisis ultricies leo quis sollicitudin.&lt;/dd&gt;
	&lt;dt&gt;Interdum&lt;/dt&gt;
	&lt;dd&gt;Et malesuada fames ac ante ipsum primis in faucibus. Nunc ut elit vitae nunc commodo ornare.&lt;/dd&gt;
&lt;/dl&gt;</code></pre>
								</div>
							</div>
						</section>
						<section>
							<div class='row'>
								<div class='col-xs-12'>
									<hr class='dotted' />
									<h3>Callouts</h3>
									<h4>Standard</h4>
									<div class='co'>
										<h5>Everything is fine</h5>
										<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse cursus est quis nunc sodales pretium. Sed enim mauris, eleifend semper venenatis ac, dapibus in turpis.</p>
									</div>
									<pre class='prettyprint'><code>&lt;div class=&quot;co&quot;&gt;
	&lt;h5&gt;Everything is fine&lt;/h5&gt;
	&lt;p&gt;Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse cursus est quis nunc sodales pretium. Sed enim mauris, eleifend semper venenatis ac, dapibus in turpis.&lt;/p&gt;
&lt;/div&gt;</code></pre>
									<hr class='dotted' />
									<h4>Error</h4>
									<div class='co co-error'>
										<h5>Oh no!</h5>
										<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse cursus est quis nunc sodales pretium. Sed enim mauris, eleifend semper venenatis ac, dapibus in turpis.</p>
									</div>
									<pre class='prettyprint'><code>&lt;div class=&quot;co co-error&quot;&gt;
	&lt;h5&gt;Oh no!&lt;/h5&gt;
	&lt;p&gt;Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse cursus est quis nunc sodales pretium. Sed enim mauris, eleifend semper venenatis ac, dapibus in turpis.&lt;/p&gt;
&lt;/div&gt;</code></pre>
									<hr class='dotted' />
									<h4>Warning</h4>
									<div class='co co-warning'>
										<h5>Be careful!</h5>
										<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse cursus est quis nunc sodales pretium. Sed enim mauris, eleifend semper venenatis ac, dapibus in turpis.</p>
									</div>
									<pre class='prettyprint'><code>&lt;div class=&quot;co co-warning&quot;&gt;
	&lt;h5&gt;Be careful!&lt;/h5&gt;
	&lt;p&gt;Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse cursus est quis nunc sodales pretium. Sed enim mauris, eleifend semper venenatis ac, dapibus in turpis.&lt;/p&gt;
&lt;/div&gt;</code></pre>
									<hr class='dotted' />
									<h4>Success</h4>
									<div class='co co-success'>
										<h5>Fantastic!</h5>
										<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse cursus est quis nunc sodales pretium. Sed enim mauris, eleifend semper venenatis ac, dapibus in turpis.</p>
									</div>
									<pre class='prettyprint'><code>&lt;div class=&quot;co co-success&quot;&gt;
	&lt;h5&gt;Fantastic!&lt;/h5&gt;
	&lt;p&gt;Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse cursus est quis nunc sodales pretium. Sed enim mauris, eleifend semper venenatis ac, dapibus in turpis.&lt;/p&gt;
&lt;/div&gt;</code></pre>
								</div>
							</div>
							<hr class='dotted' />
						</section>
					</div>"
?>

<?php include("../layout.tpl.php"); ?>


