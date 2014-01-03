<?php
$title = array(
  'name'        => 'title',
  'id'          => 'title',
  'value'       => set_value('title'),
  'maxlength'   => $this->config->item('title_max_length', 'story'),
  'class'       => 'form-control',
);
$select_image = array(
  'name'      => 'userfile',
  'id'        => 'userfile',
);
$caption = array(
  'name'          => 'caption',
  'id'            => 'caption',
  'value'         => set_value('caption'),
  'maxlength'     => $this->config->item('caption_max_length', 'story'),
  'style'         => 'resize: none',
  'rows'          => 3,
  'class'         => 'form-control',
);

$form_error = form_error($title['name']);
if (!empty($form_error)) $error[$title['name']] = $form_error;
if (!empty($error[$title['name']])) $title['id'] = 'inputError';

$form_error = form_error($select_image['name']);
if (!empty($form_error)) $error[$select_image['name']] = $form_error;
if (!empty($error[$select_image['name']])) $select_image['id'] = 'inputError';

$form_error = form_error($caption['name']);
if (!empty($form_error)) $error[$caption['name']] = $form_error;
if (!empty($error[$caption['name']])) $caption['id'] = 'inputError';
?>

<div class="col-xs-8 col-xs-offset-2">
<?php echo form_open_multipart($this->uri->uri_string()); ?>

<div class="form-group <?php if (!empty($error[$title['name']])) echo 'has-error'; ?>">
  <?php echo form_label('Title', $title['id'], array('class' => 'control-label')); ?>
  <?php echo form_input($title); ?>
  <?php if (!empty($error[$title['name']])) { ?><span class="help-block"><?php echo $error[$title['name']]; ?></span><?php } ?>
</div>

<div class="form-group <?php if (!empty($error[$select_image['name']])) echo 'has-error'; ?>">
  <?php echo form_label('Select Image', $select_image['id'], array('class' => 'control-label')); ?>
  <input type="file" name="<?php echo $select_image['name']; ?>" id="<?php echo $select_image['id']; ?>">
  <?php if (!empty($error[$select_image['name']])) { ?><span class="help-block"><?php echo $error[$select_image['name']]; ?></span><?php } ?>
</div>

<div class="form-group <?php if (!empty($error[$caption['name']])) echo 'has-error'; ?>">
  <?php echo form_label('Caption', $caption['id'], array('class' => 'control-label')); ?>
  <?php echo form_textarea($caption); ?>
  <?php if (!empty($error[$caption['name']])) { ?><span class="help-block"><?php echo $error[$caption['name']]; ?></span><?php } ?>
</div>

<div class="row">
  <div class="col-xs-5">
    <button type="submit" class="btn btn-primary btn-block">Add</button>
  </div>
</div>

<?php echo form_close(); ?>
</div>