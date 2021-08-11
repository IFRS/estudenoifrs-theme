<?php get_header(); ?>

<?php the_post(); ?>

<div class="destaque">
    <section class="container">
        <article id="post-<?php the_ID(); ?>" <?php post_class('post'); ?>>
            <h2 class="post__title"><?php the_title(); ?></h2>
            <div class="post__content">
                <?php
                    if (has_post_thumbnail()) {
                        the_post_thumbnail('full', array('class' => 'post__thumb'));
                    }
                ?>
                <?php the_content(); ?>
                <nav aria-label="Paginação do Conteúdo">
                    <?php
                        wp_link_pages(array(
                            'before' => '<ul class="pagination"><li class="page-item">',
                            'separator' => '</li><li class="page-item">',
                            'after'  => '</li></ul>',
                        ));
                    ?>
                </nav>
            </div>
        </article>
    </section>
</div>

<?php get_footer(); ?>
