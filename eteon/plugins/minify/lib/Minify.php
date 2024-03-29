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

class Minify
{
    /**
     *  @var string
     *  @access private
     */
    private $type;
    
    /**
     *  @var string
     *  @access private
     */
    private $cache;
    
    /**
     *  Factory method
     *
     *  @param string JS|CSS
     *  @return Minify
     */
    public static function factory($type)
    {
        $type = strtoupper($type);
        return new Minify($type);
    }
    
    /**
     *  Constructor
     *  @param string JS|CSS
     */
    public function __construct($type)
    {
        $type = strtoupper($type);
        $this->type = $type;
    }
    
    /**
     *  Loops through array files and minifies them.
     *
     *  @param array Files array
     *  @param boolean Output to file?
     *
     *  @return string
     */
    public function minify($files, $output = false, $fileName = '')
    {
        $globDir = $_SERVER['DOCUMENT_ROOT'] . '/cache/';
        $min = '';
        if( ! $fileName && $this->type == 'CSS') {
            $fileName = 'min.css';
        }
        if( ! $fileName && $this->type == 'JS') {
            $fileName = 'min.js';
        }
        
        foreach( $files as $file) {
            if( ! is_file($file)) {
                throw new MinifyException("File $file - not found");
            }
            $rawString = file_get_contents($file);
            if($this->type == 'JS') {
                $min .= sprintf("\n/*MD5:%s*/\n", md5($rawString));
                $min .= JSMin::minify($rawString);
            } elseif ($this->type == 'CSS') {
               $min .= sprintf("\n/*MD5:%s*/\n", md5($rawString));
               $min .= CSSMin::minify($rawString);
            } else {
               throw new MinifyException('Unknown minify type, use '
                                        .'"CSS" or "JS"');
            }
        }
                
        if( !$output) {
           $retval = $min;
        } else {
          file_put_contents($globDir . $fileName, $min);
          $retval = '/cache/' . $fileName;
        }
        
        return $retval;
    }
    
}
/**
 *  Minify exception
 */
class MinifyException extends Exception {}