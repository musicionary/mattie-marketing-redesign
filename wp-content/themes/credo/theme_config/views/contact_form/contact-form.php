<form method="POST" action="contact_form_send_message" class="tt-form contact-form" data-parsley-validate>
	<?php 
	$i=0;	//unnamed fields counter
	foreach($rows as $row) : ?> 
		<div class="row"><!-- Start Row -->
			<?php foreach( $row['columns'] as $column ) : ?> 
				<div class="col-md-<?php echo esc_attr($column['size']); ?>"><!-- Start Column -->
					<?php if (!empty($column['form_elements']))
						foreach($column['form_elements'] as $form_element) : ?>
							<!-- Start Element -->
							<?php 
							if(!empty($form_element) && is_array($form_element))
									extract($form_element);
							//If no name set giving a random name=================
							if(!isset($name) || $name===''){
								$i++;
								$name = 'UnNamedField'.$id.$i;
							}
							//making it easier to work with $required variable
							if(!empty($required) && $required === 'true')
								$required = TRUE;
							else
								$required = FALSE;
							//Including view of the field=========================
							if($file_location = locate_template( "theme_config/views/contact_form/" . $form_element['type'] . ".php"))
								require $file_location;
							//Reseting used variables=============================
							unset($name,$placeholder,$required,$select_options,$label);
							?>
							<!-- End Element -->
						<?php endforeach; ?>
				</div><!-- End Column -->
			<?php endforeach;?>
		</div><!-- End Row -->
	<?php endforeach;?>
	<input type="hidden" name="id" value="<?php echo esc_attr($id); ?>">
</form>
