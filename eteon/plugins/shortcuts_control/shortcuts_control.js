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

/*
    En este código, se agregan los siguientes comportamientos:

    Control+S: envía el formulario con el botón "continue".
    Control+E: envía el formulario con el botón "edit".
    Control+Q: redirige a la URL de cancelación.

    Todo: agregar fullscreen control, acceso directo a paginas, acceso directo a snippets, acceso directo a configuracion,
*/
document.addEventListener('keydown', e => {
    var x = e.key;
    if (!(e.ctrlKey && !e.altKey)) return true;

    if (e.ctrlKey && (x === 's' || x === 'S')) {
        // Prevent the Save dialog to open
        e.preventDefault();
        // find submit button with name == "commit" and trigger click event to submit the form
        var saveAndCloseBtn = document.querySelector('#content input[name|="commit"]');
        if (saveAndCloseBtn) {
            saveAndCloseBtn.click();
            return false;
        }
    }
    
    if (e.ctrlKey && (x === 'e' || x === 'E')) {
        // Prevent the Save dialog to open
        e.preventDefault();
        // find submit button with name == "continue" and trigger click event to submit the form
        var saveAndEditBtn = document.querySelector('#content input[name|="continue"]');
        if (saveAndEditBtn) {
            saveAndEditBtn.click();
            return false;
        }
    }
    
    if (e.ctrlKey && (x === 'q' || x === 'Q')) {
        // Prevent the Cancel link from being followed
        e.preventDefault();
        // go to the Cancel link href
        var cancelLink = document.querySelector('#content .buttons a[href]');
        if (cancelLink) {
            window.location.href = cancelLink.href;
            return false;
        }
    }
});

  