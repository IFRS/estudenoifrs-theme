<?php get_header(); ?>

<div class="container-fluid">
    <div class="row">
        <?php echo get_template_part('partials/carousel'); ?>
    </div>
</div>

<div class="container">
    <div class="row">
        <div class="col-12">
            <h2 class="home-title">Estude no <span class="home-title__destaque">#mundo<strong>IFRS</strong></span></h2>
            <?php if (get_option( 'page_on_front' )) : ?>
                <div class="home-intro">
                    <?php
                        the_post();
                        the_content();
                    ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php get_footer(); ?>
