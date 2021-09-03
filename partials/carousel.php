<?php if (is_active_sidebar('area-carousel')) : ?>
    <?php $carousel_id = uniqid('carousel-'); ?>
    <div id="<?php echo $carousel_id; ?>" class="carousel slide" data-bs-ride="carousel">
        <ol class="carousel-indicators">
            <?php
                $total_widgets = wp_get_sidebars_widgets();
                $carousel_widgets = count($total_widgets['area-carousel']);
            ?>
            <?php for ($i = 0; $i < $carousel_widgets; $i++) : ?>
                <li data-bs-target="#<?php echo $carousel_id; ?>" data-bs-slide-to="<?php echo $i; ?>" <?php echo ($i == 0) ? 'class="active"' : ''; ?>></li>
            <?php endfor; ?>
        </ol>
        <div class="carousel-inner">
            <?php dynamic_sidebar('area-carousel'); ?>
        </div>
        <button class="carousel-control-prev" data-bs-target="#<?php echo $carousel_id; ?>" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Slide Anterior</span>
        </button>
        <button class="carousel-control-next" data-bs-target="#<?php echo $carousel_id; ?>" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Próximo Slide</span>
        </button>
    </div>
<?php endif; ?>
