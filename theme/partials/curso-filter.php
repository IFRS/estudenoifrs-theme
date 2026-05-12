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
        'orderby' => 'name',
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

<?php
    $s = $args['s'];
    $unidades_queried = $args['unidades_queried'];
    $modalidades_queried = $args['modalidades_queried'];
    $niveis_queried = $args['niveis_queried'];
    $turnos_queried = $args['turnos_queried'];
    $is_filter = $args['is_filter'];
?>

<aside class="cursos__filter">
    <?php $form_id = uniqid('form-'); ?>
    <form action="<?php echo get_post_type_archive_link( 'curso' ); ?>" method="POST" class="filter" id="<?php echo $form_id; ?>">
        <?php $seachfield_id = uniqid(); ?>
        <label class="visually-hidden" for="<?php echo $seachfield_id; ?>"><?php _e('Termo para busca', 'ifrs-estude-theme'); ?></label>
        <input class="form-control form-control-lg border-0 filter__search-input" type="text" name="s" value="<?php echo (!empty($s) ? sanitize_text_field($s) : null); ?>" id="<?php echo $seachfield_id; ?>" placeholder="<?php _e('Buscar cursos...', 'ifrs-estude-theme'); ?>"/>

        <?php $collapse_id = uniqid('collapse-'); ?>
        <div class="filter__advanced">
            <div class="collapse<?php echo $is_filter ? ' show' : ''; ?>" id="<?php echo $collapse_id; ?>">
                <div class="row">
                    <fieldset class="col-lg">
                        <legend>Modalidade</legend>
                        <div class="filter__options">
                            <?php foreach ($modalidades as $modalidade): ?>
                                <?php $field_id = uniqid(); ?>
                                <?php $modalidade_check = (isset($modalidades_queried) && in_array($modalidade->slug, $modalidades_queried)) || is_tax('modalidade', $modalidade->slug); ?>
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
                                <?php $unidade_check = (isset($unidades_queried) && in_array($unidade->slug, $unidades_queried)) || is_tax('unidade', $unidade->slug); ?>
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
                                <?php echo get_template_part( 'partials/curso-filter-nivel', null, array('nivel' => $nivel, 'niveis_queried' => $niveis_queried) ); ?>
                                <?php
                                    $filhos = get_terms(array(
                                        'taxonomy' => 'nivel',
                                        'hide_empty' => false,
                                        'parent' => $nivel->term_id,
                                    ));
                                    foreach ($filhos as $filho) {
                                        echo get_template_part( 'partials/curso-filter-nivel', null, array('nivel' => $filho, 'niveis_queried' => $niveis_queried) );
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
                                <?php $turno_check = (isset($turnos_queried) && in_array($turno->term_id, $turnos_queried)) || is_tax('turno', $turno->term_id); ?>
                                <div class="form-check form-check">
                                    <input class="form-check-input" type="checkbox" name="turno[]" value="<?php echo $turno->term_id; ?>" id="<?php echo $field_id; ?>" <?php echo $turno_check ? 'checked' : ''; ?>>
                                    <label class="form-check-label" for="<?php echo $field_id; ?>"><?php echo $turno->name; ?></label>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </fieldset>
                </div>
            </div>
            <div class="row">
                <div class="col order-1 text-end">
                    <div class="filter__actions">
                        <button type="submit" value="Filtrar" class="btn btn-lg btn-primary">Filtrar</button>
                        <a href="<?php echo get_post_type_archive_link( 'curso' ); ?>" class="btn btn-lg btn-outline-secondary"><?php _e('Limpar', 'ifrs-estude-theme'); ?></a>
                    </div>
                </div>
                <div class="col order-0 text-start">
                    <button class="btn btn-link" type="button" data-bs-toggle="collapse" data-bs-target="#<?php echo $collapse_id; ?>" aria-expanded="false" aria-controls="<?php echo $form_id; ?>">
                        Busca Avan&ccedil;ada<i class="fa-solid fa-chevron-down ms-1"></i>
                    </button>
                </div>
            </div>
        </div>
    </form>
</aside>

<?php
add_action( 'wp_print_footer_scripts', function () use ($form_id, $collapse_id) {
?>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const collapse = document.getElementById('<?php echo $collapse_id; ?>');
        const toggle = document.querySelector('[data-bs-target="#<?php echo $collapse_id; ?>"]');
        collapse.addEventListener('show.bs.collapse', function() {
            const toggleIcon = toggle.querySelector('[data-fa-i2svg]');
            toggleIcon.classList.replace('fa-chevron-down', 'fa-chevron-up');
        });
        collapse.addEventListener('hide.bs.collapse', function() {
            const toggleIcon = toggle.querySelector('[data-fa-i2svg]');
            toggleIcon.classList.replace('fa-chevron-up', 'fa-chevron-down');
        });
    });

    document.getElementById('<?php echo $form_id; ?>').addEventListener('submit', function(event) {
        event.preventDefault(); // Impede o envio padrão do formulário

        // Coleta os dados do formulário
        let formData = new FormData(this);
        formData.delete('s');

        // Transforma os dados em uma string de parâmetros
        let params = new URLSearchParams(formData).toString();

        // Codifica os dados em base64
        let encodedParams = btoa(params);

        // Cria um novo formulário em memória
        let searchForm = document.createElement('form');
        searchForm.action = this.action;
        searchForm.method = 'GET';

        // Adiciona o campo oculto com os dados codificados
        if (encodedParams !== '') {
            let encodedInput = document.createElement('input');
            encodedInput.type = 'hidden';
            encodedInput.name = 'busca';
            encodedInput.value = encodedParams;
            searchForm.appendChild(encodedInput);
        }

        // Adiciona o campo de busca textual
        let searchText = this.elements.namedItem('s').value;

        if (searchText !== '') {
            let searchInput = document.createElement('input');
            searchInput.type = 'text';
            searchInput.name = 's';
            searchInput.value = searchText;
            searchForm.appendChild(searchInput);
        }

        // Adiciona o novo formulário ao corpo do documento e o envia
        document.body.appendChild(searchForm);
        searchForm.submit();
    });
</script>
<?php
} );
