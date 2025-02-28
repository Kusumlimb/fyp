import './bootstrap';
import "flowbite";
import Alpine from 'alpinejs';
import.meta.glob([
    '../images/**'
]);
import videojs from 'video.js';
import 'video.js/dist/video-js.css';
import { Accordion } from 'flowbite';

window.Alpine = Alpine;
Alpine.start();

$("textarea").each(function () {
    this.style.height = this.scrollHeight + "px";
    this.style.overflowY = "hidden";
}).on("input", function () {
    this.style.height = "auto";
    this.style.height = this.scrollHeight + "px";
});
