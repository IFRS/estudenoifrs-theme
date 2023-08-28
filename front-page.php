<?php get_header(); ?>

<section class="container d-none d-lg-block">
    <article class="front-page">
        <div class="row align-items-center">
            <div class="col">
                <div class="front-page__text">
                    <?php if (get_option('page_on_front')) : ?>
                        <?php
                            the_post();
                            the_content();
                        ?>
                    <?php endif; ?>
                </div>
            </div>
            <div class="col col-lg-3">
                <a href="<?php echo get_post_type_archive_link('curso'); ?>" class="front-page__banner">
                    <img src="<?php echo get_stylesheet_directory_uri(); ?>/img/guia-de-cursos.png" class="img-fluid" alt="Guia de Cursos">
                </a>
            </div>
    </article>
</section>

<?php echo get_template_part('partials/oportunidades'); ?>

<?php if (is_active_sidebar('area-banners')) : ?>
    <section class="banners">
        <div class="container">
            <?php dynamic_sidebar('area-banners'); ?>
            <hr>
        </div>
    </section>
<?php endif; ?>

<?php get_footer(); ?>
