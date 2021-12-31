import openImport from './openImport';
import CodeEditor from './codeEditor';

import {
  cmdImport,
  cmdDeviceDesktop,
  cmdDeviceTablet,
  cmdDeviceMobile,
  cmdClear
} from './../consts';

export default (editor, config) => {
  let codeEditor;
  console.log(codeEditor);
  const cm = editor.Commands;
  const txtConfirm = config.textCleanCanvas;
  const modal = editor.Modal;

  cm.add(cmdImport, openImport(editor, config));
  cm.add(cmdDeviceDesktop, e => e.setDevice('Desktop'));
  cm.add(cmdDeviceTablet, e => e.setDevice('Tablet'));
  cm.add(cmdDeviceMobile, e => e.setDevice('Mobile portrait'));
  cm.add(cmdClear, e => confirm(txtConfirm) && e.runCommand('core:canvas-clear'));
  
  if(window.config.all_icons){
    
    cm.add('open-icons-modal', {
      run(ed, sender, opts = {}) {
        let component = opts.component || ed.getSelected();
        var all_icons = window.config.all_icons;
        
        modal.setTitle("Font awesome icons 5");
        var content = `
         <div class="div-search-modal-icon">
            <input type="text" name="search" id="input-icon-search" class="form-control-builder" placeholder="Search name icon">
        </div>
        <div id="icons-modal-list" style='min-height:300px;'>`;
        for (var i = 0, len = all_icons.length; i < len; i++) {
            content+=`<i class="${all_icons[i]}"></i>`;
        }
        content+=`</div>`;
        modal.setContent(content);

        document.querySelector("input#input-icon-search").addEventListener("change", function(element){
            
            var search = document.getElementById('input-icon-search').value;
            
            var matches = all_icons.filter(name => name.includes(search));
            
            if (matches.length > 0) {
              var content_match = '';
              
              for (var i = 0, len = matches.length; i < len; i++) {
                  content_match+=`<i class="${matches[i]}"></i>`;
              }

              document.getElementById("icons-modal-list").innerHTML = content_match;
            }
            else{
              document.getElementById("icons-modal-list").innerHTML = `<h3>Not found any icons</h3>`;
            }

            document.querySelectorAll("div#icons-modal-list > i").forEach(icon => 
              icon.addEventListener("click", function(icon){
                component.set({
                   attributes: { class: this.className},
                });
                modal.close();
              })
            );
            
        });


        document.querySelectorAll("div#icons-modal-list > i").forEach(icon => 
          icon.addEventListener("click", function(icon){
            component.set({
               attributes: { class: this.className},
            });
            modal.close();
          })
        );

        modal.open().getModel()
        .once('change:open', () => editor.stopCommand(this.id));

      },
      stop(editor, sender) {
        modal.close();
      },
    });
  }

  // Launch Code Editor popup
  cm.add('code-edit', {
    run: (editor, sender, options = {}) => {
      if (!codeEditor) codeEditor = new CodeEditor(editor, config);
      sender && sender.set('active', 0);

      codeEditor.showCodePopup();
    },
    stop: (editor) => {
      // Transform token to DC
      //Mautic.grapesConvertDynamicContentTokenToSlot(editor);
    },
  });
  
}
