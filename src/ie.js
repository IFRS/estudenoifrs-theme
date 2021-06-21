require('html5shiv');
require('respond.js/dest/respond.src');
require('flexibility');

document.addEventListener('readystatechange', function() {
    flexibility(document.body);
});
