<?php 
  $title = "Tables"; 
  $metaContent = "For tabular data only.";
  $heroTitle = "Tables";
  $page = "tables";
?>

<?php $content =		
				"<div class='container'>
					<section>
						<div class='row'>
							<div class='col-sm-12'>
								<h3>Basic</h3>
								<hr class='dotted' />
								<table class='table'>
									<thead>
										<tr>
											<th>#</th>
											<th>First name</th>
											<th>Last name</th>
											<th>Username</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td>1</td>
											<td>John</td>
											<td>Smith</td>
											<td>jsmith</td>
										</tr>
										<tr>
											<td>2</td>
											<td>Jane</td>
											<td>Doe</td>
											<td>jdoe</td>
										</tr>
										<tr>
											<td>3</td>
											<td>Maxamillion</td>
											<td>Peters</td>
											<td>mpeters</td>
										</tr>
									</tbody>
								</table>
								<pre class='prettyprint'><code>&lt;table class='table'&gt;
	&hellip;
&lt;/table&gt;</code></pre>
							<hr class='dotted' />
							</div>
						</div>
					</section>
				
					<section>
						<div class='row'>
							<div class='col-sm-12'>
								<h3>Striped</h3>
								<div class='co co-error'>
									<h5>Warning</h5>
									<p>Due to using <code>:nth-child(odd)</code> to add the striping, this type of table will not work in IE8 and below.</p>
								</div>
								<hr class='dotted' />
								<table class='table table-striped'>
									<thead>
										<tr>
											<th>#</th>
											<th>First name</th>
											<th>Last name</th>
											<th>Username</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td>1</td>
											<td>John</td>
											<td>Smith</td>
											<td>jsmith</td>
										</tr>
										<tr>
											<td>2</td>
											<td>Jane</td>
											<td>Doe</td>
											<td>jdoe</td>
										</tr>
										<tr>
											<td>3</td>
											<td>Maxamillion</td>
											<td>Peters</td>
											<td>mpeters</td>
										</tr>
									</tbody>
								</table>
								<pre class='prettyprint'><code>&lt;table class='table table-striped'&gt;
	&hellip;
&lt;/table&gt;</code></pre>
							<hr class='dotted' />
							</div>
						</div>
					</section>
				
					<section>
						<div class='row'>
							<div class='col-sm-12'>
								<h3>Hover</h3>
								<hr class='dotted' />
								<table class='table table-hover'>
									<thead>
										<tr>
											<th>#</th>
											<th>First name</th>
											<th>Last name</th>
											<th>Username</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td>1</td>
											<td>John</td>
											<td>Smith</td>
											<td>jsmith</td>
										</tr>
										<tr>
											<td>2</td>
											<td>Jane</td>
											<td>Doe</td>
											<td>jdoe</td>
										</tr>
										<tr>
											<td>3</td>
											<td>Maxamillion</td>
											<td>Peters</td>
											<td>mpeters</td>
										</tr>
									</tbody>
								</table>
								<pre class='prettyprint'><code>&lt;table class='table table-hover'&gt;
	&hellip;
&lt;/table&gt;</code></pre>
							<hr class='dotted' />
							</div>
						</div>
					</section>
				
					<section>
						<div class='row'>
							<div class='col-sm-12'>
								<h3>Responsive Overflow</h3>
								<p>The most basic implementation of a responsive table.</p>
								<hr class='dotted' />
								<div class='responsive-table-ovf'>
									<table class='table'>
										<thead>
											<tr>
												<th>#</th>
												<th>First name</th>
												<th>Last name</th>
												<th>Username</th>
												<th>DOB</th>
												<th>City</th>
												<th>State</th>
											</tr>
										</thead>
										<tbody>
											<tr>
												<td>1</td>
												<td>John</td>
												<td>Smith</td>
												<td>jsmith</td>
												<td>October 10, 1952 </td>
												<td>San Francisco</td>
												<td>California</td>
											</tr>
											<tr>
												<td>2</td>
												<td>Jane</td>
												<td>Doe</td>
												<td>jdoe</td>
												<td>January 2, 1980</td>
												<td>Milwaukee</td>
												<td>Wisconsin</td>
											</tr>
											<tr>
												<td>3</td>
												<td>Maxamillion</td>
												<td>Peters</td>
												<td>mpeters</td>
												<td>August 14, 2011</td>
												<td>Chicago</td>
												<td>Illinois</td>
											</tr>
										</tbody>
									</table>
								</div>
								<pre class='prettyprint'><code>&lt;div class='responsive-table-ovf'&gt;
	&lt;table class='table'&gt;
		&hellip;
	&lt;/table&gt;
