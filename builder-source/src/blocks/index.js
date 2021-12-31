export default (editor, config) => {
    const bm = editor.BlockManager;
    const toAdd = name => config.blocks.indexOf(name) >= 0;

    // remove block default form
    bm.remove('form');
    bm.remove('input');
    bm.remove('textarea');
    bm.remove('select');
    bm.remove('button');
    bm.remove('label');
    bm.remove('checkbox');
    bm.remove('radio');



    toAdd('text-basic') && bm.add('text-basic', {
        category: 'Basic',
        label: 'Text section',
        attributes: {
            class: 'fas fa-align-justify'
        },
        content: `<section>
      <h1>Insert title here</h1>
      <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua</p>
      </section>`
    });

    toAdd('image') && bm.add('image', {
        category: 'Basic',
        label: 'Image',
        attributes: {
            class: 'fas fa-image'
        },
        content: {
            style: {
                color: "black"
            },
            type: "image",
            classes: ['img-fluid'],
        }
    });
     
    toAdd('icon-block') && bm.add('icon-block', {
        category: 'Basic',
        label: 'Icon',
        attributes: {
            class: "fas fa-icons"
        },
        content: `<div class="i-size-6x"> <i class="fas fa-coffee"></i></div>`
    });


    toAdd('quote') && bm.add('quote', {
        label: 'Quote',
        category: 'Basic',
        attributes: {
            class: 'fa fa-quote-right'
        },
        content: `<blockquote class="quote">
        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore ipsum dolor sit
      </blockquote>`
    });



}