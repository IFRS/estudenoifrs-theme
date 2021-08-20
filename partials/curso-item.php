<?php
    $niveis = wp_get_post_terms(get_the_ID(), 'nivel', array('orderby' => 'parent')); // De repente usar wp_list_categories() para pegar a lista hierarquica.
    $cores = array();
    foreach ($niveis as $nivel) {
        $cor = get_term_meta($nivel->term_id, '_nivel_color', true);
        if (!empty($cor)) $cores[] = $cor;
    }
    if (count($cores) === 1) $cores[1] = $cores[0];
    $cores = implode(', ', $cores);
?>
<article class="curso-item"<?php echo (!empty($cores)) ? "style=\"border-image-source: linear-gradient(to right, $cores); \"" : ''; ?>>
    <p class="curso-item__nivel">
        <?php foreach ($niveis as $nivel) : ?>
            <?php echo $nivel->name; ?>
            <?php echo ($nivel !== end($niveis)) ? ' / ' : ''; ?>
        <?php endforeach; ?>
    </p>
    <hr class="curso-item__separador">
    <h4 class="curso-item__title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
    <p class="curso-item__meta">
        <span class="curso-item__cargahoraria">
            <?php echo esc_html(get_post_meta( get_the_ID(), '_curso_duracao', true )); ?> (<?php echo esc_html(get_post_meta( get_the_ID(), '_curso_carga_horaria', true )); ?>h)
        </span>
        <br>
        <span class="curso-item__turnos">
            <?php $turnos = wp_get_post_terms(get_the_ID(), 'turno', array('orderby' => 'term_order')); ?>
            <?php foreach ($turnos as $turno) : ?>
                <?php echo $turno->name; echo ($turno !== end($turnos)) ? ', ' : ''; ?>
            <?php endforeach; ?>
        </span>
        <br>
        <span class="curso-item__modalidades">
            <?php foreach (get_the_terms(get_the_ID(), 'modalidade') as $modalidade) : ?>
                <?php echo $modalidade->name; ?>
            <?php endforeach; ?>
        </span>
    </p>
    <a href="<?php the_permalink(); ?>" class="curso-item__link-info">
        Saiba mais<span class="visually-hidden">&nbsp;sobre o curso <?php the_title(); ?></span>
    </a>
</article>
