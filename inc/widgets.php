<?php
function ingresso_widgets_init() {
    register_sidebar(array(
        'name'          => 'Carousel',
        'id'            => 'area-carousel',
        'description'   => __('Área para conteúdo em forma de slider, geralmente imagens.', 'ifrs-ingresso-theme'),
        'before_widget' => '<div id="%1$s" class="carousel-item %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<span class="sr-only">',
        'after_title'   => '</span>',
    ));
    register_sidebar(array(
        'name'          => 'Contato',
        'id'            => 'area-contato',
        'description'   => __('Área para formulário de contato no rodapé, aparece em todas as páginas.', 'ifrs-ingresso-theme'),
        'before_widget' => '<div id="%1$s" class="contato__widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<span class="sr-only">',
        'after_title'   => '</span>',
    ));
}
add_action('widgets_init', 'ingresso_widgets_init');
