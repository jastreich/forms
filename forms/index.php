
<?php 
  $title = "Forms";
  $metaContent = "Welcome to the wonderful world of forms!";
  $heroTitle = "Forms";
  $page = "forms";
?>

<?php $content =
					"<div class='container forms'>
						<section>
							<div class='row'>
								<div class='col-xs-12'>
									<h3>Requirements</h3>
									<p>The following scripts are required for cross browser polyfills and validation when using forms in the framework. They should only be brought in on pages that contain form elements.</p>
									<p>The&nbsp;&nbsp;<code>&lt;script&gt;</code>&nbsp;&nbsp;stack in the&nbsp;&nbsp;<code>&lt;head&gt;</code>&nbsp;&nbsp;should be modified to this:</p>
									<pre class='prettyprint'><code>&lt;script src=&quot;/js/vendor/modernizr-2.6.2.min.js&quot;&gt;&lt;/script&gt;
&lt;!--[if lt IE 9]&gt;
	&lt;script src=&quot;/js/vendor/respond.min.js&quot;&gt;&lt;/script&gt;
&lt;![endif]--&gt;
&lt;script src='/js/shared/js/EventHelpers.js'>&lt;/script&gt;
&lt;script src='/js/shared/js/html5Forms.js' data-webforms2-support='validation, placeholder'&gt;&lt;/script&gt;</code></pre>
								<p>The <code>data-webforms2-support</code> attribute should be modified based on different polyfills needed for the form. For more information visit the <a href='http://www.useragentman.com/blog/2010/07/27/creating-cross-browser-html5-forms-now-using-modernizr-webforms2-and-html5widgets-2/'>Creating Cross Browser HTML5 Forms</a> documentation.</p>
							</div>
						</div>
					</section>
					<section>
							<div class='row'>
								<div class='col-xs-12'>
									<h3>Inputs</h3>
									<hr class='dotted' />
									<h4>Text Input</h4>
									<label>Login
										<input class='no-valid' type='text' name='login' value='' placeholder='Enter login'>
									</label>
									<pre class='prettyprint'><code>&lt;label&gt;Login
	&lt;input class='no-valid' type='text' name='login' value='' placeholder='Enter login'&gt;
&lt;/label&gt;</code></pre>
								</div>
							</div>
						</section>
						<section>
							<div class='row'>
								<div class='col-xs-12'>
									<hr class='dotted' />
									<h4>Text Area</h4>
									<label for='exampleComments'>Comments</label>
									<textarea class='no-valid' id='exampleComments' rows='4' placeholder='Add comments here'></textarea>
									<pre class='prettyprint'><code>&lt;label for='exampleComments'&gt;Comments&lt;/label&gt;
&lt;textarea class='no-valid' id='exampleComments' rows='4' placeholder='Add comments here'&gt;&lt;/textarea&gt;</code></pre>
								</div>
							</div>
						</section>
						<section>
							<div class='row'>
								<div class='col-xs-12'>
									<hr class='dotted' />
									<h4>Checkbox</h4>
									<h5>Standard</h5>
									<div class='checkbox'>
										<label>
											<input type='checkbox' class='no-valid' value=''>
											Pellentesque urna felis, iaculis sed ligula et, feugiat imperdiet turpis.
										</label>
									</div>
									<div class='checkbox'>
										<label>
											<input type='checkbox' class='no-valid' value=''>
											Aliquam nisi orci, sollicitudin nec justo a, fringilla pellentesque arcu.
										</label>
									</div>
									<pre class='prettyprint'><code>&lt;div class='checkbox'&gt;
	&lt;label&gt;						
		&lt;input type='checkbox' value=''&gt;
		Pellentesque urna felis, iaculis sed ligula et, feugiat imperdiet turpis.
	&lt;/label&gt;
&lt;/div&gt;
&lt;div class='checkbox'&gt;
	&lt;label&gt;
		&lt;input type='checkbox' value=''&gt;
		Aliquam nisi orci, sollicitudin nec justo a, fringilla pellentesque arcu.
	&lt;/label&gt;
