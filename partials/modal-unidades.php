<?php add_action('wp_footer', function() { ?>
  <!-- Modal Unidades -->
  <?php
    $unidades = get_terms(array(
      'taxonomy' => 'unidade',
      'hide_empty' => false,
      'orderby' => 'term_order',
    ));
  ?>
  <?php foreach ($unidades as $unidade) : ?>
    <?php $modal_id = 'modal-unidade-' . $unidade->term_id; ?>

    <div class="modal fade" id="<?php echo $modal_id; ?>" tabindex="-1" aria-labelledby="<?php echo $modal_id; ?>-label" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h2 class="modal-title fs-4" id="<?php echo $modal_id; ?>-label"><?php echo $unidade->name; ?></h2>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <?php echo apply_filters( 'the_content', $unidade->description ); ?>
          </div>
          <div class="modal-footer">
            <a href="<?php echo get_term_link( $unidade->term_id, 'unidade' ); ?>">Todos os Cursos dessa Unidade</a>
          </div>
        </div>
      </div>
    </div>
  <?php endforeach; ?>
<?php }); ?>
