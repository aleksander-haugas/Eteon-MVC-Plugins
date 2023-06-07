const cmEditor = {};
let cmOption = {
    lineNumbers: true,
    lineWrapping: true,
    autoCloseTags: true,
    readOnly: false,
    indentUnit: 4,
    styleActiveLine: true,
    styleActiveSelected: true,
    extraKeys: {"Ctrl-Space": "autocomplete"},
    viewportMargin: Infinity,
    gutters: ["CodeMirror-lint-markers"],
    lint: true
};

const modeParsers = {
    "css": {mode: "css"},
    "javascript": {mode: "javascript", globalVars: true},
    "xml": {mode: {name: "xml", alignCDATA: true}},
    "htmlmixed": {mode: "application/x-httpd-php", tabMode: "indent"},
    "php": {mode: "text/x-php", matchBrackets: true, indentWithTabs: true, globalVars: true},
    "markdown": {mode: 'markdown', matchBrackets: true}
};

const cmThemes = [
    'default', '3024-day', '3024-night', 'abbott', 'abcdef', 'ambiance', 'ayu-dark', 'ayu-mirage', 'base16-dark',
    'base16-light', 'bespin', 'blackboard', 'cobalt', 'colorforth', 'darcula', 'dracula', 'duotone-dark', 'duotone-light', 'eclipse', 'elegant', 'erlang-dark',
    'gruvbox-dark', 'hopscotch', 'icecoder', 'idea', 'isotope', 'juejin', 'lesser-dark', 'liquibyte', 'lucario', 'material', 'material-darker',
    'material-palenight', 'material-ocean', 'mbo', 'mdn-like', 'midnight', 'monokai', 'moxer', 'neat', 'neo', 'night', 'nord', 'oceanic-next', 'panda-syntax',
    'paraiso-dark', 'paraiso-light', 'pastel-on-dark', 'railscasts', 'rubyblue', 'seti', 'shadowfox', 'solarized dark', 'solarized light', 'the-matrix',
    'tomorrow-night-bright', 'tomorrow-night-eighties', 'ttcn', 'twilight', 'vibrant-ink', 'xq-dark', 'xq-light', 'yeti', 'yonce', 'zenburn'
];

function setCM(el, modeParser){
    if (typeof cmEditor[el] !== 'undefined') return false; 

    if (modeParser != null && modeParsers[modeParser]) {
        cmOption = Object.assign(cmOption, modeParsers[modeParser]);
    }

    cmEditor[el] = CodeMirror.fromTextArea(document.getElementById(el), cmOption);
    cmEditor[el].setSize("100%", "100%");
    cmTheme(el,'3024-day');
}

// Set custom theme for the editor
function cmTheme(el, cmTheme){
    cmEditor[el].setOption("theme", cmTheme);
    location.hash = "#" + cmTheme;

    cssCM('theme',cmTheme);
}

function resetCM(el,stay){
    if (typeof cmEditor[el] !== 'undefined'){
        cmEditor[el].toTextArea();
        delete cmEditor[el];
        
        // switcher
        if (stay != null) return false;
        const cmSwitch = "codemirror-" + el;
        console.log(cmSwitch);
        //document.querySelector("label[for="+cmSwitch+"]").remove();
        //document.getElementById(cmSwitch).remove();
    }
}

function createSelectWithArrayValues(selectId, optionsArray) {
    var cmSwitchLang = 'codemirror-' + selectId;
    if(!document.getElementById(cmSwitchLang)){
        var select = document.createElement('select');
        select.id = cmSwitchLang;

        optionsArray.forEach(function(optionValue) {
            var option = document.createElement('option');
            option.value = optionValue;
            option.text = optionValue;
            select.appendChild(option);
        });

        document.body.appendChild(select);
    }
}

function setSwitcher(target, id) {
  if (!target || !(target instanceof HTMLElement)) {
    console.error("Invalid target element");
    return false;
  }

  var cmSwitch = 'codemirror-' + id;
  
  if (document.getElementById(cmSwitch)) return false;

  // create wrapper p element
    const wrapper = document.createElement("p");
    wrapper.classList.add("w3-half");

  // create label element
    const label = document.createElement("label");
    label.setAttribute("for", cmSwitch);
  label.setAttribute("class", "w3-text-grey");
  label.innerHTML = "Highlight";

  // create select element
    const select = document.createElement("select");
    select.setAttribute("id", cmSwitch);
  select.setAttribute("class", "filter-selector w3-input w3-border w3-hover-light-gray");
  select.innerHTML = `
    <option value="javascript">Javascript</option>
    <option value="xml">XML</option>
    <option value="css">CSS</option>
    <option value="htmlmixed" selected="selected">Mixed-mode HTML</option>
    <option value="php">PHP</option>
    <option value="markdown">Markdown</option>
  `;

  // append label and select to wrapper
  wrapper.appendChild(label);
  wrapper.appendChild(select);

  if (id === "file_content") {
    target.parentNode.insertBefore(wrapper, target);
  } else {
	target.parentNode.classList.add("w3-half");
    target.parentNode.parentNode.appendChild(wrapper);
  }

  select.addEventListener("change", function() {
    resetCM(id, true);
    setCM(id, select.value);
  });
}

function cssCM(directory,name){
    const style = document.createElement('link');
    style.rel = 'stylesheet';
    style.type  = "text/css";
    style.href  = '/eteon/plugins/codemirror/codemirror/'+directory+'/'+name+'.css';
    document.getElementsByTagName('head')[0].appendChild(style);
}

document.addEventListener("DOMContentLoaded", function(){
    cssCM('lib','codemirror');
    cssCM('addon/hint','show-hint');
    cssCM('addon/lint','lint');

    if (document.getElementById("layout_content")){
        resetCM("layout_content", true);
        setCM("layout_content","htmlmixed");
    }

	// If codemirror is selected, add it.
	document.querySelectorAll('.filter-selector').forEach(function(el) {
		el.addEventListener('eteonSwitchFilterIn', function(ev) {
			if (ev.detail[0] === "codemirror") {
				setCM(ev.detail[1].getAttribute("id"), "htmlmixed");
				//setSwitcher(this, ev.detail[1].getAttribute("id"));
                console.log(this);
                createSelectWithArrayValues(ev.detail[1].getAttribute("id"),['javascript','htmlmixed','css','xml']);
			}
		});
	
		// If codemirror is not selected, remove it.
		el.addEventListener('eteonSwitchFilterOut', function(ev) {
			if (ev.detail[0] === "codemirror") {
				resetCM(ev.detail[1].getAttribute("id"));
			}
		});
	});
});