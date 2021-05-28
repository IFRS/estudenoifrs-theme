<a href="#inicio-menu" id="inicio-menu" class="visually-hidden">In&iacute;cio do menu</a>

<?php $navbar_id = uniqid('navbar-collapse-'); ?>
<nav class="navbar navbar-expand-md navbar-light" role="navigation">
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#<?php echo $navbar_id; ?>" aria-controls="<?php echo $navbar_id; ?>" aria-expanded="false" aria-label="<?php _e('Alternar Menu'); ?>">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="<?php echo $navbar_id; ?>">
        <?php
            wp_nav_menu( array(
                'theme_location'  => 'main',
                'depth'	          => 2,
                'container'       => null,
                'container_class' => '',
                'container_id'    => '',
                'menu_class'      => 'navbar-nav ms-auto me-2',
            ) );
        ?>
        <?php get_search_form(); ?>
    </div>
</nav>

<a href="#fim-menu" id="fim-menu" class="visually-hidden">Fim do menu</a>
