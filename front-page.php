<?php get_header(); ?>

<section class="banner">
    <div class="container">
        <?php echo get_template_part('partials/carousel'); ?>
    </div>
</section>

<section class="container">
    <article class="hero">
        <h1 class="hero__title"><?php echo preg_replace('/(\w+)$/', '<span>$0</span>', get_bloginfo( 'name' )); ?></h1>
        <div class="hero__text">
            <?php if (get_option( 'page_on_front' )) : ?>
                <?php
                    the_post();
                    the_content();
                ?>
            <?php endif; ?>
        </div>
    </article>
</section>

<section class="banner">
    <div class="container">
        <a href="<?php echo get_post_type_archive_link( 'curso' ); ?>">
            <picture>
                <img src="<?php echo get_stylesheet_directory_uri(); ?>/img/guia-de-cursos-1400.png" class="img-fluid" alt="Guia de Cursos">
            </picture>
        </a>
    </div>
</section>

<?php echo get_template_part('partials/oportunidades'); ?>

<?php get_footer(); ?>
