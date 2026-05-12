<?php get_header(); ?>

<section class="container">
    <article class="front-page">
        <?php if (get_option('page_on_front')) : ?>
            <?php the_content(); ?>
        <?php endif; ?>
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
