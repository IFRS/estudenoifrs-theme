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
                <option selected value>Todas as Unidades</option>
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
                <option selected value>Todos os N&iacute;veis</option>
                <?php foreach ($niveis as $nivel) : ?>
                    <?php $nivel_check = (!empty($_POST['curso_nivel']) && array_search($nivel->slug, $_POST['curso_nivel']) !== false); ?>
                    <option value="<?php echo $nivel->slug; ?>"<?php echo $nivel_check ? ' selected' : ''; ?> data-ifrs-alert="<?php echo $nivel->description; ?>"><?php echo $nivel->name; ?></option>
                    <?php
                        $filhos = get_terms(array(
                            'taxonomy' => 'nivel',
                            'hide_empty' => false,
                            'parent' => $nivel->term_id,
                        ));
                    ?>
                    <?php foreach ($filhos as $filho) : ?>
                        <?php $nivel_check = (!empty($_POST['curso_nivel']) && array_search($filho->slug, $_POST['curso_nivel']) !== false); ?>
                        <option value="<?php echo $filho->slug; ?>"<?php echo $nivel_check ? ' selected' : ''; ?> data-ifrs-alert="<?php echo $filho->description; ?>">&nbsp;&nbsp;&nbsp;<?php echo $filho->name; ?></option>
                    <?php endforeach; ?>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="col-auto m-0">
            <?php
                $modalidades = get_terms(array(
                    'taxonomy' => 'modalidade',
                    'hide_empty' => false,
                ));
            ?>
            <?php foreach ($modalidades as $modalidade) : ?>
                <?php $check_modalidade_id = uniqid(); ?>
                <?php $modalidade_check = (!empty($_POST['curso_modalidade']) && array_search($modalidade->slug, $_POST['curso_modalidade']) !== false); ?>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" name="curso_modalidade[]" value="<?php echo $modalidade->slug; ?>" id="<?php echo $check_modalidade_id; ?>"<?php echo $modalidade_check ? ' checked' : ''; ?>>
                    <label class="form-check-label" for="<?php echo $check_modalidade_id; ?>"><?php echo $modalidade->name; ?></label>
                </div>
            <?php endforeach; ?>
        </div>
        <div class="col m-0 text-end">
            <button type="submit" class="btn" title="Filtrar Oportunidades" data-bs-toggle="tooltip" data-bs-placement="top">
                Filtrar<span class="visually-hidden">&nbsp;Oportunidades</span>
            </button>
            <a href="<?php echo esc_url(home_url()); ?>" class="btn oportunidades-filter__reset" title="Limpar Filtros" data-bs-toggle="tooltip" data-bs-placement="top">
                Limpar<span class="visually-hidden">&nbsp;Filtros</span>
            </a>
        </div>
    </form>
</div>
