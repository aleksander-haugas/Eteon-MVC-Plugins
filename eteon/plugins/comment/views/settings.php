<?php
	/*
		Version: 		0.9.4
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
	
	if (!AuthUser::hasPermission('admin_edit')){ 
		exit();
	}
?>
<!-- Empieza Header -->
<header class="w3-container" style="padding-top:22px">
	<h5><strong><i class="fa fa-gear"></i> <?php echo __('Comments Plugin'); ?> | <?php echo __('Settings'); ?></strong></h5>
</header>
<!-- Termina Header -->
<div  class="w3-col l8 s12">
	<div class="w3-margin">
		<div class="w3-responsive">
			<div class="w3-row w3-theme-light w3-padding">
				<div class="w3-row">
					<form action="<?php echo get_url('plugin/comment/save'); ?>" method="post">
							<p>
								<label for="autoapprove" class="w3-text-grey"><?php echo __('Auto approve'); ?>: </label>
								<select name="autoapprove" class="w3-input w3-border w3-hover-light-gray">
									<option value="1" <?php if($approve == "1") echo 'selected ="";' ?>><?php echo __('Yes'); ?></option>
									<option value="0" <?php if($approve == "0") echo 'selected ="";' ?>><?php echo __('No'); ?></option>
								</select>	
								<small class="help"><?php echo __('Choose yes if you want your comments to be auto approved. Otherwise, they will be placed in the moderation queue.'); ?></small>
							</p>
							<p>
								<label for="captcha" class="w3-text-grey"><?php echo __('Use captcha'); ?>: </label>
								<select name="captcha" class="w3-input w3-border w3-hover-light-gray">
									<option value="1" <?php if($captcha == "1") echo 'selected ="";' ?>><?php echo __('Yes'); ?></option>
									<option value="2" <?php if($captcha == "2") echo 'selected ="";' ?>><?php echo __('No'); ?></option>
								</select>	
								<small class="help"><?php echo __('Choose yes if you want to use a captcha to protect yourself against spammers.'); ?></small>
							</p>
							<p>
								<label for="rowspage" class="w3-text-grey"><?php echo __('Comments per page'); ?>: </label>
								<input type="text" class="w3-input w3-border w3-hover-light-gray" value="<?php echo $rowspage; ?>" name="rowspage" />
								<small class="help"><?php echo __('Sets the number of comments to be displayed per page in the backend.'); ?></small>
							</p>
							<p>
								<label for="numlabel" class="w3-text-grey"><?php echo __('Enhance comments tab'); ?>: </label>
								<select name="numlabel" class="w3-input w3-border w3-hover-light-gray">
									<option value="1" <?php if($numlabel == "1") echo 'selected ="";' ?>><?php echo __('Yes'); ?></option>
									<option value="0" <?php if($numlabel == "0") echo 'selected ="";' ?>><?php echo __('No'); ?></option>
								</select>
								<small class="help"><?php echo __("Choose yes if you want to display the number of to-be-moderated &amp; total number of comment in the tab of the Comment plugin."); ?></small>
							</p>
						<br/>
						<p class="buttons">
							<input class="w3-button w3-green" name="commit" type="submit" accesskey="s" value="<?php echo __('Save'); ?>" />
						</p>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
