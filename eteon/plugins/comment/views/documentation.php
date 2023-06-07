<?php
	/*
		Version: 			0.9.4
		WebSite: 		http://eteon.airzox.com
		Licensed:		AirZox Technologies
		License-key:		KJXS-NMAL-004D-V15A
		Developed by: 	Aleksander Haugas (Eteon MVC)
		
		Copyright (C) 2021, AirZox All rights reserved.
		
		THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
		IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
		FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
		AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
		LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
		OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
		THE SOFTWARE.
	*/

	/* Security measure */
	if (!defined('IN_CMS')) { exit(); }
?>
<!-- Empieza Header -->
<header class="w3-container" style="padding-top:22px">
	<h5>
		<strong>
			<i class="fa fa-book"></i> <?php echo __('Comments Plugin'); ?> | <?php echo __('Documentation'); ?>
		</strong>
	</h5>
</header>
<!-- Termina Header -->
<div class="w3-col l8 s12">
	<div class="w3-margin">
		<div class="w3-responsive">
			<div class="w3-row w3-theme-light w3-padding">
				<div class="w3-row">
					<h3>How to use this plugin</h3>
					<p>
						By default, the comments plugin tab displays for example: "Comments (2/5)". This means that two comments are
						waiting for approval in the moderation list out of five total comments.
					</p>
				</div>
			</div>
		</div>
	</div>
	<div class="w3-margin">
		<div class="w3-responsive">
			<div class="w3-row w3-theme-light w3-padding">
				<div class="w3-row">
					<h3>Comments options</h3>
					<p>
						On each page edit screen, you will have a drop-down box available called "Comments".
						From this, you can choose between three options:
					</p>
					<ul class="w3-ul">
						<li><span class="w3-tag">none:</span> if you do not want comments displayed on the page.</li>
						<li><span class="w3-tag">open:</span> if you want comments displayed and want people to be able to post comments.</li>
						<li><span class="w3-tag">close:</span> if you want to display comments, but do not want people do be able to post new comments.</li>
					</ul>
					<p>	You will need to add this code to your layout, snippet or (page content, page part):</p>
					<pre>
						<code class="language-php hljs">
&lt;?php
if (Plugin::isEnabled('comment'))
{
if ($this->comment_status != Comment::NONE)
$this->includeSnippet('comment-each');
if ($this->comment_status == Comment::OPEN)
$this->includeSnippet('comment-form');
}
?&gt;
						</code>
					</pre>
				</div>
			</div>
		</div>
	</div>
	<div class="w3-margin">
		<div class="w3-responsive">
			<div class="w3-row w3-theme-light w3-padding">
				<div class="w3-row">
					<h3>Notes</h3>
					<p>
						When you disable the comments plugin, the database table, snippets and page.comment_status stay available.
					</p>
					<p>
						If you disable the comments plugin, you can leave the code you added to the layout if you want. Use of the isEnabled() function prevents any PHP errors.
					</p>
				</div>
			</div>
		</div>
	</div>
</div>
