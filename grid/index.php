
				
<?php 
  $title = "Grid";
  $metaContent = "Let's get organized.";
  $heroTitle = "Grid";
  $page = "grid";
?>

<?php $content =	
				"<section>
					<div class='container'>
						<div class='row'>
							<div class='col-sm-12'>
								<p>For full explanation see the <a href='http://getbootstrap.com/css/#grid'>Twitter Boostrap Grid Documentation</a></p>
							</div>
						</div>
					</div>
					<div class='container grid'>
						<div class='row'>
							<div class='col-sm-8'>
								<p>col-sm-8</p>
							</div>
							<div class='col-sm-4'>
								<p>col-sm-4</p>
							</div>
						</div>
						
						<div class='row'>
							<div class='col-xs-12'>
								<pre class='prettyprint'><code>&lt;div class='row'&gt;
	&lt;div class='col-sm-8'&gt;&lt;/div&gt;
	&lt;div class='col-sm-4'&gt;&lt;/div&gt;
&lt;/div&gt;</code></pre>
							</div>
						</div>
						<div class='row'>
							<div class='col-md-1'><p>col-md-1</p></div>
							<div class='col-md-1'><p>col-md-1</p></div>
							<div class='col-md-1'><p>col-md-1</p></div>
							<div class='col-md-1'><p>col-md-1</p></div>
							<div class='col-md-1'><p>col-md-1</p></div>
							<div class='col-md-1'><p>col-md-1</p></div>
							<div class='col-md-1'><p>col-md-1</p></div>
							<div class='col-md-1'><p>col-md-1</p></div>
							<div class='col-md-1'><p>col-md-1</p></div>
							<div class='col-md-1'><p>col-md-1</p></div>
							<div class='col-md-1'><p>col-md-1</p></div>
							<div class='col-md-1'><p>col-md-1</p></div>
						</div>
						<div class='row'>
						<div class='col-xs-12'>
								<pre class='prettyprint'><code>&lt;div class='row'&gt;
	&lt;div class='col-md-1'&gt;&lt;/div&gt;
	&lt;div class='col-md-1'&gt;&lt;/div&gt;
	&lt;div class='col-md-1'&gt;&lt;/div&gt;
	&lt;div class='col-md-1'&gt;&lt;/div&gt;
	&lt;div class='col-md-1'&gt;&lt;/div&gt;
	&lt;div class='col-md-1'&gt;&lt;/div&gt;
	&lt;div class='col-md-1'&gt;&lt;/div&gt;
	&lt;div class='col-md-1'&gt;&lt;/div&gt;
	&lt;div class='col-md-1'&gt;&lt;/div&gt;
	&lt;div class='col-md-1'&gt;&lt;/div&gt;
	&lt;div class='col-md-1'&gt;&lt;/div&gt;
	&lt;div class='col-md-1'&gt;&lt;/div&gt;
&lt;/div&gt;</code></pre>
							</div>
						</div>
						<div class='row nested'>
							<div class='col-xs-12'>
								<h3>Nested Rows Examples (Make stuff add up to 12)</h3>
								<div class='row'>
									<div class='col-xs-6'>
										<p>Level 1: col-xs-6 (always horizontal)</p>
										<div class='row'>
											<div class='col-sm-6'>
												<p>Level 2: col-sm-6</p>
												<div class='row'>
													<div class='col-sm-6'>
														<p>Level 3: col-sm-6</p>
													</div>
													<div class='col-sm-6'>
														<p>Level 3: col-sm-6</p>
													</div>
												</div>
											</div>
											<div class='col-sm-6'>
												<p>Level 2: col-sm-6</p>
												<div class='row'>
													<div class='col-sm-6'>
														<p>Level 3: col-sm-6</p>
													</div>
													<div class='col-sm-6'>
														<p>Level 3: col-sm-6</p>
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class='col-xs-6'>
										<p>Level 1: col-xs-6 (always horizontal)</p>
										<div class='row'>
											<div class='col-sm-6'>
												<p>Level 2: col-sm-6</p>
												<div class='row'>
													<div class='col-sm-6'>
														<p>Level 3: col-sm-6</p>
													</div>
													<div class='col-sm-6'>
														<p>Level 3: col-sm-6</p>
													</div>
												</div>
											</div>
											<div class='col-sm-6'>
												<p>Level 2: col-sm-6</p>
												<div class='row'>
													<div class='col-sm-6'>
														<p>Level 3: col-sm-6</p>
													</div>
													<div class='col-sm-6'>
														<p>Level 3: col-sm-6</p>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>							
							</div>
						</div>
						<div class='row'>
							<div class='col-xs-12'>
							<pre class='prettyprint'><code>&lt;div class=&quot;row&quot;&gt;
	&lt;div class=&quot;col-xs-6&quot;&gt;
		&lt;div class='row'&gt;
			&lt;div class='col-sm-6'&gt;
				&lt;div class='row'&gt;
					&lt;div class='col-sm-6'&gt;&lt;/div&gt;
					&lt;div class='col-sm-6'&gt;&lt;/div&gt;
				&lt;/div&gt;
			&lt;/div&gt;
			&lt;div class='col-sm-6'&gt;
				&lt;div class='row'&gt;
					&lt;div class='col-sm-6'&gt;&lt;/div&gt;
					&lt;div class='col-sm-6'&gt;&lt;/div&gt;
				&lt;/div&gt;
			&lt;/div&gt;
		&lt;/div&gt;
	&lt;/div&gt;
	&lt;div class=&quot;col-xs-6&quot;&gt;
		&lt;div class='row'&gt;
			&lt;div class='col-sm-6'&gt;
				&lt;div class='row'&gt;
					&lt;div class='col-sm-6'&gt;&lt;/div&gt;
					&lt;div class='col-sm-6'&gt;&lt;/div&gt;
				&lt;/div&gt;
			&lt;/div&gt;
			&lt;div class='col-sm-6'&gt;
				&lt;div class='row'&gt;
					&lt;div class='col-sm-6'&gt;&lt;/div&gt;
					&lt;div class='col-sm-6'&gt;&lt;/div&gt;
				&lt;/div&gt;
			&lt;/div&gt;
		&lt;/div&gt;
	&lt;/div&gt;
&lt;/div&gt;</code></pre>
							</div>
						</div>
							<hr class='dotted' />
					</div>
				</section>"
?>


<?php include("../layout.tpl.php"); ?>