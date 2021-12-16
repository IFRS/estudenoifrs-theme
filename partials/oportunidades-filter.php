<div class="oportunidades-filter">
    <form action="<?php echo esc_url(home_url('/')); ?>" method="POST" class="oportunidades-filter__form row g-3 align-items-center">
        <?php $select_unidade_id = uniqid(); ?>
        <div class="col-auto m-0">
            <label class="visually-hidden" for="<?php echo $select_unidade_id; ?>">Unidade</label>
            <select name="curso_unidade[]" id="<?php echo $select_unidade_id; ?>" class="form-select flex-grow-0 w-auto">
                <?php
                    $unidades = get_terms(array(
                        'taxonomy' => 'unidade',
                        'hide_empty' => false,
                    ));
                ?>
                <option hidden selected disabled>Unidade</option>
                <?php foreach ($unidades as $unidade) : ?>
                    <?php $unidade_check = (!empty($_POST['curso_unidade']) && array_search($unidade->slug, $_POST['curso_unidade']) !== false); ?>
                    <option value="<?php echo $unidade->slug; ?>"<?php echo $unidade_check ? ' selected' : ''; ?>><?php echo $unidade->name; ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <?php $select_nivel_id = uniqid(); ?>
        <div class="col-auto m-0">
            <label class="visually-hidden" for="<?php echo $select_nivel_id; ?>">N&iacute;vel</label>
            <?php
                $niveis = get_terms(array(
                    'taxonomy' => 'nivel',
                    'hide_empty' => false,
                    'parent' => 0,
                ));
            ?>
            <select name="curso_nivel[]" id="<?php echo $select_nivel_id; ?>" class="form-select flex-grow-0 w-auto">
                <option hidden selected disabled>N&iacute;vel</option>
                <?php foreach ($niveis as $nivel) : ?>
                    <?php $nivel_check = (!empty($_POST['curso_nivel']) && array_search($nivel->slug, $_POST['curso_nivel']) !== false); ?>
                    <option value="<?php echo $nivel->slug; ?>"<?php echo $nivel_check ? ' selected' : ''; ?> data-ifrs-toggle="#ajuda-<?php echo $nivel->term_id; ?>"><?php echo $nivel->name; ?></option>
                    <?php
                        $filhos = get_terms(array(
                            'taxonomy' => 'nivel',
                            'hide_empty' => false,
                            'parent' => $nivel->term_id,
                        ));
                    ?>
                    <?php foreach ($filhos as $filho) : ?>
                        <?php $nivel_check = (!empty($_POST['curso_nivel']) && array_search($filho->slug, $_POST['curso_nivel']) !== false); ?>
                        <option value="<?php echo $filho->slug; ?>"<?php echo $nivel_check ? ' selected' : ''; ?> data-ifrs-toggle="#ajuda-<?php echo $filho->term_id; ?>">&nbsp;&nbsp;&nbsp;<?php echo $filho->name; ?></option>
                    <?php endforeach; ?>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="col m-0 text-end">
            <div class="btn-group" role="group" aria-label="Ações">
                <button type="submit" class="btn" title="Filtrar Oportunidades" data-bs-toggle="tooltip" data-bs-placement="top">
                    <span class="visually-hidden">Filtrar Oportunidades</span>
                </button>
                <a href="<?php echo home_url(); ?>" class="btn oportunidades-filter__reset" title="Limpar Filtros" data-bs-toggle="tooltip" data-bs-placement="top">
                    <span class="visually-hidden">Limpar Filtros</span>
                </a>
            </div>
        </div>
    </form>
    <?php
        $niveis_ajuda = get_terms(array(
            'taxonomy' => 'nivel',
            'hide_empty' => false,
        ));
    ?>
    <?php foreach ($niveis_ajuda as $nivel) : if (empty($nivel->description)) continue; ?>
        <div id="ajuda-<?php echo $nivel->term_id; ?>" class="mt-3 alert alert-info d-none" role="alert">
            <strong><?php echo $nivel->name; ?></strong>: <?php echo $nivel->description; ?>
        </div>
    <?php endforeach; ?>
</div>
