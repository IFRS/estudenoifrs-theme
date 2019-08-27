<a href="#inicio-menu" id="inicio-menu" class="sr-only">In&iacute;cio do menu</a>

<?php $navbar_id = 'navbar-collapse-' . uniqid(); ?>
<nav class="navbar navbar-expand-md navbar-light bg-light" role="navigation">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#<?php echo $navbar_id; ?>" aria-controls="bs-example-navbar-collapse-1" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="<?php echo $navbar_id; ?>">
        <?php
            wp_nav_menu( array(
                'theme_location'  => 'main',
                'depth'	          => 2,
                'container'       => false,
                'container_class' => false,
                'container_id'    => false,
                'menu_class'      => 'navbar-nav mr-auto',
                'fallback_cb'     => 'WP_Bootstrap_Navwalker::fallback',
                'walker'          => new WP_Bootstrap_Navwalker(),
            ) );
        ?>
        <?php get_search_form(); ?>
    </div>
</nav>

<a href="#fim-menu" id="fim-menu" class="sr-only">Fim do menu</a>
