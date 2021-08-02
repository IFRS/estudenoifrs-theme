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
    ));
?>

<?php
    $turnos = get_terms(array(
        'taxonomy' => 'turno',
        'hide_empty' => false,
        'orderby' => 'term_order',
    ));
?>

<aside>
    <?php $form_id = uniqid('form-'); ?>
    <form action="<?php echo get_post_type_archive_link( 'curso' ); ?>" method="POST" class="filter filter--advanced collapse" id="<?php echo $form_id; ?>">
        <div class="row">
            <fieldset class="col-xl">
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
            <fieldset class="col-xl">
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
            <fieldset class="col-xl">
                <legend>N&iacute;vel</legend>
                <div class="filter__options">
                    <?php foreach ($niveis as $nivel): ?>
                        <?php $field_id = uniqid(); ?>
                        <?php $nivel_check = (isset($_POST['nivel']) && in_array($nivel->slug, $_POST['nivel'])) || is_tax('nivel', $nivel->slug); ?>
                        <div class="form-check<?php echo ($nivel->parent !== 0) ? ' ms-3' : '' ?>">
                            <input class="form-check-input" type="checkbox" name="nivel[]" value="<?php echo $nivel->slug; ?>" id="<?php echo $field_id; ?>" <?php echo $nivel_check ? 'checked' : ''; ?>>
                            <label class="form-check-label" for="<?php echo $field_id; ?>"><?php echo $nivel->name; ?></label>
                        </div>
                    <?php endforeach; ?>
                </div>
            </fieldset>
            <fieldset class="col-xl">
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
            <fieldset class="col-xl">
                <legend>Curso</legend>
                <?php $seachfield_id = uniqid(); ?>
                <div class="input-group">
                    <label class="visually-hidden" for="<?php echo $seachfield_id; ?>"><?php _e('Termo para busca'); ?></label>
                    <input class="form-control form-control-sm" type="text" name="s" value="<?php echo (get_search_query() ? get_search_query() : ''); ?>" id="<?php echo $seachfield_id; ?>" placeholder="<?php _e('Buscar cursos...'); ?>"/>
                </div>
            </fieldset>
        </div>
        <hr class="filter__separator">
        <div class="row">
            <div class="col">
                <button class="btn btn-link float-start" type="button" data-bs-toggle="collapse" data-bs-target=".filter" aria-expanded="false" aria-controls="<?php echo $form_id; ?>">
                    Busca simples
                </button>
                <div class="float-end">
                    <a href="<?php echo get_post_type_archive_link( 'curso' ); ?>" class="btn btn-lg btn-outline-secondary rounded-0 me-3"><?php _e('Limpar', 'ifrs-portal-theme'); ?></a>
                    <input type="submit" value="Filtrar" class="btn btn-lg btn-primary rounded-0">
                </div>
            </div>
        </div>
    </form>
    <form action="<?php echo get_post_type_archive_link( 'curso' ); ?>" method="POST" class="filter filter--simple collapse show">
        <?php $seachfield_id = uniqid(); ?>
        <div class="input-group">
            <label class="visually-hidden" for="<?php echo $seachfield_id; ?>"><?php _e('Termo para busca'); ?></label>
            <input class="form-control form-control-lg rounded-1 border-0" type="text" name="s" value="<?php echo (get_search_query() ? get_search_query() : ''); ?>" id="<?php echo $seachfield_id; ?>" placeholder="<?php _e('Buscar cursos...'); ?>"/>
            <button type="submit" value="Filtrar" class="btn btn-lg btn-link bg-white">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 64 64" width="40" height="40" role="img" xmlns:xlink="http://www.w3.org/1999/xlink">
                    <path fill="none" stroke="#202020" stroke-miterlimit="10" stroke-width="2" d="M39.049 39.049L56 56" stroke-linejoin="round" stroke-linecap="round"></path>
                    <circle data-name="layer1" cx="27" cy="27" r="17" fill="none" stroke="#202020" stroke-miterlimit="10" stroke-width="2" stroke-linejoin="round" stroke-linecap="round"></circle>
                </svg>
            </button>
        </div>
        <button class="btn btn-link" type="button" data-bs-toggle="collapse" data-bs-target=".filter" aria-expanded="false" aria-controls="<?php echo $form_id; ?>">
            Busca avançada
        </button>
    </form>
</aside>
