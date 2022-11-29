document.addEventListener('DOMContentLoaded', function() {
  let paginations = document.querySelectorAll('ul.pagination');
  paginations.forEach(function(pagination) {
    pagination.querySelector('.current').parentElement.classList.add('active');
  });
});
