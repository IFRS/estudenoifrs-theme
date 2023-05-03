<?php
    $niveis = wp_get_post_terms(get_the_ID(), 'nivel', array('orderby' => 'parent')); // De repente usar wp_list_categories() para pegar a lista hierarquica.
    $cores = array();
    foreach ($niveis as $nivel) {
        $cor = get_term_meta($nivel->term_id, '_nivel_color', true);
        if (!empty($cor)) $cores[] = $cor;
    }
    if (count($cores) === 1) $cores[1] = $cores[0];
    $gradiente = implode(', ', $cores);
?>
<article class="curso-item"<?php echo (!empty($cores)) ? "style=\"border-image-source: linear-gradient(to right, $gradiente); \"" : ''; ?>>
    <p class="curso-item__nivel">
        <?php foreach ($niveis as $nivel) : ?>
            <?php echo $nivel->name; ?>
            <?php echo ($nivel !== end($niveis)) ? ' / ' : ''; ?>
        <?php endforeach; ?>
    </p>
    <hr class="curso-item__separador">
    <h4 class="curso-item__title"><a href="<?php the_permalink(); ?>" style="color: <?php echo end($cores); ?>"><?php the_title(); ?></a></h4>
    <p class="curso-item__meta">
        <span class="curso-item__meta--cargahoraria">
            <?php
                $duracao = get_post_meta( get_the_ID(), '_curso_duracao', true );
                $cargahoraria = get_post_meta( get_the_ID(), '_curso_carga_horaria', true );
            ?>
            <?php if ($duracao) : ?>
                <?php echo esc_html($duracao); ?> (<?php echo esc_html($cargahoraria); ?>h)
            <?php else : ?>
                <?php echo esc_html($cargahoraria); ?>h
            <?php endif; ?>
        </span>
        <br>
        <span class="curso-item__meta--turnos">
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
            <?php foreach ($turnos as $turno_id) : ?>
                <?php echo get_term($turno_id)->name; echo ($turno_id !== end($turnos)) ? ', ' : ''; ?>
            <?php endforeach; ?>
        </span>
        <br>
        <span class="curso-item__meta--modalidades">
            <?php foreach (get_the_terms(get_the_ID(), 'modalidade') as $modalidade) : ?>
                <?php echo $modalidade->name; ?>
            <?php endforeach; ?>
        </span>
    </p>
    <a href="<?php the_permalink(); ?>" class="curso-item__link-info">
        Saiba mais<span class="visually-hidden">&nbsp;sobre o curso <?php the_title(); ?></span>
    </a>
</article>
