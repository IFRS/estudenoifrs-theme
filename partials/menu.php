<a href="#inicio-menu" id="inicio-menu" class="visually-hidden">In&iacute;cio do menu</a>

<?php $navbar_id = 'navbar-collapse-' . uniqid(); ?>
<nav class="navbar navbar-expand-md navbar-light" role="navigation">
    <button class="mx-auto navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#<?php echo $navbar_id; ?>" aria-controls="<?php echo $navbar_id; ?>" aria-expanded="false" aria-label="<?php _e('Alternar menu'); ?>">
        <span class="navbar-toggler-icon"></span>&nbsp;Menu
    </button>
    <div class="collapse navbar-collapse" id="<?php echo $navbar_id; ?>">
        <?php
            wp_nav_menu( array(
                'theme_location'  => 'main',
                'depth'	          => 2,
                'container'       => false,
                'container_class' => false,
                'container_id'    => false,
                'menu_class'      => 'navbar-nav ml-auto mr-2',
            ) );
        ?>
        <?php get_search_form(); ?>
    </div>
</nav>

<a href="#fim-menu" id="fim-menu" class="visually-hidden">Fim do menu</a>
