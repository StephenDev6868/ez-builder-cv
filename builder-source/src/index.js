import grapesjs from 'grapesjs';
import pluginForms from 'grapesjs-plugin-forms';
import grapesSwiperSlider from 'grapesjs-swiper-slider';

import grapesjsCustomCode from 'grapesjs-custom-code';
import grapesjsCountdown from 'grapesjs-component-countdown';

import commands from './commands';
import blocks from './blocks';
import components from './components';


import panels from './panels';
import styles from './styles';

export default grapesjs.plugins.add('gjs-preset-webpage', (editor, opts = {}) => {
  let config = opts;

  let defaults = {
    // Default Countdown

    // Countdown class prefix
    countdownClsPfx: 'countdown',

    // Default CodeEditor
    sourceEdit: 1,
    sourceEditBtnLabel: 'Save Edit',
    sourceEditModalTitle: 'Edit code',
    // Which blocks to add
    blocks: ['column1', 'column2', 'column3', 'column4-8', 'link-block','button-link-block','icon-block', 'custom-code', 'quote', 'text-basic', 'image', 'video'],

    // Modal import title
    modalImportTitle: 'Import',

    // Modal import button text
    modalImportButton: 'Import',

    // Import description inside import modal
    modalImportLabel: '',

    // Default content to setup on import model open.
    // Could also be a function with a dynamic content return (must be a string)
    // eg. modalImportContent: editor => editor.getHtml(),
    modalImportContent: '',

    // Code viewer (eg. CodeMirror) options
    importViewerOptions: {},

    // Confirm text before cleaning the canvas
    textCleanCanvas: 'Are you sure to clean the canvas?',

    // Show the Style Manager on component change
    showStylesOnChange: 1,

    // Text for Background sector in Style Manager
    textBackground: 'Background',

    // Text for Border & Shadow sector in Style Manager
    textBorderAndShadow: 'Border & Shadow',

     textBorder: 'Border',

    // Text for General sector in Style Manager
    textGeneral: 'General',

    // Text for Layout sector in Style Manager
    textLayout: 'Layout',

    // Text for Typography sector in Style Manager
    textTypography: 'Typography',

    // Text for Decorations sector in Style Manager
    textDecorations: 'Decorations',

    // Text for Extra sector in Style Manager
    textExtra: 'Extra',

    // Use custom set of sectors for the Style Manager
    customStyleManager: [],

    // `grapesjs-component-countdown` plugin options
    // By setting this option to `false` will avoid loading the plugin
    countdownOpts: {},

    // `grapesjs-plugin-forms` plugin options
    // By setting this option to `false` will avoid loading the plugin
    formsOpts: {},

    SwiperSlider: {

       slideEls: `
         <div class="swiper-slide"><img src="https://i.ibb.co/x3bdd4y/1.png" alt="banner-1" border="0"></div>
         <div class="swiper-slide"><img src="https://i.ibb.co/0mNNdd9/2.png" alt="banner-2" border="0"></div>
         <div class="swiper-slide"><img src="https://i.ibb.co/PwtHQrH/3.png" alt="banner-3" border="0"></div>
         <div class="swiper-slide"><img src="https://i.ibb.co/sCCgF9s/4.png" alt="banner-4" border="0"></div>
         <div class="swiper-slide"><img src="https://i.ibb.co/2gBjgbh/5.png" alt="banner-5" border="0"></div>
         <div class="swiper-slide"><img src="https://i.ibb.co/MCYKL52/6.png" alt="banner-6" border="0"></div>
        `,
    },
    customCodeOpts: {},

  };

  // Load defaults
  for (let name in defaults) {
    if (!(name in config))
      config[name] = defaults[name];
  }

  const {
    formsOpts,
    customCodeOpts,
    SwiperSlider
  } = config;


  // Load plugins
  formsOpts && pluginForms(editor, formsOpts);
  grapesjsCustomCode(editor, customCodeOpts);
  grapesSwiperSlider(editor, SwiperSlider);
  grapesjsCountdown(editor, {});

  // Load blocks
  blocks(editor, config);

  // Load commands
  commands(editor, config);
  
  // Load components
  components(editor, config);

  // Load panels
  panels(editor, config);

  // Load styles
  styles(editor, config);


 


});
