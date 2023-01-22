import './bootstrap';


import Alpine from 'alpinejs';
import focus from '@alpinejs/focus';
import $ from 'jquery';
window.$ = $;

window.Alpine = Alpine;

Alpine.plugin(focus);

Alpine.start();



