import './bootstrap';
import Alpine from 'alpinejs';
import.meta.glob([
    '../images/**'
]);
window.Alpine = Alpine;
Alpine.start();

// Text Area Auto Size
$("textarea").each(function () {
    this.style.height = this.scrollHeight + "px";
    this.style.overflowY = "hidden";
}).on("input", function () {
    this.style.height = "auto";
    this.style.height = this.scrollHeight + "px";
});
