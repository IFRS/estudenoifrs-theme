<?php get_header(); ?>

<section class="container">
    <div class="row">
        <?php echo get_template_part('partials/carousel'); ?>
    </div>
</section>

<section class="container">
    <h2 class="home-title">Estude no <span class="home-title__destaque">#mundo<strong>IFRS</strong></span></h2>
    <?php if (get_option( 'page_on_front' )) : ?>
        <?php
            the_post();
            the_content();
        ?>
    <?php endif; ?>
</section>

<?php echo get_template_part('partials/oportunidades'); ?>

<?php get_footer(); ?>
