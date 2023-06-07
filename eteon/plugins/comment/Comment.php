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

/**
 * The Comment class represents a comment on a page.
 */
class Comment extends Record
{
    const TABLE_NAME = 'comment';
    const NONE = 0;
    const OPEN = 1;
    const CLOSED = 2;

    /**
     * Find Comments limited to 10.
     * 
     * @param mixed $args Unused.
     * @return Array An array of Comment objects.
     */
    public static function findAll($args = null) {
        return self::find(array(
            'limit' => 10
        ));
    }

    /**
     * Find all comments in approved status.
     *
     * @return Array An array of Comment objects.
     */
    public static function findApproved() {
        return self::find(array(
            'where' => 'is_approved = 1'
        ));
    }

    /**
     * Allows user to find all comments in approved status belonging to a page.
     * 
     * @param int $id Page id.
     * @return Array An array of Comment objects.
     */
    public static function findApprovedByPageId($id) {
        return self::find(array(
            'where' => 'is_approved = 1 AND page_id = ?',
            'values' => array((int) $id)
        ));
    }


    function name($class='')
    {
        if ($this->author_link != '')
        {
            if ($class != '') {
                $fullclass = 'class="'.$class.'" ';
            } else {
                $fullclass = '';
            };

            return sprintf(
                '<a %s href="%s" title="%s">%s</a>',
                $fullclass,
                $this->author_link,
                $this->author_name,
                $this->author_name
            );
        }
            else return $this->author_name;
    }

    function email() { return $this->author_email; }
    function link() { return $this->author_link; }
    function body() { return $this->body; }

    function date($format='%a, %e %b %Y')
    {
        return strftime($format, strtotime($this->created_on));
    }

    /**
     * Produces a valid gravatar url for the comment's author.
     *
     * @param <type> $size
     */
    function gravatar($size = '80') {
        $default = URL_PUBLIC.'public/images/gravatar.png';
        $grav_url = 'http://www.gravatar.com/avatar.php?gravatar_id='.md5($this->author_email).'&amp;default='.urlencode($default).'&amp;size='.$size;
        echo $grav_url;
    }


} // end Comment class
