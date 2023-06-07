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
<div class="w3-col l4">
	<div class="w3-white w3-margin">
		<ul class="w3-card w3-ul w3-hoverable w3-white">
			<div class="w3-container w3-padding w3-win8-steel">
				<a href="<?php echo get_url('plugin/archive/settings'); ?>"><h4> <?php echo __('CodeMirror Syntax Highlighter');?></h4></a>
			</div>
			<p class="w3-padding">
				CodeMirror plugin provides syntax highlighter for Eteon MVC backend editor (pages, snippets and layouts).
				Currently, this plugin provides only several parser (HTML, CSS, Javascript and PHP).
				CodeMirror documentation can be found <a href="http://codemirror.net/manual.html"><strong>here</strong></a>.
				Optional: integrate with <a href="https://airzox.com/repository/8"><strong>File Manager</strong></a> plugin.
			</p>
		</ul>
	</div>
</div>
