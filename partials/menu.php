<a href="#inicio-menu" id="inicio-menu" class="visually-hidden">In&iacute;cio do menu</a>

<?php
    $offcanvas_id = uniqid('offcanvas-');
    $offcanvas_label_id = uniqid('offcanvas-label-');
?>
<nav class="navbar navbar-expand-lg navbar-dark">
    <button class="navbar-toggler bg-primary" type="button" data-bs-toggle="offcanvas" data-bs-target="#<?php echo $offcanvas_id; ?>" aria-controls="<?php echo $offcanvas_id; ?>">
        <span class="navbar-toggler-icon"></span>
        <span class="align-middle fs-6">Menu</span>
    </button>
    <div class="offcanvas offcanvas-start text-bg-dark" tabindex="-1" aria-labelledby="<?php echo $offcanvas_label_id; ?>" id="<?php echo $offcanvas_id; ?>">
        <div class="offcanvas-header">
            <h2 class="offcanvas-title" id="<?php echo $offcanvas_label_id; ?>">Menu</h2>
            <button type="button" class="btn btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Fechar Menu"></button>
        </div>
        <div class="offcanvas-body">
            <?php
                wp_nav_menu( array(
                    'theme_location'  => 'main',
                    'depth'	          => 2,
                    'container'       => null,
                    'container_class' => '',
                    'container_id'    => '',
                    'menu_class'      => 'navbar-nav ms-auto me-lg-4 mb-3 mb-lg-0',
                ) );
            ?>
            <?php get_search_form(); ?>
        </div>
    </div>
</nav>

<a href="#fim-menu" id="fim-menu" class="visually-hidden">Fim do menu</a>
