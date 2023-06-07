var simplemde = {};
function addCssa(css){
    const style = document.createElement('link');
    style.rel = 'stylesheet';
    style.type  = "text/css";
    style.href  = '/eteon/plugins/simplemde/simplemde/dist/'+css;
    document.getElementsByTagName('head')[0].appendChild(style);
}

document.addEventListener("DOMContentLoaded", function(){
    addCssa("simplemde.min.css");

    // If suneditor is selected, add it.
    document.querySelectorAll('.filter-selector').forEach(function(el) {
        el.addEventListener('eteonSwitchFilterIn', function(ev) {
            if (ev.detail[0] === "simplemde") {
                let textarea = document.getElementById(ev.detail[1].getAttribute("id"));
                simplemde[ev.detail[1]] = new SimpleMDE({ element: textarea });
            }
        });

        // If suneditor is not selected, remove it.
        el.addEventListener('eteonSwitchFilterOut', function(ev) {
            if (ev.detail[0] === "simplemde") {
                simplemde[ev.detail[1]].toTextArea();
                ev.detail[1].style.display = 'block';
            }
        });
    });

    if (document.getElementById("file_manager-plugin")){
        let cm_url = document.querySelector("#file_manager-plugin a").getAttribute("href");
        let cm_idx = cm_url.indexOf("file_manager");
        cm_url = cm_url.substr(0, cm_idx) + "codemirror/cm_integrate";
        let xhttp = new XMLHttpRequest();
        xhttp.open("GET", cm_url, true);
        xhttp.onreadystatechange = function() {
            if (xhttp.readyState === 4 && xhttp.status === 200) {
                if (xhttp.responseText === "1") {
                    setCM("file_content");
                    //setSwitcher(document.getElementById("file_content"),'file_content');
                }
            }
        };
        xhttp.send();
    }

});