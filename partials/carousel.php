<?php if (is_active_sidebar('area-carousel')) : ?>
    <?php $carousel_id = 'carousel-' . uniqid(); ?>
    <div id="<?php echo $carousel_id; ?>" class="carousel slide" data-ride="carousel">
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
