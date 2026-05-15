<?php get_header(); ?>

<section class="container">
    <article class="front-page">
        <?php if (get_option('page_on_front')) : ?>
            <?php the_content(); ?>
        <?php endif; ?>
    </article>
</section>

<?php echo get_template_part('partials/oportunidades'); ?>

<?php get_footer(); ?>
