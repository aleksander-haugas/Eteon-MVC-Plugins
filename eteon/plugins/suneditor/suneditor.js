var suneditor = {};
function addCsss(css){
    const style = document.createElement('link');
    style.rel = 'stylesheet';
    style.type  = "text/css";
    style.href  = '/eteon/plugins/suneditor/suneditor/dist/css/'+css;
    document.getElementsByTagName('head')[0].appendChild(style);
}

document.addEventListener("DOMContentLoaded", function(){
    addCsss("suneditor.min.css");

    // If suneditor is selected, add it.
    document.querySelectorAll('.filter-selector').forEach(function(el) {
        el.addEventListener('eteonSwitchFilterIn', function(ev) {
            if (ev.detail[0] === "suneditor") {
                let textareaCM = document.getElementById(ev.detail[1].getAttribute("id"));
                suneditor[ev.detail[1]] = SUNEDITOR.create(textareaCM, {
                    templates: [
                        {
                            name: 'Template-1',
                            html: '<p>HTML source1</p>'
                        },
                        {
                            name: 'Template-2',
                            html: '<p>HTML source2</p>'
                        }
                    ],
                    //codeMirror: CodeMirror,
                    //katex: katex,
                    charCounter : true,
                    resizeEnable : true,
                    width : '100%',
                    buttonList: [
                        // default
                        ['undo', 'redo'],
                        [':p-More Paragraph-default.more_paragraph', 'font', 'fontSize', 'formatBlock', 'paragraphStyle', 'blockquote'],
                        ['bold', 'underline', 'italic', 'strike', 'subscript', 'superscript'],
                        ['fontColor', 'hiliteColor', 'textStyle'],
                        ['removeFormat'],
                        ['outdent', 'indent'],
                        ['align', 'horizontalRule', 'list', 'lineHeight'],
                        ['-right', ':i-More Misc-default.more_vertical', 'fullScreen', 'showBlocks', 'codeView', 'preview', 'print', 'save', 'template'],
                        ['-right', ':r-More Rich-default.more_plus', 'table', 'imageGallery'],
                        ['-right', 'image', 'video', 'audio', 'link'],
                        // (min-width: 992)
                        ['%992', [
                            ['undo', 'redo'],
                            [':p-More Paragraph-default.more_paragraph', 'font', 'fontSize', 'formatBlock', 'paragraphStyle', 'blockquote'],
                            ['bold', 'underline', 'italic', 'strike'],
                            [':t-More Text-default.more_text', 'subscript', 'superscript', 'fontColor', 'hiliteColor', 'textStyle'],
                            ['removeFormat'],
                            ['outdent', 'indent'],
                            ['align', 'horizontalRule', 'list', 'lineHeight'],
                            ['-right', ':i-More Misc-default.more_vertical', 'fullScreen', 'showBlocks', 'codeView', 'preview', 'print', 'save', 'template'],
                            ['-right', ':r-More Rich-default.more_plus', 'table', 'link', 'image', 'video', 'audio', 'math', 'imageGallery']
                        ]],
                        // (min-width: 767)
                        ['%767', [
                            ['undo', 'redo'],
                            [':p-More Paragraph-default.more_paragraph', 'font', 'fontSize', 'formatBlock', 'paragraphStyle', 'blockquote'],
                            [':t-More Text-default.more_text', 'bold', 'underline', 'italic', 'strike', 'subscript', 'superscript', 'fontColor', 'hiliteColor', 'textStyle'],
                            ['removeFormat'],
                            ['outdent', 'indent'],
                            [':e-More Line-default.more_horizontal', 'align', 'horizontalRule', 'list', 'lineHeight'],
                            [':r-More Rich-default.more_plus', 'table', 'link', 'image', 'video', 'audio', 'math', 'imageGallery'],
                            ['-right', ':i-More Misc-default.more_vertical', 'fullScreen', 'showBlocks', 'codeView', 'preview', 'print', 'save', 'template']
                        ]],
                        // (min-width: 480)
                        ['%480', [
                            ['undo', 'redo'],
                            [':p-More Paragraph-default.more_paragraph', 'font', 'fontSize', 'formatBlock', 'paragraphStyle', 'blockquote'],
                            [':t-More Text-default.more_text', 'bold', 'underline', 'italic', 'strike', 'subscript', 'superscript', 'fontColor', 'hiliteColor', 'textStyle', 'removeFormat'],
                            [':e-More Line-default.more_horizontal', 'outdent', 'indent', 'align', 'horizontalRule', 'list', 'lineHeight'],
                            [':r-More Rich-default.more_plus', 'table', 'link', 'image', 'video', 'audio', 'math', 'imageGallery'],
                            ['-right', ':i-More Misc-default.more_vertical', 'fullScreen', 'showBlocks', 'codeView', 'preview', 'print', 'save', 'template']
                        ]]
                    ]
                });
            }
        });

        // If suneditor is not selected, remove it.
        el.addEventListener('eteonSwitchFilterOut', function(ev) {
            if (ev.detail[0] === "suneditor") {
                suneditor[ev.detail[1]].destroy();
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