<?php if (is_active_sidebar('area-carousel')) : ?>
    <?php $carousel_id = 'carousel-' . uniqid(); ?>
    <div id="<?php echo $carousel_id; ?>" class="carousel slide carousel-fade" data-ride="carousel">
        <ol class="carousel-indicators">
            <?php
                $total_widgets = wp_get_sidebars_widgets();
                $sidebar_widgets = count($total_widgets['area-carousel']);
            ?>
            <?php for ($i = 0; $i < $sidebar_widgets; $i++) : ?>
                <li data-target="#<?php echo $carousel_id; ?>" data-slide-to="<?php echo $i; ?>" <?php echo ($i == 0) ? 'class="active"' : ''; ?>></li>
            <?php endfor; ?>
        </ol>
        <div class="carousel-inner">
            <?php dynamic_sidebar('area-carousel'); ?>
        </div>
        <a class="carousel-control-prev" href="#<?php echo $carousel_id; ?>" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Anterior</span>
        </a>
        <a class="carousel-control-next" href="#<?php echo $carousel_id; ?>" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Pr&oacute;ximo</span>
        </a>
    </div>
<?php endif; ?>
