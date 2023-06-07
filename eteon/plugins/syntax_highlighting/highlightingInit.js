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
document.addEventListener('DOMContentLoaded', (event) => {
    let highlight_elements = document.querySelector('.hljs');
    if (highlight_elements !== null) {

        // Load syntax highlighting css styles
        var cssId = 'myCss';  // you could encode the css path itself to generate id..
        if (!document.getElementById(cssId)) {
            var head  = document.getElementsByTagName('head')[0];
            var link  = document.createElement('link');
            link.id   = cssId;
            link.rel  = 'stylesheet';
            link.type = 'text/css';
            link.href = '/eteon/plugins/syntax_highlighting/styles/base16/zenburn.min.css';
            link.media = 'all';
            head.appendChild(link);
        }

        // Load syntax highlighting js
        document.querySelectorAll('pre code').forEach((block) => {
            hljs.highlightBlock(block);
        });

        // Add copy badge
        var options = {
            // CSS class(es) used to render the copy icon.
            copyIconClass: "fa fa-copy",  
            copyIconContent: "",
            
            // CSS class(es) used to render the done icon.
            checkIconClass: "fa fa-check",
            checkIconContent: "",

            // function called before code is placed on clipboard that allows you inspect and modify
            // the text that goes onto the clipboard. Passes text and code root element (hljs).
            // Example:  function(text, codeElement) { return text + " $$$"; }
            onBeforeCodeCopied: null
        };
        window.highlightJsBadge(options);

        //hljs.initLineNumbersOnLoad({
        //    singleLine: true
        //});
    }
});