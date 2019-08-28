<?php
function ingresso_widgets_init() {
	register_sidebar(array(
		'name'          => 'Carousel',
		'id'            => 'area-carousel',
		'description'   => __('Área para conteúdo em forma de slider, geralmente imagens.', 'ifrs-portal-theme'),
		'before_widget' => '<div id="%1$s" class="carousel-item active %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<span class="sr-only">',
		'after_title'   => '</span>',
    ));
}
add_action('widgets_init', 'ingresso_widgets_init');
