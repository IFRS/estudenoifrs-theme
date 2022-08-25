<?php
  $nivel = wp_parse_args($args, array(
    'nivel' => null,
  ) )['nivel'];
  if (empty($nivel)) return;
  $field_id = uniqid();
  $nivel_check = (isset($_POST['nivel']) && in_array($nivel->slug, $_POST['nivel'])) || is_tax('nivel', $nivel->slug);
?>
<div class="form-check<?php echo ($nivel->parent !== 0) ? ' ms-3' : '' ?>">
    <input class="form-check-input" type="checkbox" name="nivel[]" value="<?php echo $nivel->slug; ?>" id="<?php echo $field_id; ?>" <?php echo $nivel_check ? 'checked' : ''; ?>>
    <label class="form-check-label" for="<?php echo $field_id; ?>"><?php echo $nivel->name; ?></label>
    <?php if (!empty($nivel->description)) : ?>
        <button type="button" class="btn btn-link btn-sm filter__help" data-bs-toggle="tooltip" data-bs-placement="top" title="<?php echo $nivel->description; ?>"><span class="visually-hidden">Ajuda</span></button>
    <?php endif; ?>
</div>
