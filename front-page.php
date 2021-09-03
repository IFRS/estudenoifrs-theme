<?php get_header(); ?>

<section class="container">
    <div class="row">
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

<div class="destaque">
    <section class="container">
        <a href="<?php echo get_post_type_archive_link( 'curso' ); ?>">
            <img src="<?php echo get_stylesheet_directory_uri(); ?>/img/cursos-banner.png" alt="Guia de Cursos">
        </a>
    </section>
</div>

<?php echo get_template_part('partials/oportunidades'); ?>

<?php get_footer(); ?>
