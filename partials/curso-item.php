<div class="curso">
    <p class="curso__nivel">
        <!-- <?php foreach (get_the_terms(get_the_ID(), 'unidade') as $unidade) : ?>
            <span class="curso__unidade"><?php echo $unidade->name; ?></span>
        <?php endforeach; ?> -->
        <?php $niveis = wp_get_post_terms(get_the_ID(), 'nivel', array('orderby' => 'term_id')); // De repnte usar wp_list_categories() para pegar lista hierarquica. ?>
        <?php foreach ($niveis as $nivel) : ?>
            <?php echo $nivel->name; ?>
            <?php echo ($nivel !== end($niveis)) ? ' / ' : ''; ?>
        <?php endforeach; ?>
    </p>
    <hr class="curso__separador">
    <h4 class="curso__title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
    <p class="curso__meta">
        <span class="curso__cargahoraria">
            <?php echo esc_html(get_post_meta( get_the_ID(), '_curso_duracao', true )); ?> (<?php echo esc_html(get_post_meta( get_the_ID(), '_curso_carga_horaria', true )); ?>h)
        </span>
        <br>
        <span class="curso__turnos">
            <?php $turnos = wp_get_post_terms(get_the_ID(), 'turno', array('orderby' => 'term_order')); ?>
            <?php foreach ($turnos as $turno) : ?>
                <?php echo $turno->name; echo ($turno !== end($turnos)) ? ', ' : ''; ?>
            <?php endforeach; ?>
        </span>
        <br>
        <span class="curso__modalidades">
            <?php foreach (get_the_terms(get_the_ID(), 'modalidade') as $modalidade) : ?>
                <?php echo $modalidade->name; ?>
            <?php endforeach; ?>
        </span>
    </p>
    <a href="<?php the_permalink(); ?>" class="curso__link-info">
        <span>Saiba mais</span>
    </a>
</div>
