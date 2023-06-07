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

	/**
	 * Root location where Comment plugin lives.
	 */
	define('COMMENT_ROOT', PATH_PUBLIC.'eteon/plugins/comment');

	Plugin::setInfos(array(
		'id'          			=> 'comment',
		'title'       			=> __('Comments'),
		'description' 			=> __('Provides interface to add page comments.'),
		'version'     			=> '1.2.1',
		'license'     			=> 'MIT',
		'author'      			=> 'AirZox Technologies (Eteon MVC)',
		'website'     			=> 'https://airzox.com/',
		'update_url'  			=> 'https://airzox.com/airzox-plugins.xml',
		'require_eteon_version'  => '0.9.4+'
	));

	// Load the Comment class into the system.
	AutoLoader::addFile('Comment', CORE_ROOT.'/plugins/comment/Comment.php');

	// Add the plugin's tab and controller
	Plugin::addController('comment', __('Comments'));

	// Observe the necessary events.
	Observer::observe('view_page_edit_plugins', 'comment_display_dropdown');
	Observer::observe('page_found', 'comment_save');
	Observer::observe('view_backend_list_plugin', 'comment_display_moderatable_count');
	Observer::observe('page_add_after_save',  'comment_on_page_saved');
	Observer::observe('page_edit_after_save', 'comment_on_page_saved');


	if (Plugin::isEnabled('statistics_api'))
	Observer::observe('stats_comment_after_add', 'StatisticsEvent::registerEvent');


	function comment_on_page_saved($page) {
		$status = Comment::NONE;
		$input = $_POST['page'];

		if (isset($input['comment_status']) && is_int((int)$input['comment_status']))
		$status = $input['comment_status'];

		Record::update('Page', array('comment_status' => $status), 'id = ?', array($page->id));
	}

	/**
	* Allows for a dropdown box with comment status on the edit page view in the backend.
	*
	* @param Page $page The object instance for the page that is being edited.
	*/
	function comment_display_dropdown(&$page) {
		echo '<p><label for="page_comment_status" class="w3-text-grey">'.__('Comments').'</label><select id="page_comment_status" name="page[comment_status]" class="w3-input w3-border w3-hover-light-gray">';
		echo '<option value="'.Comment::NONE.'"'.($page->comment_status == Comment::NONE ? ' selected="selected"': '').'>&#8212; '.__('none').' &#8212;</option>';
		echo '<option value="'.Comment::OPEN.'"'.($page->comment_status == Comment::OPEN ? ' selected="selected"': '').'>'.__('Open').'</option>';
		echo '<option value="'.Comment::CLOSED.'"'.($page->comment_status == Comment::CLOSED ? ' selected="selected"': '').'>'.__('Closed').'</option>';
		echo '</select></p>';
	}

	function comment_display_moderatable_count(&$plugin_name, &$plugin) {
		if ($plugin_name == 'comment') {
			$numlabel = Plugin::getSetting('numlabel', 'comment');

			if ($numlabel && $numlabel == '1') {
				$plugin->label = __('Comments').' <span id="comment-badge">('.comments_count_moderatable().'/'.comments_count_total().')</span>';
			}
		}
	}

	/**
	* Retrieve an array with all approved comments for a particular page.
	* 
	* @param Page $page The object instance for a particular page.
	* @return Array Returns an array of Comment objects, if any.
	*/
	function comments(&$page) {
		$comments = array();
		$comments = Comment::findApprovedByPageId($page->id);

		return $comments;
	}

	/**
	* Returns the number of approved comments for a particular page.
	*
	* @param Page $page The object instance of a particular page.
	* @return int Number of approved comments for a page.
	*/
	function comments_count(&$page) {
		return (int) count(comments($page));
	}

/**
 * Returns the number of moderatable comments.
 *
 * @return int Number of comments waiting for moderation.
 */
function comments_count_moderatable()
{
    return (int) count(Comment::find(array('where' => 'is_approved=0')));
}

/**
 * Returns the total number of comments.
 *
 * @return int Number of comments.
 */
function comments_count_total() {
    $tablename = TABLE_PREFIX.'comment';
    $pdo = Record::getConnection();
    
    $sql = "SELECT COUNT(*) AS count FROM $tablename";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $total = $stmt->fetchColumn();

    return (int) $total;
}

/**
 * Executed through the Observer system each time a page is found.
 * 
 * @global <type> $__CMS_CONN__
 * @param Page $page The object instance for the page that was found.
 * @return <type> Nothing.
 */
