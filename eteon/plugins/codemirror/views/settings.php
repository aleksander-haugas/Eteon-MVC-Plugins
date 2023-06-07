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
<header class="w3-container" style="padding-top:22px">
<h5>
	<strong><i class="fa fa-hdd-o"></i> <?php echo __('CodeMirror Syntax Highlighter'); ?> Plugin | <?php echo __('Settings'); ?></strong>
</h5>
</header>
<div class="w3-col l8 s12">
	<div class="w3-margin">
		<div class="w3-justify">
		<form action="<?php echo get_url('plugin/codemirror/save'); ?>" method="post">
			<div class="w3-row w3-section w3-white w3-padding">
				<p>
					<label for="cmintegrate" class="w3-text-grey"><?php echo __('Integrate:'); ?></label>
					<input name="cmintegrate" id="cmintegrate" type="checkbox" <?php echo ($file_manager ? 'checked="true"' : ''); ?> class="w3-check w3-border w3-hover-light-gray">
					<small class="help"><?php echo __('Integrate with <strong>File Manager</strong> plugin.'); ?></small>
				</p>
				<p class="buttons">
					<input class="w3-button w3-green" name="commit" type="submit" accesskey="s" value="<?php echo __('Save'); ?>">
				</p>
			</div>
		</form>
		</div>
	</div>
</div>
