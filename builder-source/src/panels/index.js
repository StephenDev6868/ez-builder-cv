import {
    cmdImport,
    cmdDeviceDesktop,
    cmdDeviceTablet,
    cmdDeviceMobile,
    cmdClear
} from './../consts';

export default (editor, config) => {
    const pn = editor.Panels;
    const eConfig = editor.getConfig();
    const crc = 'create-comp';
    const mvc = 'move-comp';
    const swv = 'sw-visibility';
    const expt = 'export-template';
    const osm = 'open-sm';
    const otm = 'open-tm';
    const ola = 'open-layers';
    const obl = 'open-blocks';
    const prv = 'preview';

    eConfig.showDevices = 0;

    const button_options = [{
            id: swv,
            command: swv,
            context: swv,
            className: 'far fa-square',
        }, {
            id: prv,
            context: prv,
            command: e => e.runCommand(prv),
            className: 'fa fa-eye',
        }
    ];
    

    button_options.push({
        id: "undo",
        className: "fa fa-undo",
        command: function(e) {
            return e.runCommand("core:undo")
        }
    }, {
        id: "redo",
        className: "fas fa-redo",
        command: function(e) {
            return e.runCommand("core:redo")
        }
    }, {
        id: cmdClear,
        className: 'fa fa-trash',
        command: e => e.runCommand(cmdClear),
    }, {
        id: 'back-button',
        command: function(e) {},
        className: 'fa fa-arrow-circle-left btn-builder-new',
        attributes: {
            title: 'Back Home',
            id: 'back-button'
        },
    }, {
        id: 'save-button',
        command: function(e) {},
        className: 'fa fa-save btn-builder-new',
        attributes: {
            title: 'Save',
            id: 'save-builder'
        },
    });


    pn.getPanels().reset([{
        id: 'commands',
        buttons: [{}],
    }, {
        id: 'options',
        buttons: button_options
    }, {
        id: 'views',
        buttons: [{
            id: osm,
            command: osm,
            active: true,
            className: 'fas fa-cog',
        }, {
            id: otm,
            command: otm,
            className: 'fa fa-cog',
        }],
    }]);


    const openBl = pn.getButton('views', obl);
    editor.on('load', () => openBl && openBl.set('active', 1));

    // On component change show the Style Manager
    config.showStylesOnChange && editor.on('component:selected', () => {
        const openSmBtn = pn.getButton('views', osm);
        const openLayersBtn = pn.getButton('views', ola);
        if ((!openLayersBtn || !openLayersBtn.get('active')) && editor.getSelected()) {
            openSmBtn && openSmBtn.set('active', 1);
        }
    });

    



}