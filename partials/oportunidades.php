<?php
    $today = new Datetime('today midnight');

    $is_search = !empty($_POST['curso_unidade']) || !empty($_POST['curso_nivel']);

    $meta_query = array();

    if ($is_search) {
        $curso_tax_query = array();

        if (!empty($_POST['curso_unidade'])) {
            $curso_tax_query[] = array(
                'taxonomy' => 'unidade',
                'field'    => 'slug',
                'terms'    => (array) $_POST['curso_unidade'],
            );
        }

        if (!empty($_POST['curso_nivel'])) {
            $curso_tax_query[] = array(
                'taxonomy' => 'nivel',
                'field'    => 'slug',
                'terms'    => (array) $_POST['curso_nivel'],
            );
        }

        $cursos = new WP_Query(array(
            'post_type' => 'curso',
            'nopaging' => true,
            'posts_per_page' => -1,
            'fields' => 'ids',
            'tax_query' => $curso_tax_query,
        ));
    }

    if (isset($cursos)) {
        $meta_query[] = array(
            'key'     => '_oportunidade_cursos',
            'value'   => !empty($cursos->posts) ? $cursos->posts : 0,
            'compare' => 'IN',
        );
    }

    $meta_query[] = array(
        'key' => '_oportunidade_inscricao_termino',
        'value' => $today->format('U'),
        'compare' => '>=',
        'type' => 'NUMERIC',
    );

    $args = array(
        'post_type' => 'oportunidade',
        'nopaging' => true,
        'posts_per_page' => -1,
        'meta_query' => $meta_query,
        'meta_key' => '_oportunidade_inscricao_termino',
        'orderby' => 'meta_value_num',
        'order' => 'ASC',
    );

    $oportunidades = new WP_Query($args);
?>

<section class="container">
    <h2 class="hero__title">Inscri&ccedil;&otilde;es <span>Abertas</span></h2>
</section>

<section class="oportunidades">
    <div class="container">
        <?php get_template_part('partials/oportunidades-filter'); ?>
        <?php if ($oportunidades->have_posts()) : ?>
            <div class="oportunidades__list">
                <?php while ($oportunidades->have_posts()) : $oportunidades->the_post(); ?>
                    <?php echo get_template_part('partials/oportunidade'); ?>
                <?php endwhile; ?>
            </div>
        <?php else : ?>
            <div class="alert <?php echo (!$is_search) ? 'alert-info' : 'alert-warning'; ?>" role="alert">
                <?php if (!$is_search) : ?>
                    N&atilde;o existem inscri&ccedil;&otilde;es abertas no momento, fique atento para novas publica&ccedil;&otilde;es.
                <?php else : ?>
                    Sua busca não encontrou inscri&ccedil;&otilde;es abertas no momento, fique atento para novas publica&ccedil;&otilde;es.
                <?php endif; ?>
                Enquanto isso, confira o nosso <a href="<?php echo get_post_type_archive_link( 'curso' ); ?>" class="alert-link">Guia de Cursos</a>.
            </div>
        <?php endif; ?>
    </div>
</section>
