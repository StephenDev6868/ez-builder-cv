export default (editor, config) => {
    const sm = editor.StyleManager;
    const csm = config.customStyleManager;
    const langs = langs_builder_js;
    
    sm.getSectors().reset(csm && csm.length ? csm : [
        {
            name: config.textTypography,
            open: false,
            buildProps: ["color", "font-size", "font-weight", "letter-spacing", "line-height", "text-align"],
            properties: [{
                property: 'text-align',
                list: [{
                        value: 'left',
                        className: 'fa fa-align-left'
                    },
                    {
                        value: 'center',
                        className: 'fa fa-align-center'
                    },
                    {
                        value: 'right',
                        className: 'fa fa-align-right'
                    },
                    {
                        value: 'justify',
                        className: 'fa fa-align-justify'
                    },
                ],
            },
            {
                property: 'font-weight',
                defaults: '400',
                list: [
                    { value: '100', name: langs.thin },
                    { value: '300', name: langs.light },
                    { value: '400', name: langs.normal },
                    { value: '700', name: langs.bold},
                ]
            },
            {
                property: 'letter-spacing',
                defaults: '',
            },
            {
                property: 'line-height',
                defaults: '',
            },
            
            ]
        },
        {
            name: config.textBackground,
            open: !1,
            buildProps: ["background-color"],
            properties: [{
                property: 'background-color',
                defaults: '#ffffff',
            },
            ]
        },

        {
            name: config.textBorder,
            open: !1,
            buildProps: ["border-width","border-style","border-color"],
            properties: [
                {
                  property: 'border-width',
                  type: 'integer',
                  units: ['px', 'em'],
                  defaults: '',
                  min: 0
                },
                {
                  property: 'border-style',
                  type: 'select',
                  defaults: '',
                  list: [
                    { value: 'none' , name : langs.none},
                    { value: 'solid' , name : langs.solid},
                    { value: 'dotted' , name : langs.dotted},
                    { value: 'dashed' , name : langs.dashed},
                    { value: 'double' , name : langs.double},
                    { value: 'groove' , name : langs.groove},
                    { value: 'ridge' , name : langs.ridge},
                    { value: 'inset' , name : langs.inset},
                    { value: 'outset' , name : langs.outset}
                  ]
                },
                {
                  property: 'border-color',
                  type: 'color',
                  defaults: '#000000'
                }
            ]
        }
    ]);
}