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

    class CSSMin {
        /**
         *  Minifies CSS
         *
         *  @param string CSS input
         *  @return string
         */
        public static function minify($css) {
            // Compress whitespace.
            $css = preg_replace('/\s+/', ' ', $css);
        
            // Remove comments.
            $css = preg_replace('/\/\*.*?\*\//', '', $css);
        
            return trim($css);
        }
        
        /**
         *  Rewrites CSS paths (eg. for images). Syntax is identival to native PHP
         *  function preg_replace.
         *
         *  @param string Pattern /regexp/
         *  @param string Replacement /regexp/
         *  @param string CSS input
         */
        public static function cssPathsRewrite($pattern, $replacement, $css) {
            return preg_replace($pattern, $replacement, $css);
        }
    }