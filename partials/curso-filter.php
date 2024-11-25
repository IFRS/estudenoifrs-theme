<?php
    $modalidades = get_terms(array(
        'taxonomy' => 'modalidade',
        'hide_empty' => false,
        'orderby' => 'term_order',
    ));
?>

<?php
    $unidades = get_terms(array(
        'taxonomy' => 'unidade',
        'hide_empty' => false,
        'orderby' => 'term_order',
    ));
?>

<?php
    $niveis = get_terms(array(
        'taxonomy' => 'nivel',
        'hide_empty' => false,
        'orderby' => 'term_order',
        'parent' => 0,
    ));
?>

<?php
    $turnos = get_terms(array(
        'taxonomy' => 'turno',
        'hide_empty' => false,
        'orderby' => 'term_order',
    ));
?>

<?php $is_filter = $args['is_filter']; ?>

<aside class="cursos__filter">
    <?php $form_id = uniqid('form-'); ?>
    <form action="<?php echo get_post_type_archive_link( 'curso' ); ?>" method="POST" class="filter" id="<?php echo $form_id; ?>">
        <?php $seachfield_id = uniqid(); ?>
        <div class="input-group">
            <label class="visually-hidden" for="<?php echo $seachfield_id; ?>"><?php _e('Termo para busca', 'ifrs-estude-theme'); ?></label>
            <input class="form-control form-control-lg rounded-1 border-0" type="text" name="s" value="<?php echo (!empty($_POST['s']) ? sanitize_text_field($_POST['s']) : ''); ?>" id="<?php echo $seachfield_id; ?>" placeholder="<?php _e('Buscar cursos...', 'ifrs-estude-theme'); ?>"/>
            <button type="submit" value="Filtrar" class="btn btn-lg btn-link bg-white">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 64 64" width="40" height="40" role="img" xmlns:xlink="http://www.w3.org/1999/xlink">
                    <path fill="none" stroke="currentColor" stroke-miterlimit="10" stroke-width="2" d="M39.049 39.049L56 56" stroke-linejoin="round" stroke-linecap="round"></path>
                    <circle data-name="layer1" cx="27" cy="27" r="17" fill="none" stroke="currentColor" stroke-miterlimit="10" stroke-width="2" stroke-linejoin="round" stroke-linecap="round"></circle>
                </svg>
            </button>
        </div>

        <?php $collapse_id = uniqid('collapse-'); ?>
        <div class="container filter__advanced">
            <div class="row collapse<?php echo $is_filter ? ' show' : ''; ?>" id="<?php echo $collapse_id; ?>">
                <fieldset class="col-lg">
                    <legend>Modalidade</legend>
                    <div class="filter__options">
                        <?php foreach ($modalidades as $modalidade): ?>
                            <?php $field_id = uniqid(); ?>
                            <?php $modalidade_check = (isset($_POST['modalidade']) && in_array($modalidade->slug, $_POST['modalidade'])) || is_tax('modalidade', $modalidade->slug); ?>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="modalidade[]" value="<?php echo $modalidade->slug; ?>" id="<?php echo $field_id; ?>" <?php echo $modalidade_check ? 'checked' : ''; ?>>
                                <label class="form-check-label" for="<?php echo $field_id; ?>"><?php echo $modalidade->name; ?></label>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </fieldset>
                <fieldset class="col-lg">
                    <legend>Unidade</legend>
                    <div class="filter__options">
                        <?php foreach ($unidades as $unidade): ?>
                            <?php $field_id = uniqid(); ?>
                            <?php $unidade_check = (isset($_POST['unidade']) && in_array($unidade->slug, $_POST['unidade'])) || is_tax('unidade', $unidade->slug); ?>
                            <div class="form-check form-check">
                                <input class="form-check-input" type="checkbox" name="unidade[]" value="<?php echo $unidade->slug; ?>" id="<?php echo $field_id; ?>" <?php echo $unidade_check ? 'checked' : ''; ?>>
                                <label class="form-check-label" for="<?php echo $field_id; ?>"><?php echo $unidade->name; ?></label>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </fieldset>
                <fieldset class="col-lg">
                    <legend>N&iacute;vel</legend>
                    <div class="filter__options">
                        <?php foreach ($niveis as $nivel): ?>
                            <?php echo get_template_part( 'partials/curso-filter-nivel', null, array('nivel' => $nivel) ); ?>
                            <?php
                                $filhos = get_terms(array(
                                    'taxonomy' => 'nivel',
                                    'hide_empty' => false,
                                    'parent' => $nivel->term_id,
                                ));
                                foreach ($filhos as $filho) {
                                    echo get_template_part( 'partials/curso-filter-nivel', null, array('nivel' => $filho) );
                                }
                            ?>
                        <?php endforeach; ?>
                    </div>
                </fieldset>
                <fieldset class="col-lg">
                    <legend>Turno</legend>
                    <div class="filter__options">
                        <?php foreach ($turnos as $turno): ?>
                            <?php $field_id = uniqid(); ?>
                            <?php $turno_check = (isset($_POST['turno']) && in_array($turno->slug, $_POST['turno'])) || is_tax('turno', $turno->slug); ?>
                            <div class="form-check form-check">
                                <input class="form-check-input" type="checkbox" name="turno[]" value="<?php echo $turno->slug; ?>" id="<?php echo $field_id; ?>" <?php echo $turno_check ? 'checked' : ''; ?>>
                                <label class="form-check-label" for="<?php echo $field_id; ?>"><?php echo $turno->name; ?></label>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </fieldset>
            </div>
            <div class="row mt-3">
                <div class="col text-start">
                    <button class="btn btn-link" type="button" data-bs-toggle="collapse" data-bs-target="#<?php echo $collapse_id; ?>" aria-expanded="false" aria-controls="<?php echo $form_id; ?>">
                        Busca
                    </button>
                </div>
                <div class="col text-end">
                <div class="filter__actions">
                    <a href="<?php echo get_post_type_archive_link( 'curso' ); ?>" class="btn btn-lg btn-outline-secondary rounded-0"><?php _e('Limpar', 'ifrs-estude-theme'); ?></a>
                    <button type="submit" value="Filtrar" class="btn btn-lg btn-primary rounded-0">Filtrar</button>
                </div>
                </div>
            </div>
        </div>
    </form>
</aside>
