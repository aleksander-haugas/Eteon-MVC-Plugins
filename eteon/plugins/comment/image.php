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
	// Start captcha

	session_start();
	$operators		= array('+','-','*');
	$first_num		= rand(1,5);
	$second_num		= rand(6,11);

	shuffle($operators);
	$expression		=$second_num.$operators[0].$first_num;

	eval("\$session_var=".$second_num.$operators[0].$first_num.";");
	$_SESSION['security_number']=$session_var;
	
	$img			= imagecreatefromjpeg("test.jpg");
	$text_color		= imagecolorallocate($img,255,255,255);	
	$background_color	= imagecolorallocate($img,255,255,255);
	
	imagefill($img,0,150,$background_color);
	imagettftext($img,rand(25,30),rand(-10,10),rand(10,30),rand(25,35),$background_color,"fonts/Maytra.ttf",$expression);

	header("Content-type:image/jpeg");
	header("Content-Disposition:inline ; filename=secure.jpg");
	imagejpeg($img);
?>
