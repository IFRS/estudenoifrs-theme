<?php get_header(); ?>

<?php the_post(); ?>

<div class="container">
    <div class="row">
        <div class="col-12">
            <?php echo get_template_part('partials/oportunidade'); ?>
        </div>
    </div>
</div>

<?php get_footer(); ?>
