<?php
    /* Conteúdo Relacionado */
    global $post;

    $args = array(
        'post_type' => $post->post_type,
        'post_status' => 'publish',
        'orderby' => 'date',
        'order' => 'DESC',
        'numberposts' => 3,
        'ignore_sticky_posts' => true,
        'post__not_in' => array($post->ID, get_option( 'page_on_front' ), get_option( 'page_for_posts' )),
        'post_parent' => $post->post_parent,
    );

    $posts = get_posts($args);
?>
<?php if (!empty($posts)) : ?>
    <aside class="aside">
        <div class="container">
            <h2 class="aside__title">Acesse Tamb&eacute;m</h2>
            <?php foreach ($posts as $post) : ?>
                <a class="btn aside__btn" href="<?php echo get_permalink( $post->ID ); ?>"><?php echo $post->post_title; ?></a>
            <?php endforeach; ?>
        </div>
    </aside>
<?php endif; ?>
