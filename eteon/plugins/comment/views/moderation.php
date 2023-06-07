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

	global $__CMS_CONN__;
	$sql = "SELECT COUNT(*) FROM ".TABLE_PREFIX."comment WHERE is_approved = 0";
	$stmt = $__CMS_CONN__->query($sql);
	$comments_count = $stmt->fetchColumn();
	$stmt->closeCursor();

	// Check for comments per page (pagination)
	if (isset($page)) { $CurPage = $page; } else { $CurPage = 0; }

	$rowspage = Plugin::getSetting('rowspage', 'comment');
	$start = $CurPage * $rowspage;

	$totalrecords = $comments_count;
	$sql = "SELECT comment.is_approved, comment.id, comment.page_id, comment.author_name, comment.author_link, comment.author_email, comment.ip, comment.body, comment.created_on, page.title FROM " .
	    TABLE_PREFIX . "comment AS comment, " . TABLE_PREFIX .
	    "page AS page WHERE comment.is_approved = 0 AND comment.page_id = page.id ORDER BY comment.created_on DESC LIMIT ".$rowspage." OFFSET ".$start;

	$stmt = $__CMS_CONN__->prepare($sql);
	$stmt->execute();
	$lastpage = ceil($totalrecords / $rowspage);
	if($comments_count <= $rowspage) { $lastpage = 0; } else { $lastpage = abs($lastpage - 1); }
?>

<!-- Empieza Header -->
<header class="w3-container" style="padding-top:22px">
	<h5>
		<strong>
			<i class="fa fa-gavel"></i> <?php echo __('Comments Plugin'); ?> | <?php echo __('Moderation'); ?>
		</strong>
	</h5>
</header>
<div class="w3-col l8 s12">
	<div class="w3-margin">
		<div class="w3-justify">
			<?php if ($comments_count > 0){ ?>
				<?php while ($comment = $stmt->fetchObject()){ ?>
					<div class="<?php echo odd_even(); ?> moderate w3-card w3-margin-top">
						<div class="w3-theme w3-bar user">
							<div class="w3-block w3-left-align w3-bar-item w3-left">
								<i class="fa fa-at"></i><?php echo $comment->author_name; ?>
							</div>
							<div onclick="admin_accordeon('user_comment_details_<?php echo $comment->id; ?>')" class="w3-btn w3-gray w3-block w3-left-align w3-bar-item w3-right">
								<i class="fa fa-vcard"></i>
							</div>
						</div>

						<div id="user_comment_details_<?php echo $comment->id; ?>" class="w3-hide">
							<div class="w3-container w3-theme-l1 email">
								<i class="fa fa-envelope"></i> <?php if ($comment->author_email != '') { echo '('.$comment->author_email.')'; } ?>
							</div>
							<div class="w3-container w3-padding w3-theme-l1 link">
								<i class="fa fa-chain"></i> <?php if ($comment->author_link != '') { echo '<a href="'.$comment->author_link.'" title="'.$comment->author_name.'" style="text-decoration: none;">'.$comment->author_link.'</a>'; } ?>
							</div>
							<div class="w3-container w3-theme-l1 ip">
								<i class="fa fa-globe"></i> <?php echo __('ip'); ?> <strong><?php echo $comment->ip; ?></strong>
							</div>
							<div class="w3-container w3-padding w3-light-gray title">
								<i class="fa fa-bookmark"></i> <?php echo __('about'); ?> <strong><?php echo $comment->title; ?></strong>
							</div>
						</div>

						<div class="w3-container w3-theme-light body">
							<p><?php echo $comment->body; ?></p>
						</div>

						<div class="w3-row w3-theme-l4 infos">
							<div class="w3-container">
								<p class="w3-left"><i class="fa fa-calendar"></i> <?php echo date('D, j M Y', strtotime($comment->created_on)); ?></p>
								<p class="w3-right">
									<a href="<?php echo get_url('plugin/comment/edit/' . $comment->id); ?>" class="w3-tag w3-blue" style="text-decoration: none;"><?php echo __('Edit'); ?></a> 
									<a href="<?php echo get_url('plugin/comment/delete/' . $comment->id); ?>" onclick="return confirm('<?php echo __('Are you sure you wish to delete it?'); ?>');" class="w3-tag w3-red" style="text-decoration: none;"><?php echo __('Delete'); ?></a> 
									<?php if ($comment->is_approved){ ?>
									<a href="<?php echo get_url('plugin/comment/unapprove/' . $comment->id); ?>" class="w3-tag w3-orange" style="text-decoration: none;"><?php echo __('Reject'); ?></a>
									<?php } else { ?>
									<a href="<?php echo get_url('plugin/comment/approve/' . $comment->id); ?>" class="w3-tag w3-green" style="text-decoration: none;"><?php echo __('Approve'); ?></a>
									<?php } ?>
								</p>
							</div>
						</div>
					</div>				
				<?php } } else { ?>
				<div class="w3-row w3-section w3-pale-green w3-padding">
					<h3><i class="fa fa-thumbs-o-up"></i> <?php echo __('No comments found for moderation.'); ?></h3>
				</div>
			<?php } ?>
		</div>
        <!-- Start comments paginator -->
        <div class="w3-border w3-theme-light w3-margin-top">
            <?php
                // First page button
                if ($CurPage != 0) { echo "<a href=" . get_url('plugin/comment/moderation/') . "0 class=\"w3-left w3-button w3-border-right\">&#10094;&#10094;</a>\n ";
                } else {
                    echo "<span class=\"w3-button w3-left w3-border-right disabled\">&#10094;&#10094;</span>";
                }
                // Previous page button
                if ($CurPage == 0) { $prev = '<span class="w3-button w3-left disabled">&#10094; Previous Page</span>';
                } else {
                    $prevpage = $CurPage - 1;
                    $prev = '<a href="' . get_url('plugin/comment/moderation/') . '' . $prevpage . '" class="w3-button w3-left">&#10094; Previous Page</a>';
                }
                // Next page button
                if ($CurPage == $lastpage) { $next = '<span class="w3-button w3-right disabled">Next Page &#10095;</span>';
                } else {
                    $nextpage = $CurPage + 1;
                    $next = '<a href="' . get_url('plugin/comment/moderation/') . '' . $nextpage . '" class="w3-button w3-right">Next Page &#10095;</a>';

                }
                // Last page button
                if ($CurPage != $lastpage) { echo "\n<a href=" . get_url('plugin/comment/moderation/') . "$lastpage class=\"w3-button w3-right w3-border-left\">&#10095;&#10095;</a>";
                } else {
                    echo "<span class=\"w3-button w3-border-left w3-right disabled\">&#10095;&#10095;</span>";
                }
                echo $prev;
                echo $next;
                echo '<div class="w3-center">';
                // Current pagination number buttons
                for ($i = 0; $i <= $lastpage; $i++) {
                    $j = $i + 1;
                    if ($i == $CurPage) {
                        echo '<span class="w3-button w3-light-gray">'.$j.'</span>';
                    } else {
                        echo " <a href=" . get_url('plugin/comment/moderation/') . "$i class=\"w3-button\">$j</a>\n";
                    }
                }
                echo '</div>';
            ?>
        </div>
        <!-- End comments paginator -->
	</div>
</div>
