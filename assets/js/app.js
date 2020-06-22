/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you require will output into a single css file (app.css in this case)
require('../scss/app.scss');

// Need jQuery? Install it with "yarn add jquery", then uncomment to require it.

const $ = require('jquery');

global.jQuery = $;
global.$ = $;

// JS threeDots action sheet.
$(document).ready(() => {
// JS threeDots action sheet.
    $('.menu').hide();
    $('.threeDots').show().click(() => {
        $('.menu').toggle();
    });

    // method forms
    const $wrapper = $('.js-methodLink-wrapper');

    $wrapper.on('click', '.js-remove-methodLink', (e) => {
        e.preventDefault();

        $(this).closest('.js-methodLink-item')
            .fadeOut()
            .remove();
    });

    $wrapper.on('click', '.js-add-methodLink', (e) => {
        e.preventDefault();

        // Get the data-prototype explained earlier
        const prototype = $wrapper.data('prototype');

        // get the new index
        const index = $wrapper.data('index');

        // Replace '__name__' in the prototype's HTML to
        // instead be a number based on how many items we have
        const newForm = prototype.replace(/__name__/g, index);

        // increase the index with one for the next item
        $wrapper.data('index', index + 1);

        // Display the form in the page before the "new" link
        $(this).before(newForm);
    });
});

// this "modifies" the jquery module: adding behavior to it
// the bootstrap module doesn't export/return anything
require('bootstrap');
