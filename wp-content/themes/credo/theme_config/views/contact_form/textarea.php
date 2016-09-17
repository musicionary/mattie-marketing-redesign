<?php if(!empty($label)) : ?>
	<h5><?php print $label ?></h5>
<?php endif; ?>

<textarea name="<?php echo esc_attr($name)?>" placeholder="<?php echo esc_attr($placeholder)?>" <?php if(!empty($required)) echo 'data-parsley-required="true"'; ?>></textarea>