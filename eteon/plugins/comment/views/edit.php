<?php
	/*
		Version: 		0.9.4
		WebSite: 		http://eteon.airzox.com
		Licensed:		AirZox Technologies
		License-key:	KJXS-NMAL-004D-V15A
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
	<h5><strong><i class="fa fa-comments"></i> <?php echo __('Comments Plugin'); ?> | <?php echo __('Edit comment by'); ?> <?php echo $comment->author_name; ?></strong></h5>
</header>
<!-- Termina Header -->
<div class="w3-col l8 s12">
	<div class="w3-margin">
		<div class="w3-justify">
      <div class="w3-row w3-theme-light w3-padding">
        <form action="<?php echo get_url('plugin/comment/edit/'.$comment->id); ?>" method="post">
            <p class="content">
              <label for="comment_body" class="w3-text-gray"><?php echo __('Body'); ?></label>
              <textarea cols="40" id="comment_body" name="comment[body]" rows="20" style="width: 100%"><?php echo htmlentities($comment->body, ENT_COMPAT, 'UTF-8'); ?></textarea>
            </p>
          <p class="buttons">
            <input class="w3-button w3-green" name="commit" type="submit" accesskey="s" value="<?php echo __('Save'); ?>" />
            <?php echo __('or'); ?> <a href="<?php echo get_url('plugin/comment'); ?>"><?php echo __('Cancel'); ?></a>
          </p>
        </form>
      </div>
    </div>
  </div>
</div>
