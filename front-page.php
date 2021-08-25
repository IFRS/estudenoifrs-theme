<?php get_header(); ?>

<section class="container">
    <div class="row">
        <?php echo get_template_part('partials/carousel'); ?>
    </div>
</section>

<section class="container">
    <article class="hero">
        <h2 class="hero__title"><?php echo preg_replace('/(\w+)$/', '<span>$0</span>', get_bloginfo( 'name' )); ?></h2>
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

<?php echo get_template_part('partials/oportunidades'); ?>

<?php get_footer(); ?>
