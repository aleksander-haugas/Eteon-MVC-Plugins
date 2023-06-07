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
			<i class="fa fa-hdd-o"></i> <?php echo __('Smart Cache'); ?>
		</strong>
	</h5>
</header>
<!-- Termina Header -->
<div  class="w3-col l8 s12">
	<div class="w3-margin">
		<div class="w3-responsive">
			<form action="<?php echo get_url('plugin/smart_cache/clear'); ?>" method="post">
				<table id="users" class="w3-table-all w3-hoverable w3-theme-light">
					<thead>
						<tr class="w3-theme">
							<th><?php echo __('Cached pages'); ?></th>
							<th><?php echo __('Created date'); ?></th>
							<th><?php echo __('Modify'); ?></th>
						</tr>
					</thead>
						<?php foreach ($pages as $page): ?>
						<tr>
							<td class="field"><?php print $page->publicUrl() ?></td>
							<td class="field"><?php print DateDifference::getString(new DateTime($page->created_on)); ?></td>
							<td class="field w3-right w3-padding">
								<a href="<?php echo get_url('plugin/smart_cache/delete/').$page->id; ?>">
									<i class="fa fa-trash w3-text-red" title="Delete this cached page."></i>
								</a>
							</td>
						</tr>
						<?php endforeach; ?>
				</table>
				<p>
					<input class="w3-button w3-green" name="commit" type="submit" accesskey="c" value="<?php echo __('Clear all'); ?>">
				</p>
			</form>
		</div>
	</div>
</div>
