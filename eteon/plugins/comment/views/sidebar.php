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
<!-- Start sidebar comments -->
<div class="w3-col l4">		
	<div class="w3-theme-d1 w3-margin">
		<ul class="w3-card w3-ul w3-hoverable"> 
			<li class="w3-padding-16 zoom w3-hover-theme">
				<i class="fa fa-comments w3-xlarge w3-left w3-margin-right" alt="comments icon"></i>
				<span class="w3-large"><a href="<?php echo get_url('plugin/comment/'); ?>"> <?php echo __('Comments'); ?></a></span>
			</li>
			<li class="w3-padding-16 zoom w3-hover-theme">
				<i class="fa fa-gavel w3-xlarge w3-left w3-margin-right" alt="comments moderation icon"></i>
				<span class="w3-large"><a href="<?php echo get_url('plugin/comment/moderation/'); ?>"> <?php echo __('Moderation'); ?></a></span>
			</li>
			<li class="w3-padding-16 zoom w3-hover-theme">
				<i class="fa fa-gear w3-xlarge w3-left w3-margin-right" alt="comments settings icon"></i>
				<span class="w3-large"><a href="<?php echo get_url('plugin/comment/settings'); ?>"> <?php echo __('Settings'); ?></a></span>
			</li>
			<li class="w3-padding-16 zoom w3-hover-theme">
				<i class="fa fa-book w3-xlarge w3-left w3-margin-right" alt="comments documentation icon"></i>
				<span class="w3-large"><a href="<?php echo get_url('plugin/comment/documentation/'); ?>"> <?php echo __('Documentation'); ?></a></span>

			</li>
		</ul>
	</div>
</div>
<!-- End sidebar comments -->
