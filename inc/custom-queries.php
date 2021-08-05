<?php
/* Disable Curso main query */
add_filter( 'posts_request', function( $request, $query ) {
    if ( $query->is_main_query() && ! $query->is_admin && $query->is_post_type_archive( 'curso' ) ) {
        return false;
    } else {
        return $request;
    }
}, 99, 2 );
