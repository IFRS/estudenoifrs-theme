<?php
    $niveis = wp_get_post_terms(get_the_ID(), 'nivel', array('orderby' => 'parent'));
    $cores = array();
    foreach ($niveis as $nivel) {
        $cor = get_term_meta($nivel->term_id, '_nivel_color', true);
        if (!empty($cor)) $cores[] = $cor;
    }
    if (count($cores) === 1) $cores[1] = $cores[0];
?>
<article class="curso-item"<?php echo (!empty($cores)) ? "style=\"--gradiente-1: $cores[0]; --gradiente-2: $cores[1]; \"" : ''; ?>>
    <p class="curso-item__nivel">
        <?php foreach ($niveis as $nivel) : ?>
            <?php echo $nivel->name; ?>
            <?php echo ($nivel !== end($niveis)) ? ' / ' : ''; ?>
        <?php endforeach; ?>
    </p>
    <hr class="curso-item__separador">
    <h4 class="curso-item__title"><a href="<?php the_permalink(); ?>" style="color: <?php echo end($cores); ?>" class="stretched-link"><?php the_title(); ?></a></h4>
    <p class="curso-item__meta">
        <?php
            $duracao = get_post_meta( get_the_ID(), '_curso_duracao', true );
            $cargahoraria = get_post_meta( get_the_ID(), '_curso_carga_horaria', true );
        ?>
        <?php if ($duracao || $cargahoraria) : ?>
            <span class="curso-item__meta--cargahoraria">
                <i class="fa-regular fa-clock"></i>
                <?php if ($duracao) : ?>
                    <?php echo esc_html($duracao); ?> (<?php echo esc_html($cargahoraria); ?>h)
                <?php else : ?>
                    <?php echo esc_html($cargahoraria); ?>h
                <?php endif; ?>
            </span>
            <br>
        <?php endif; ?>

        <?php
            $turnos_ordenados = get_terms(array(
                'taxonomy'   => 'turno',
                'hide_empty' => false,
                'order_by'   => 'term_order',
                'fields'     => 'ids',
            ));

            $dias = array();
            $dias[] = get_post_meta( get_the_ID(), '_curso_segunda_feira' );
            $dias[] = get_post_meta( get_the_ID(), '_curso_terca_feira' );
            $dias[] = get_post_meta( get_the_ID(), '_curso_quarta_feira' );
            $dias[] = get_post_meta( get_the_ID(), '_curso_quinta_feira' );
            $dias[] = get_post_meta( get_the_ID(), '_curso_sexta_feira' );
            $dias[] = get_post_meta( get_the_ID(), '_curso_sabado' );
            $dias[] = get_post_meta( get_the_ID(), '_curso_domingo' );

            $turnos = array_filter($dias);

            $turnos = array_map(function($turnos_ids) {
                if ($turnos_ids && is_array($turnos_ids)) {
                    return explode(',', $turnos_ids[0]);
                }
                return null;
            }, $turnos);

            $turnos = array_merge(...$turnos);

            $turnos = array_unique($turnos);

            $turnos = ifrs_sortArrayByArrayValues($turnos, $turnos_ordenados);
        ?>
        <?php if ($turnos) : ?>
            <span class="curso-item__meta--turnos">
                <i class="fa-solid fa-sun"></i>
                <?php foreach ($turnos as $turno_id) : ?>
                    <?php $turno_name = get_term($turno_id)->name ?? ''; ?>
                    <?php echo $turno_name; echo ($turno_id !== end($turnos)) ? ', ' : ''; ?>
                <?php endforeach; ?>
            </span>
            <br>
        <?php endif; ?>

        <?php $modalidades = get_the_terms(get_the_ID(), 'modalidade'); ?>
        <?php if ($modalidades) : ?>
            <span class="curso-item__meta--modalidades">
                <i class="fa-solid fa-users"></i>
                <?php foreach ($modalidades as $modalidade) : ?>
                    <?php echo $modalidade->name; ?>
                <?php endforeach; ?>
            </span>
        <?php endif; ?>
    </p>
</article>
