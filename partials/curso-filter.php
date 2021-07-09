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

<aside class="filter">
    <h3 class="filter__title"><?php _e('Filtros'); ?></h3>
    <form action="<?php echo get_post_type_archive_link( 'curso' ); ?>" method="POST" class="filter__form">
        <?php $seachfield_id = uniqid(); ?>
        <div class="input-group">
            <label class="sr-only" for="<?php echo $seachfield_id; ?>"><?php _e('Termo para busca'); ?></label>
            <input class="form-control form-control-sm" type="text" name="s" value="<?php echo (get_search_query() ? get_search_query() : ''); ?>" id="<?php echo $seachfield_id; ?>" placeholder="<?php _e('Buscar cursos...'); ?>"/>
        </div>
        <fieldset>
            <legend>Modalidade</legend>
            <?php foreach ($modalidades as $modalidade): ?>
                <?php $field_id = uniqid(); ?>
                <?php $modalidade_check = (isset($_POST['modalidade']) && in_array($modalidade->slug, $_POST['modalidade'])) || is_tax('modalidade', $modalidade->slug); ?>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" name="modalidade[]" value="<?php echo $modalidade->slug; ?>" id="<?php echo $field_id; ?>" <?php echo $modalidade_check ? 'checked' : ''; ?>>
                    <label class="form-check-label" for="<?php echo $field_id; ?>"><?php echo $modalidade->name; ?></label>
                </div>
            <?php endforeach; ?>
        </fieldset>
        <fieldset>
            <legend>Unidade</legend>
            <?php foreach ($unidades as $unidade): ?>
                <?php $field_id = uniqid(); ?>
                <?php $unidade_check = (isset($_POST['unidade']) && in_array($unidade->slug, $_POST['unidade'])) || is_tax('unidade', $unidade->slug); ?>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" name="unidade[]" value="<?php echo $unidade->slug; ?>" id="<?php echo $field_id; ?>" <?php echo $unidade_check ? 'checked' : ''; ?>>
                    <label class="form-check-label" for="<?php echo $field_id; ?>"><?php echo $unidade->name; ?></label>
                </div>
            <?php endforeach; ?>
        </fieldset>
        <fieldset>
            <legend>N&iacute;vel</legend>
            <?php foreach ($niveis as $nivel): ?>
                <?php $field_id = uniqid(); ?>
                <?php $nivel_check = (isset($_POST['nivel']) && in_array($nivel->slug, $_POST['nivel'])) || is_tax('nivel', $nivel->slug); ?>
                <div class="form-check<?php echo ($nivel->parent !== 0) ? ' ml-3' : '' ?>">
                    <input class="form-check-input" type="checkbox" name="nivel[]" value="<?php echo $nivel->slug; ?>" id="<?php echo $field_id; ?>" <?php echo $nivel_check ? 'checked' : ''; ?>>
                    <label class="form-check-label" for="<?php echo $field_id; ?>"><?php echo $nivel->name; ?></label>
                </div>
            <?php endforeach; ?>
        </fieldset>
        <fieldset>
            <legend>Turno</legend>
            <?php foreach ($turnos as $turno): ?>
                <?php $field_id = uniqid(); ?>
                <?php $turno_check = (isset($_POST['turno']) && in_array($turno->slug, $_POST['turno'])) || is_tax('turno', $turno->slug); ?>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" name="turno[]" value="<?php echo $turno->slug; ?>" id="<?php echo $field_id; ?>" <?php echo $turno_check ? 'checked' : ''; ?>>
                    <label class="form-check-label" for="<?php echo $field_id; ?>"><?php echo $turno->name; ?></label>
                </div>
            <?php endforeach; ?>
        </fieldset>
        <div class="btn-group" role="group" aria-label="Ações do Filtro">
            <input type="submit" value="Filtrar" class="btn btn-primary">
            <a href="<?php echo get_post_type_archive_link( 'curso' ); ?>" class="btn btn-outline-secondary"><?php _e('Limpar Filtros', 'ifrs-portal-theme'); ?></a>
        </div>
    </form>
</aside>