&lt;/div&gt;</code></pre>
									<h5>Inline</h5>
									<label class='checkbox-inline'>
										<input type='checkbox' class='no-valid' id='inlineCheckbox1' value='option1'> 1
									</label>
									<label class='checkbox-inline'>
										<input type='checkbox' class='no-valid' id='inlineCheckbox2' value='option2'> 2
									</label>
									<label class='checkbox-inline'>
										<input type='checkbox' class='no-valid' id='inlineCheckbox3' value='option3'> 3
									</label>
									<label class='checkbox-inline'>
										<input type='checkbox' class='no-valid' id='inlineCheckbox4' value='option4'> 4
									</label>
									<label class='checkbox-inline'>
										<input type='checkbox' class='no-valid' id='inlineCheckbox5' value='option5'> 5
									</label>
									<pre class='prettyprint'><code>&lt;label class=&quot;checkbox-inline&quot;&gt;
	&lt;input type='checkbox' id='inlineCheckbox1' value='option1'&gt; 1
&lt;/label&gt;
&lt;label class=&quot;checkbox-inline&quot;&gt;
	&lt;input type='checkbox' id='inlineCheckbox2' value='option2'&gt; 2
&lt;/label&gt;
&lt;label class=&quot;checkbox-inline&quot;&gt;
	&lt;input type='checkbox' id='inlineCheckbox3' value='option3'&gt; 3
&lt;/label&gt;
&lt;label class=&quot;checkbox-inline&quot;&gt;
	&lt;input type='checkbox' id='inlineCheckbox4' value='option4'&gt; 4
&lt;/label&gt;
&lt;label class=&quot;checkbox-inline&quot;&gt;
	&lt;input type='checkbox' id='inlineCheckbox5' value='option5'&gt; 5
&lt;/label&gt;</code></pre>
								</div>
							</div>
						</section>
						<section>
							<div class='row'>
								<div class='col-xs-12'>
									<hr class='dotted' />
									<h4>Radio</h4>
									<h5>Standard</h5>
									<div class='radio'>
											<label>
												<input type='radio' class='no-valid' name='optionsRadios' id='optionsRadios1' value='option1' checked>
												Yes
											</label>
									</div>
									<div class='radio'>
										<label>
											<input type='radio' class='no-valid' name='optionsRadios' id='optionsRadios2' value='option2'>
											No
										</label>
									</div>
									<pre class='prettyprint'><code>&lt;div class=&quot;radio&quot;&gt;
	&lt;label&gt;
		&lt;input type=&quot;radio&quot; name=&quot;optionsRadios&quot; id=&quot;optionsRadios1&quot; value=&quot;option1&quot; checked&gt;
		Yes
	&lt;/label&gt;
&lt;/div&gt;
&lt;div class=&quot;radio&quot;&gt;
	&lt;label&gt;
		&lt;input type=&quot;radio&quot; name=&quot;optionsRadios&quot; id=&quot;optionsRadios2&quot; value=&quot;option2&quot;&gt;
		No
	&lt;/label&gt;
&lt;/div&gt;</code></pre>
								<h5>Inline</h5>
									<label class='radio-inline'>
										<input type='radio' class='no-valid' name='optionsInlineRadios' id='optionsInlineRadios1' value='option1' checked>
										Yes
									</label>
									<label class='radio-inline'>
										<input type='radio' class='no-valid' name='optionsInlineRadios' id='optionsInlineRadios2' value='option2'>
										No
									</label>
									<pre class='prettyprint'><code>&lt;label class=&quot;radio-inline&quot;&gt;
	&lt;input type=&quot;radio&quot; name=&quot;optionsInlineRadios&quot; id=&quot;optionsInlineRadios1&quot; value=&quot;option1&quot; checked&gt;
	Yes
&lt;/label&gt;
&lt;label class=&quot;radio-inline&quot;&gt;
	&lt;input type=&quot;radio&quot; name=&quot;optionsInlineRadios&quot; id=&quot;optionsInlineRadios2&quot; value=&quot;option2&quot;&gt;
	No