&lt;/div&gt;</code></pre>
							<hr class='dotted' />
							</div>
						</div>
					</section>
				
					<section>
						<div class='row'>
							<div class='col-sm-12'>
								<h3>Responsive Stacked</h3>
								<p>Each row is broken out and stacked using <code>data-title</code> for the table heading.</p>
								<div class='co co-error'>
									<h5>Warning</h5>
									<p>Due to using <code>data-title</code> to bind the table headings, this type of table will not work in IE8 and below.</p>
								</div>
								<hr class='dotted' />
								<div class='responsive-table-stk'>
									<table class='table table-striped'>
										<thead>
											<tr>
												<th>#</th>
												<th>First name</th>
												<th>Last name</th>
												<th>Username</th>
												<th>DOB</th>
												<th>City</th>
												<th>State</th>
											</tr>
										</thead>
										<tbody>
											<tr>
												<td data-title='#'>1</td>
												<td data-title='First'>John</td>
												<td data-title='Last'>Smith</td>
												<td data-title='Username'>jsmith</td>
												<td data-title='DOB'>October 10, 1952 </td>
												<td data-title='City'>San Francisco</td>
												<td data-title='State'>California</td>
											</tr>
											<tr>
												<td data-title='#'>2</td>
												<td data-title='First'>Jane</td>
												<td data-title='Last'>Doe</td>
												<td data-title='Username'>jdoe</td>
												<td data-title='DOB'>January 2, 1980</td>
												<td data-title='City'>Milwaukee</td>
												<td data-title='State'>Wisconsin</td>
											</tr>
											<tr>
												<td data-title='#'>3</td>
												<td data-title='First'>Maxamillion</td>
												<td data-title='Last'>Peters</td>
												<td data-title='Username'>mpeters</td>
												<td data-title='DOB'>August 14, 2011</td>
												<td data-title='City'>Chicago</td>
												<td data-title='State'>Illinois</td>
											</tr>
										</tbody>
									</table>
								</div>
								<pre class='prettyprint'><code>&lt;div class=&quot;responsive-table-stk&quot;&gt;
	&lt;table class=&quot;table table-striped&quot;&gt;
		&lt;thead&gt;
			&lt;tr&gt;
				&lt;th&gt;#&lt;/th&gt;
				&lt;th&gt;First name&lt;/th&gt;
				&lt;th&gt;Last name&lt;/th&gt;
				&lt;th&gt;Username&lt;/th&gt;
				&lt;th&gt;DOB&lt;/th&gt;
				&lt;th&gt;City&lt;/th&gt;
				&lt;th&gt;State&lt;/th&gt;
			&lt;/tr&gt;
		&lt;/thead&gt;
		&lt;tbody&gt;
			&lt;tr&gt;
				&lt;td data-title=&quot;#&quot;&gt;1&lt;/td&gt;
				&lt;td data-title=&quot;First&quot;&gt;John&lt;/td&gt;
				&lt;td data-title=&quot;Last&quot;&gt;Smith&lt;/td&gt;
				&lt;td data-title=&quot;Username&quot;&gt;jsmith&lt;/td&gt;
				&lt;td data-title=&quot;DOB&quot;&gt;October 10, 1952 &lt;/td&gt;
				&lt;td data-title=&quot;City&quot;&gt;San Francisco&lt;/td&gt;
				&lt;td data-title=&quot;State&quot;&gt;California&lt;/td&gt;
			&lt;/tr&gt;
			&lt;tr&gt;
				&lt;td data-title=&quot;#&quot;&gt;2&lt;/td&gt;
				&lt;td data-title=&quot;First&quot;&gt;Jane&lt;/td&gt;
				&lt;td data-title=&quot;Last&quot;&gt;Doe&lt;/td&gt;
				&lt;td data-title=&quot;Username&quot;&gt;jdoe&lt;/td&gt;
				&lt;td data-title=&quot;DOB&quot;&gt;January 2, 1980&lt;/td&gt;
				&lt;td data-title=&quot;City&quot;&gt;Milwaukee&lt;/td&gt;
				&lt;td data-title=&quot;State&quot;&gt;Wisconsin&lt;/td&gt;
			&lt;/tr&gt;
			&lt;tr&gt;
				&lt;td data-title=&quot;#&quot;&gt;3&lt;/td&gt;
				&lt;td data-title=&quot;First&quot;&gt;Maxamillion&lt;/td&gt;
				&lt;td data-title=&quot;Last&quot;&gt;Peters&lt;/td&gt;
				&lt;td data-title=&quot;Username&quot;&gt;mpeters&lt;/td&gt;
				&lt;td data-title=&quot;DOB&quot;&gt;August 14, 2011&lt;/td&gt;
				&lt;td data-title=&quot;City&quot;&gt;Chicago&lt;/td&gt;
				&lt;td data-title=&quot;State&quot;&gt;Illinois&lt;/td&gt;
			&lt;/tr&gt;
		&lt;/tbody&gt;
	&lt;/table&gt;
&lt;/div&gt;</code></pre>
							<hr class='dotted' />
							</div>
						</div>
					</section>
				</div>"
?>

<?php include("../layout.tpl.php"); ?>

