<?php
function ingresso_excerpt_length( $length ) {
    return 20;
}

add_filter( 'excerpt_length', 'ingresso_excerpt_length', 999 );
