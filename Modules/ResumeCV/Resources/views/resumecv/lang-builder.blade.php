<script>
// https://github.com/artf/grapesjs/blob/master/src/i18n/locale/en.js
const traitInputAttr = { placeholder: "@lang('eg. Text here')" };
const langs_builder = {
    assetManager: {
        addButton: "@lang('Add image')",
        inputPlh: 'http://path/to/the/image.jpg',
        modalTitle: "@lang('Select Image')",
        uploadTitle: "@lang('Drop files here or click to upload')",
    },
    traitManager: {
        label: 'Settings',
        traits: {
            // The core library generates the name by their `name` property
            labels: {
                id: "@lang('Id')",
                alt: "@lang('Alt')",
                title: "@lang('Title')",
                href: "@lang('Href')",
            },
            // In a simple trait, like text input, these are used on input attributes
            attributes: {
                id: traitInputAttr,
                alt: traitInputAttr,
                title: traitInputAttr,
                href: { placeholder: 'eg. https://google.com' }
            },
            // In a trait like select, these are used to translate option names
            options: {
                target: {
                false: "@lang('This window')",
                _blank: "@lang('New window')"
                }
            }
        }
    },
    styleManager: {
        empty: "@lang('Select an element before using Style Manager')",
        layer: "@lang('Layer')",
        fileButton: "@lang('Images')",
        sectors: {
            general: "@lang('General')",
            layout: "@lang('Layout')",
            typography: "@lang('Typography')",
            background: "@lang('Background')",
            decorations: "@lang('Decorations')",
            extra: "@lang('Extra')",
            border: "@lang('Border')",
            flex: "@lang('Flex')",
            dimension: "@lang('Dimension')",
        },
        properties: {
            'color': "@lang('Color')",
            'font-size': "@lang('Font Size')",
            'font-weight': "@lang('Font weight')",
            'letter-spacing': "@lang('Letter spacing')",
            'line-height': "@lang('Line height')",
            'normal': "@lang('normal')",
            'text-align': "@lang('Text align')",
            'background-color': "@lang('Background color')",
            'border': "@lang('Border')",
            'border-width': "@lang('Border width')",
            'border-style': "@lang('Border style')",
            'border-color': "@lang('Border color')",
        }
    },
};
// langs builder for js
const langs_builder_js = {
    'thin': "@lang('Thin')",
    'extraLight': "@lang('Extra-Light')",
    'light': "@lang('Light')",
    'normal': "@lang('Normal')",
    'medium': "@lang('Medium')",
    'semiBold': "@lang('Semi-Bold')",
    'bold': "@lang('Bold')",
    'extraBold': "@lang('Extra-Bold')",
    'ultraBold': "@lang('Ultra-Bold')",
    'none': "@lang('none')",
    'solid': "@lang('solid')",
    'dotted': "@lang('dotted')",
    'dashed': "@lang('dashed')",
    'double': "@lang('double')",
    'groove': "@lang('groove')",
    'ridge': "@lang('ridge')",
    'inset': "@lang('inset')",
    'outset': "@lang('outset')",
};

                    
</script>