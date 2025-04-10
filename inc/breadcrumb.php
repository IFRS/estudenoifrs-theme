<?php
/* Yoast SEO */
add_filter( 'wpseo_breadcrumb_output_wrapper', function( string $output ) {
    $output = 'ol';

    return $output;
} );

add_filter( 'wpseo_breadcrumb_output', function ( $original_breadcrumbs ) {
    $new_home = \str_replace( '>Home<', 'aria-label="' . get_bloginfo('name') . '"><i class="fa-solid fa-house"></i><', $original_breadcrumbs );

    return $new_home;
} );

add_filter( 'wpseo_breadcrumb_output_class', function( $class ) {
    return 'breadcrumb';
} );

add_filter( 'wpseo_breadcrumb_single_link_wrapper', function( string $output ) {
    $output = 'li';

    return $output;
} );

add_filter( 'wpseo_breadcrumb_separator', function( string $output ) {
    $output = '';

    return $output;
} );

add_filter( 'wpseo_breadcrumb_single_link', function( $link ) {
    if ( strpos( $link, 'breadcrumb_last' ) !== false ) {
        $link = str_replace( 'breadcrumb_last', 'breadcrumb-item active', $link );
    } else {
        $link = str_replace( '<li>', '<li class="breadcrumb-item">', $link );
    }

    return $link;
} );

/* Custom Breadcrumb */
function ingresso_breadcrumb() {
    $before        = '<li class="breadcrumb-item">';
    $before_active = '<li class="breadcrumb-item active" aria-current="page">';
    $after         = '</li>';

    if (!is_front_page() || is_paged()) {
        echo '<section class="migalhas">';
        echo '<nav class="container" aria-label="Você está em:">';
		echo '<ol class="breadcrumb">';

        global $post;
        $homelink = home_url();

        echo $before . '<a href="' . $homelink . '" aria-label="' . get_bloginfo('name') . '"><i class="fa-solid fa-house"></a>' . $after;

        if (is_home()) {
            echo $before_active . get_the_title(get_option( 'page_for_posts' )) . $after;
        } elseif (is_category()) {
            global $wp_query;
            $cat_obj   = $wp_query->get_queried_object();
            $thisCat   = $cat_obj->term_id;
            $thisCat   = get_category($thisCat);
            $parentCat = get_category($thisCat->parent);
            if ($thisCat->parent != 0) {
                echo get_category_parents($parentCat, true);
            }
            echo $before_active . single_cat_title('', false) . $after;
        } elseif (is_post_type_archive()) {
            echo $before_active . post_type_archive_title('', false) . $after;
        } elseif (is_tax('unidade') || is_tax('modalidade') || is_tax('nivel') || is_tax('turno')) {
            echo $before . '<a href="' . get_post_type_archive_link( 'cursos' ) . '">Cursos</a>' . $after;
            echo $before_active . single_term_title('', false) . $after;
        } elseif (is_single() && !is_attachment()) {
            if (get_post_type() != 'post') {
                $post_type = get_post_type_object(get_post_type());
                $slug      = $post_type->rewrite;
                echo $before . '<a href="' . $homelink . '/' . $slug['slug'] . '/">' . $post_type->labels->name . '</a>' . $after;
                echo $before_active . get_the_title() . $after;
            } else {
                $cat = get_the_category();
                $cat = $cat[0];
                echo $before . get_category_parents($cat, true) . $after;
                echo $before_active . get_the_title() . $after;
            }
        } elseif (is_attachment()) {
            $parent = get_post($post->post_parent);
            $cat    = get_the_category($parent->ID);
            $cat    = $cat[0];
            echo get_category_parents($cat, true);
            echo $before . '<a href="' . get_permalink(
                $parent
            ) . '">' . $parent->post_title . '</a>' . $after;
            echo $before_active . get_the_title() . $after;

        } elseif (is_page() && !$post->post_parent) {
            echo $before_active . get_the_title() . $after;
        } elseif (is_page() && $post->post_parent) {
            $parent_id   = $post->post_parent;
            $breadcrumbs = array();
            while ($parent_id) {
                $page          = get_page($parent_id);
                $breadcrumbs[] = $before . '<a href="' . get_permalink($page->ID) . '">' . get_the_title(
                    $page->ID
                ) . '</a>' . $after;
                $parent_id     = $page->post_parent;
            }
            $breadcrumbs = array_reverse($breadcrumbs);
            foreach ($breadcrumbs as $crumb) {
                echo $crumb;
            }
            echo $before_active . get_the_title() . $after;
        } elseif (is_search()) {
            echo $before_active . 'Resultados para "' . get_search_query() . '"' . $after;
        } elseif (is_tag()) {
            echo $before_active . 'Tag: "' . single_tag_title('', false) . '"' . $after;
        } elseif (is_author()) {
            global $author;
            $userdata = get_userdata($author);
            echo $before_active . ' ' . $userdata->display_name . $after;
        } elseif (is_day()) {
            echo $before . '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time(
                'Y'
            ) . '</a>' . $after;
            echo $before . '<a href="' . get_month_link(get_the_time('Y'), get_the_time('m')) . '">' . get_the_time(
                'F'
            ) . '</a>' . $after;
            echo $before_active . get_the_time('d') . $after;
        } elseif (is_month()) {
            echo $before . '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time(
                'Y'
            ) . '</a>' . $after;
            echo $before_active . get_the_time('F') . $after;
        } elseif (is_year()) {
            echo $before_active . get_the_time('Y') . $after;
        } elseif (is_404()) {
            echo $before_active . 'Erro 404' . $after;
        }

        echo '</ol>';
		echo '</nav>';
        echo '</section>';
    }
}