&lt;/label&gt;</code></pre>
								</div>
							</div>
						</section>
						<section>
							<div class='row'>
								<div class='col-xs-12'>
									<hr class='dotted' />
									<h4>Select</h4>
									<h5>Standard</h5>
									<select>
										<option>1</option>
										<option>2</option>
										<option>3</option>
										<option>4</option>
										<option>5</option>
									</select>
									<h5>Multiple</h5>
									<select multiple>
										<option>1</option>
										<option>2</option>
										<option>3</option>
										<option>4</option>
										<option>5</option>
									</select>
									<pre class='prettyprint'><code>&lt;select&gt;
	&lt;option&gt;1&lt;/option&gt;
	&lt;option&gt;2&lt;/option&gt;
	&lt;option&gt;3&lt;/option&gt;
	&lt;option&gt;4&lt;/option&gt;
	&lt;option&gt;5&lt;/option&gt;
&lt;/select&gt;

&lt;select multiple&gt;
	&lt;option&gt;1&lt;/option&gt;
	&lt;option&gt;2&lt;/option&gt;
	&lt;option&gt;3&lt;/option&gt;
	&lt;option&gt;4&lt;/option&gt;
	&lt;option&gt;5&lt;/option&gt;
&lt;/select&gt;</code></pre>
								</div>
							</div>
						</section>
						<section>
							<div class='row'>
								<div class='col-xs-12'>
								<hr />
								<h3>Basic Form</h3>
								<hr class='dotted' />
								<h4>Standard (with validation)</h4>
								<div class='row'>
									<div class='col-md-6 col-md-offset-3'>
										<form>
											<div class='form-row'>
												<label>Login
													<input id='exampleLogin' type='text' placeholder='Login' required>
												</label>
											</div>
											<div class='form-row'>
												<label>Password
													<input id='examplePassword' type='password' placeholder='Password' required>
												</label>
											</div>
											<div class='form-row'>
												<label for='exampleFile'>File Input</label>
												<input id='exampleFile' type='file' class='no-valid' />
												<p class='help-block'>Click 'Choose File' to upload your super awesome file!</p>
											</div>
											<div class='form-row'>
												<label class='checkbox-inline'>
													<input type='checkbox' class='no-valid' id='inlineCheckbox1' value='option1'> Remember me
												</label>
											</div>
											<div class='form-row'>
												<input class='btn btn-primary' type='submit' value='Submit' class='no-valid' />
											</div>
										</form>
									</div>
								</div>
								<pre class='prettyprint'><code>&lt;form&gt;
	&lt;div class=&quot;form-row&quot;&gt;
		&lt;label&gt;Login
			&lt;input id=&quot;exampleLogin&quot; type=&quot;text&quot; placeholder=&quot;Enter login&quot; required&gt;
		&lt;/label&gt;
	&lt;/div&gt;
	&lt;div class=&quot;form-row&quot;&gt;
		&lt;label&gt;Password
			&lt;input id=&quot;examplePassword&quot; type=&quot;password&quot; placeholder=&quot;Enter password&quot; required&gt;
		&lt;/label&gt;
	&lt;/div&gt;
	&lt;div class=&quot;form-row&quot;&gt;
		&lt;label for=&quot;exampleFile&quot;&gt;File Input&lt;/label&gt;
		&lt;input id=&quot;exampleFile&quot; type=&quot;file&quot; /&gt;
		&lt;p class=&quot;help-block&quot;&gt;Click 'Choose File' to upload your super awesome file!&lt;/p&gt;
	&lt;/div&gt;
	&lt;div class=&quot;form-row&quot;&gt;
		&lt;label class=&quot;checkbox-inline&quot;&gt;
			&lt;input type=&quot;checkbox&quot; id=&quot;inlineCheckbox1&quot; value=&quot;option1&quot;&gt; Remember me
		&lt;/label&gt;
	&lt;/div&gt;
	&lt;div class=&quot;form-row&quot;&gt;
		&lt;input class=&quot;btn btn-primary&quot; type=&quot;submit&quot; value=&quot;Submit&quot; /&gt;
	&lt;/div&gt;
