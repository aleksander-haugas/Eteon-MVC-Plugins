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

document.querySelector(document).keydown(function(event) {
    if (!( String.fromCharCode(event.which).toLowerCase() == 's' && event.ctrlKey && !event.altKey) && !(event.which == 19)) return true;
    //alert("Ctrl-s pressed");
    //find submit button with name == "continue" and travel upwards DOM to find parent form and sumbit it
    if (document.querySelector('#content').querySelector('input[name|="continue"]').parents('form').submit()) {
    event.preventDefault(); return false;
    }
});