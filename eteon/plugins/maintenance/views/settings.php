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
<header class="w3-container" id="content-header">
	<h5>
		<strong>
			<i class="fa fa-gears"></i>  <?php echo __('Maintenance'); ?> | <?php echo __('Settings'); ?>
		</strong>
	</h5>
</header>
<!-- Termina Header -->


	<!-- Start dashboard Settings -->
	<div  class="w3-col l8 s12">
		<div class="w3-theme-l4 w3-margin">
			<div class="form-area">
				<div id="maintenance-tabs" class="content tabs">
					<div class="w3-bar w3-theme">
						<a href="#maintenance_status" class="w3-bar-item w3-button tablink w3-theme-light" data-tab="maintenance_status" data-option="pageconf"><?php echo __('Status'); ?></a>
						<a href="#maintenance_options" class="w3-bar-item w3-button tablink" data-tab="maintenance_options" data-option="pageconf"><?php echo __('Settings'); ?></a>
						<a href="#maintenance" class="w3-bar-item w3-button tablink" data-tab="maintenance_users" data-option="pageconf"><?php echo __('Users'); ?></a>				</div>
				</div>
			</div>

			<?php $users = User::findAll();?>
			<?php $users_array = explode(',',Plugin::getSetting('users_array', 'maintenance')); ?>
			<form id="maintenance" action="<?php echo get_url('plugin/maintenance/_save'); ?>" method="post">
				<!-- Start maintenance_status -->
				<div id="maintenance_status" class="w3-container pageconf" title="Título de Página">
					<div class="w3-justify">
						<div class="w3-row w3-section">
							<?php
								$url = get_url('plugin/maintenance/_changeStatus');
								$status = Plugin::getSetting('status', 'maintenance');

								if ($status == 'on') { $class_sellect_activate = 'w3-red'; } 
								if ($status == 'off') { $class_sellect_activate = 'w3-green'; } 
							?>
							<ul class="w3-card w3-ul w3-hoverable <?php echo $class_sellect_activate; ?> "> 
								<li class="w3-padding-16 zoom">
									<i class="fa fa-gears w3-xlarge w3-left w3-margin-right" alt="<?php echo __('Settings'); ?>"></i>
									<span class="w3-large">
										<?php if ($status == 'on') { ?><a  href="<?php echo $url; ?>?status=off"> <?php echo __('Turn off maintenance mode'); ?></a><?php } ?>
										<?php if ($status == 'off') { ?><a  href="<?php echo $url; ?>?status=on"><?php echo __('Turn on maintenance mode'); ?></a><?php } ?>
										<?php if ($status != 'on' && $status != 'off') { echo __('Something wrong, reinstall plugin please!'); } ?>
									</span>
								</li>
							</ul>
						</div>
					</div>
				</div>
				<!-- End maintenance_status -->
				<!-- Start maintenance_options -->
				<div id="maintenance_options" class="w3-container pageconf w3-hide" title="Maintenance options">
					<div class="w3-justify">
						<div class="w3-row w3-section">	
							<h3><i class="fa fa-retweet"></i> <?php echo __('Redirect page'); ?></h3>
							<hr>
							<ul class="w3-ul">
								<li>
									<input type="radio" id="redirect_page" name="redirect_page" value="url" <?php echo ($redirect_page == "url")? 'checked="checked"' :'';?> /> <label for="redirect_page" id="lbl_redirect_page"><?php echo __('URL adress'); ?></label> : <input type="text" id="url_page" class="w3-input w3-hide" name="url_page" value="<?php echo $url_page; ?>" />
									<?php if($has_page == true): ?></li>
								<li>
									<input type="radio" id="behavior_page" name="redirect_page" value="behavior_page" <?php echo ($redirect_page == "behavior_page")? 'checked="checked"' : '';?> /> <label for="behavior_page"><?php echo __('Behavior page (maintenance)'); ?></label>
									<?php else: ?>
									<?php echo '<p class="red">'.__('Set maintenance behavior').'</p>'; ?>
									<?php endif; ?>
								</li>
							</ul>
							<h3><i class="fa fa-key"></i> <?php echo __('Backdoor key'); ?></h3>
							<hr>
							<p>This will grant you access to the page without having to enter any additional login credentials.</p>
							<div class="w3-row">
								<div class="w3-twothird">
									<input type="text" value="<?php echo $backdoor_key; ?>" class="w3-input backdoor_key" name="backdoor_key" />
								</div>
								<div class="w3-third">
									<a id="keygen" class="w3-button w3-blue"><?php echo __('click to generate random key'); ?></a>
								</div>
							</div>
							<div class="w3-row w3-margin-top">
								<label class="switch">
									<input type="checkbox" id="backdoor_key_session" name="backdoor_key_session" <?php echo ($backdoor_key_session=='on' ? 'checked="checked"' : ''); ?> /> 
									<span class="slider"></span>
								</label>
								<label for="backdoor_key_session"><?php echo __('Use session to remember key'); ?></label> 
							</div>
							<div class="w3-row">
								<h3><i class="fa fa-globe"></i> <?php echo __('Global ip'); ?></h3>
							<hr>
								<input type="text" value="<?php echo $global_ip; ?>" class="w3-input global_ip" name="global_ip" />
								<p style="color: green;"><a id="appendIp"><?php echo __('click to append Your IP'); ?></a> | <a id="resetIp"><?php echo __('reset to default'); ?></a></p>
							</div>
						</div>
					</div>
				</div>	
				<!-- End maintenance_options -->
				<!-- Start maintenance_users -->
				<div id="maintenance_users" class="w3-container pageconf w3-hide">
					<div class="w3-justify">
						<div class="w3-row w3-section">	
							<h3><?php echo __('Users list (:$1 / :$2)',array(':$1'=>count($users_array),':$2'=>count($users))); ?></h3>
							<hr>
							<ul class="w3-ul">
								<li><input type="hidden" name="users_array[]" value="1" /></li>
								<?php foreach($users as $user): ?>
								<?php if($user->id==1): ?>
								<li><input type="checkbox" disabled="disabled" checked="checked" /> <?php echo $user->username; ?> </li>
								<?php else: ?>
								<li><input type="checkbox" id="users_array" name="users_array[]" <?php if(in_array($user->id,$users_array)): echo 'checked="checked"'; endif; ?> value='<?php echo $user->id; ?>' />
								<label for="users_array"><?php echo $user->username; ?></label> 
								</li>
								<?php endif; ?>
								<?php endforeach; ?>
							</ul>
						</div>
					</div>
				</div>
				<!-- End maintenance_users -->
				<div class="w3-container">
					<p class="buttons">
						<input class="w3-button w3-green" name="commit" type="submit" accesskey="s" value="<?php echo __('Save'); ?>" />
					</p>
				</div>
			</form>
		</div>
	</div>