&lt;/form&gt;</code></pre>
								<hr class='dotted' />
								<h4>Horizontal (with validation)</h4>
								<div class='row'>
									<div class='col-sm-6 col-sm-offset-3'>
										<form class='horizontal-form'>
												<div class='row form-row'>
													<label for='exampleLogin' class='col-sm-3'>Login</label>
													<div class='col-sm-9'>
														<input id='exampleLogin' type='text' placeholder='Enter login' required>
													</div>
												</div>
												<div class='row form-row'>
													<label for='examplePassword' class='col-sm-3'>Password</label>
													<div class='col-sm-9'>
														<input id='examplePassword' type='password' placeholder='Enter password' required>
													</div>
												</div>
												<div class='row form-row'>
													<label for='exampleFile' class='col-sm-3'>File Input</label>
													<div class='col-sm-9'>
														<input id='exampleFile' type='file' class='no-valid' />
														<p class='help-block'>Click 'Choose File' to upload your super awesome file!</p>
													</div>
												</div>
												<div class='row form-row'>
													<div class='col-sm-9 col-sm-offset-3'>
														<label class='checkbox-inline'>
															<input type='checkbox' class='no-valid' id='inlineCheckbox1' value='option1'> Remember me
														</label>
													</div>
												</div>
												<div class='row form-row'>
													<div class='col-sm-9 col-sm-offset-3'>
														<input class='btn btn-primary' type='submit' value='Submit' class='no-valid' />
													</div>
												</div>
											</form>
										</div>
								</div>
								<pre class='prettyprint'><code>&lt;form class=&quot;horizontal-form&quot;&gt;
	&lt;div class=&quot;row form-row&quot;&gt;
		&lt;label for=&quot;exampleLogin&quot; class=&quot;col-md-3&quot;&gt;Login&lt;/label&gt;
		&lt;div class=&quot;col-md-9&quot;&gt;
			&lt;input id=&quot;exampleLogin&quot; type=&quot;text&quot; placeholder=&quot;Enter login&quot; required&gt;
		&lt;/div&gt;
	&lt;/div&gt;
	&lt;div class=&quot;row form-row&quot;&gt;
		&lt;label for=&quot;examplePassword&quot; class=&quot;col-md-3&quot;&gt;Password&lt;/label&gt;
		&lt;div class=&quot;col-md-9&quot;&gt;
			&lt;input id=&quot;examplePassword&quot; type=&quot;password&quot; placeholder=&quot;Enter password&quot; required&gt;
		&lt;/div&gt;
	&lt;/div&gt;
	&lt;div class=&quot;row form-row&quot;&gt;
		&lt;label for=&quot;exampleFile&quot; class=&quot;col-md-3&quot;&gt;File Input&lt;/label&gt;
		&lt;div class=&quot;col-md-9&quot;&gt;
			&lt;input id=&quot;exampleFile&quot; type=&quot;file&quot; /&gt;
			&lt;p class=&quot;help-block&quot;&gt;Click 'Choose File' to upload your super awesome file!&lt;/p&gt;
		&lt;/div&gt;
	&lt;/div&gt;
	&lt;div class=&quot;row form-row&quot;&gt;
		&lt;div class=&quot;col-md-9 col-md-offset-3&quot;&gt;
			&lt;label class=&quot;checkbox-inline&quot;&gt;
				&lt;input type=&quot;checkbox&quot; id=&quot;inlineCheckbox1&quot; value=&quot;option1&quot;&gt; Remember me
			&lt;/label&gt;
		&lt;/div&gt;
	&lt;/div&gt;
	&lt;div class=&quot;row form-row&quot;&gt;
		&lt;div class=&quot;col-md-9 col-md-offset-3&quot;&gt;
			&lt;input class=&quot;btn btn-primary&quot; type=&quot;submit&quot; value=&quot;Submit&quot; /&gt;
		&lt;/div&gt;
	&lt;/div&gt;
&lt;/form&gt;</code></pre>
								<hr class='dotted' />
								</div>
							</div>
						</section>
					</div>"
?>

<?php include("../layout.tpl.php"); ?>