function comment_save(&$page)
{
    // Check if we need to save a comment
    if (!isset($_POST['comment'])) return;

    $data = $_POST['comment'];
    if (is_null($data)) return;

    $captcha = Plugin::getSetting('use_captcha', 'comment');

    if($captcha && $captcha == '1') {
        if(isset($data['secure']))
        {
            if ($data['secure'] == "" OR empty($data['secure']) OR $data['secure'] != $_SESSION['security_number']) return;
        }
        else {
            return;
        }
    }

    if ($page->comment_status != Comment::OPEN) return;

    if ( ! isset($data['author_name']) or trim($data['author_name']) == '') return;
    if ( ! isset($data['author_email']) or trim($data['author_email']) == '') return;
    if ( ! preg_match('/[^\x00-\x20()<>@,;:\\".[\]\x7f-\xff]+(?:\.[^\x00-\x20()<>@,;:\\".[\]\x7f-\xff]+)*\@[^\x00-\x20()<>@,;:\\".[\]\x7f-\xff]+(?:\.[^\x00-\x20()<>@,;:\\".[\]\x7f-\xff]+)+/i', $data['author_email'])) return;
    if ( ! isset($data['body']) or trim($data['body']) == '') return;
		
		
    use_helper('Kses');

    $allowed_tags = array(
        'a' => array(
            'href' => array(),
            'title' => array()
        ),
        'abbr' => array(
            'title' => array()
        ),
        'acronym' => array(
            'title' => array()
        ),
        'b' => array(),
        'blockquote' => array(
            'cite' => array()
        ),
        'br' => array(),
        'code' => array(),
        'em' => array(),
        'i' => array(),
        'p' => array(),
        'strike' => array(),
        'strong' => array()
    );

    $auto_approve_comment = Plugin::getSetting('auto_approve_comment', 'comment');

    // Check for and correct problems with website link
    if (isset($data['author_link']) && $data['author_link'] !== '') {
        if (strpos($data['author_link'], 'http://') !== 0 && strpos($data['author_link'], 'https://') !== 0) {
            $data['author_link'] = 'http://'.$data['author_link'];
        }
    }

    global $__CMS_CONN__;
		
    $sql = 'INSERT INTO '.TABLE_PREFIX.'comment (page_id, author_name, author_email, author_link, ip, body, is_approved, created_on) VALUES ('.
           '\''.$page->id.'\', '.
           $__CMS_CONN__->quote(strip_tags($data['author_name'])).', '.
           $__CMS_CONN__->quote(strip_tags($data['author_email'])).', '.
           $__CMS_CONN__->quote(strip_tags($data['author_link'])).', '.
           $__CMS_CONN__->quote($data['author_ip']).', '.
           $__CMS_CONN__->quote(kses($data['body'], $allowed_tags)).', '.
           $__CMS_CONN__->quote($auto_approve_comment).', '.
           $__CMS_CONN__->quote(date('Y-m-d H:i:s')).')';

    $__CMS_CONN__->exec($sql);

    // @todo FIXME - If code above used Comment object for saving data there would be
    // no need to reload it from database. Using lastInsertId() is unrealiable anyway.
    $comment_id = Record::lastInsertId();
    $comment    = Comment::findById($comment_id);
    Observer::notify('comment_after_add', $comment);

    if (Plugin::isEnabled('statistics_api'))
    {
        $event = array('event_type'  => 'comment_added',            // simple event type identifier
                       'description' => __('A comment was added.'), // translatable description
                       'ipaddress'   => $comment->ip,
                       'username'    => $comment->author_name);
        Observer::notify('stats_comment_after_add', $event);
    }
}
	
/**
 * Displays a captcha when required by the settings.
 * 
 * @return none Nothing.
 */
function captcha()
{
    // Initialize proper defaults
    $data = null;
    $captcha = 1;
    $approve = 0;

    // Check if comment is available
    if (isset($_POST['comment'])) {
        $data = $_POST['comment'];
        if (is_null($data)) return;
    }

    // Get settings
    $captcha = Plugin::getSetting('use_captcha', 'comment');
    $approve = Plugin::getSetting('auto_approve_comment', 'comment');

    // Display captcha if required
    if ($captcha && $captcha == '1') {
        if($data && ($data['secure'] != $_SESSION['security_number'] && !empty($data['secure'])) ) {
            echo '<p class="comment-captcha-error">'.__('Incorrect result value. Please try again:').'</p>';
        }
        else {
            echo '<p>'.__('Please insert the result of the arithmetical operation from the following image:').'</p>';
        }

        echo '<img id="comment-captcha" src="/eteon/plugins/comment/image.php" alt="'.__('Please insert the result of the arithmetical operation from this image.').'" />';
        echo ' = <input id="comment-captcha-answer" class="css-input css-border" type="text" name="comment[secure]" />';
    }

    // Add a field with user's IP address.
    $ip = isset($_SERVER['HTTP_X_FORWARDED_FOR']) ? $_SERVER['HTTP_X_FORWARDED_FOR']:($_SERVER['REMOTE_ADDR']);
    echo '<input type="hidden" value="'.$ip.'" name="comment[author_ip]" />';
	
	// Display results
    if (isset($_POST['commit-comment'])) {
        if (($captcha && $captcha != '1') || $data['secure'] == $_SESSION['security_number']) {
            if($approve && $approve == '1') {
                echo '<p class="comment-captcha-success">'.__('Thank you for your comment. It has been added.').'</p>';
            }
            else {
                echo '<p class="comment-captcha-success">'.__('Thank you for your comment. It is waiting for approval.').'</p>';
            }
        }
    }
}