<!-- End dashboard Settings -->
<script nonce="**CSP_NONCE**">
    // <![CDATA[
		document.addEventListener("DOMContentLoaded", function() {

			// Create tablinks navigation
			var maintenance_tabs = document.querySelectorAll('#maintenance-tabs .tablink');
			for (i = 0; i < maintenance_tabs.length; i++) {
				bindEvent(maintenance_tabs[i],'click', function(e){ 
					//console.log('Administration: Setings Page (Tabs) - Clicked');
					e.preventDefault();
					admin_tabs(e,this.getAttribute('data-tab'),this.getAttribute('data-option'));
				}, true);
			}

			const redirectRadio = document.getElementById('redirect_page');
			const urlInput = document.getElementById('url_page');
			const behaviorRadio = document.getElementById('behavior_page');

			// Verificar el estado del radio button en carga de página
			if (redirectRadio.checked) {
				urlInput.classList.remove("w3-hide");
			}

			redirectRadio.addEventListener('change', () => {
				urlInput.classList.remove('w3-hide');
			});

			behaviorRadio.addEventListener('change', () => {
				urlInput.classList.add('w3-hide');
			});


			var appendIp = document.getElementById("appendIp");
			if (appendIp) {
				appendIp.addEventListener("click", function(event) {
					var input = document.querySelector("input[name=global_ip]");
					input.value = input.value + ',' + '<?php echo $_SERVER['REMOTE_ADDR']; ?>';
					event.preventDefault();
				});
			}

			var resetIp = document.getElementById("resetIp");
			if (resetIp) {
				resetIp.addEventListener("click", function(event) {
					var input = document.querySelector("input[name=global_ip]");
					input.value = '0.0.0.0';
					event.preventDefault();
				});
			}

			var keygen = document.getElementById("keygen");
			if (keygen) {
				keygen.addEventListener("click", function(event) {
					var input = document.querySelector("input[name=backdoor_key]");
					input.value = passwordBK(24);
					event.preventDefault();
				});
			}

			var lblRedirectPage = document.getElementById("lbl_redirect_page");
			if (lblRedirectPage) {
				lblRedirectPage.addEventListener("click", function(event) {
					var input = document.querySelector("input[name=url_page]");
					input.focus();
					event.preventDefault();
				});
			}

			var urlPage = document.getElementById("url_page");
			if (urlPage) {
				urlPage.addEventListener("focus", function(event) {
					var radioButton = document.querySelector("input[name='redirect_page'][value='url']");
					radioButton.checked = true;
				});
			}

		});

		function passwordBK(length) {
			var password = generatePassword(length, [
				{chars: "abcdefghijklmnopqrstuvwxyz", min: 3},
				{chars: "ABCDEFGHIJKLMNOPQRSTUVWXYZ", min: 3},
				{chars: "0123456789", min: 2}
			]);
			return password;
		}

    // ]]>
</script>