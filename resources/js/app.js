import './bootstrap';
import select2 from 'select2';


import Alpine from 'alpinejs';
import focus from '@alpinejs/focus';
import $ from 'jquery';
window.$ = $;

window.Alpine = Alpine;

Alpine.plugin(focus);

Alpine.start();

$(document).ready(function() {
    //$('.select2').select2();
});




