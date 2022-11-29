import lightGallery from 'lightgallery';
import lgThumbnail from 'lightgallery/plugins/thumbnail/lg-thumbnail.es5.js';

document.addEventListener('DOMContentLoaded', function() {
  let galleries = document.querySelectorAll('.wp-block-gallery');
  galleries.forEach(function(gallery) {
    gallery.querySelectorAll('a').forEach(function(link) {
      let img = link.querySelector('img');

      if (img) {
        let src = img.getAttribute('data-src');
        link.setAttribute('data-thumb', src);
      }
    });
    lightGallery(gallery, {
      plugins: [lgThumbnail],
      selector: '.blocks-gallery-item a',
      exThumbImage: 'data-thumb',
    });
  });

  let images = document.querySelectorAll('a[href$=".jpg"],a[href$=".jpeg"],a[href$=".png"],a[href$=".gif"],a[href$=".svg"]');
  images.forEach(function(image) {
    if (!image.closest('.wp-block-gallery')) {
      lightGallery(image, {
        selector: 'this',
      });
    }
  });
});
