import lightGallery from 'lightgallery';

document.addEventListener('DOMContentLoaded', function() {
    let images = document.querySelectorAll('a[href$=".jpg"],a[href$=".jpeg"],a[href$=".png"],a[href$=".gif"],a[href$=".svg"]');
    images.forEach(function(el) {
        lightGallery(el, {
            selector: 'this',
        });
    });
});
