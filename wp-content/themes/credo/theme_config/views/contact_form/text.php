<?php if(!empty($label)) : ?>
	<h5><?php print $label ?></h5>
<?php endif; ?>	

<input type="text" name="<?php echo esc_attr($name)?>" class="loc-form-input" placeholder="<?php echo esc_attr($placeholder)?>" <?php if(!empty($required)) echo 'data-parsley-required="true"'; ?>>
		
