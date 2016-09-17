<div class="cf_lightbox_cotainer">
	<label class="lightbox_trigger">
		<input type="checkbox" name="<?php echo $captainform_display_as_lightbox_name; ?>" class="cf_display_as_lightbox" value="1" <?php if (isset($display_as_lightbox) && ($display_as_lightbox == 1)): ?> checked="checked"<?php endif; ?>/>
		<span class="lightbox_trigger_text">
			Display as a lightbox
		</span>
	</label>
	<div class="cf_triggers_container">							
		<div class="cf_lightbox_title">
			<b>Lightbox trigger</b>
		</div>
		<div class="row">
			<div class="cf_trigger_option">
				<label>
					<input type="radio" name="<?php echo $captainform_trigger_option_name; ?>"  <?php if ($captainform_selected_trigger == 0): ?> checked="checked" <?php endif; ?> class="cf_trigger" value="0" />
					Text
				</label>
			</div>
			<div class="cf_trigger_option">
				<label>
					<input type="radio" name="<?php echo $captainform_trigger_option_name; ?>" class="cf_trigger"  <?php if ($captainform_selected_trigger == 1): ?> checked="checked" <?php endif; ?> value="1" />
					Click on image
				</label>
			</div>
			<div class="cf_trigger_option">
				<label>
					<input type="radio" name="<?php echo $captainform_trigger_option_name; ?>" class="cf_trigger" <?php if ($captainform_selected_trigger == 2): ?> checked="checked" <?php endif; ?> value="2" />
					Floating button
				</label>
			</div>
			<div class="cf_trigger_option">
				<label>
					<input type="radio" name="<?php echo $captainform_trigger_option_name; ?>" class="cf_trigger" <?php if ($captainform_selected_trigger == 3): ?> checked="checked" <?php endif; ?> value="3" />
					Auto popup
				</label>
			</div>
		</div>
		<div class="cf_trigger_selected_option_container_big">
			<div class="cf_trigger_selected_option_title">
				Settings
			</div>
			<div class="cf_trigger_selected_option_container cf_trigger_selected_option_cotainter_0">
				<!-- text -->
				<div class="left">
					<span class="label">
						Text: 
					</span>
				</div>
				<div class="right">
					<input type="text" name="<?php echo $captainform_trigger_0_name; ?>" class="cf_trigger_selected_option cf_trigger_0_text" value="<?php echo $captainform_trigger_0_text; ?>"/>	
				</div>
				<div class="clear"></div>
			</div>
			<div class="clear"></div>

			<div class="cf_trigger_selected_option_container cf_trigger_selected_option_cotainter_1">
				<!-- image -->
				<div class="left">
					<span class="label">
						Image : 
					</span>
				</div>
				<div class="right">
					<input type="text" name="<?php echo $captainform_trigger_1_name; ?>" class="cf_trigger_1_url" value="<?php echo $captainform_trigger_1_url; ?>"/>	
				</div>
				<div class="clear"></div>
			</div>
			<div class="clear"></div>

			<div class="cf_trigger_selected_option_container cf_trigger_selected_option_cotainter_2">
				<!-- floating button -->
				<div class="left">
					<span class="label">
						Text: 
					</span>
				</div>
				<div class="right">
					<input type="text" name="<?php echo $captainform_trigger_2_text_name; ?>" class="cf_trigger_2_text"  value="<?php echo $captainform_trigger_2_text; ?>" />
				</div>
				<div class="clear"></div>

				<div class="left">
					<span class="label">
						Position: 
					</span>
				</div>
				<div class="cf_trigger_2_container right">
					<label class = "cf_trigger_2_label">
						<input type="radio" name="<?php echo $captainform_trigger_2_position_name; ?>" class="cf_trigger_2_position" <?php if ($captainform_trigger_2_position == 1): ?> checked="checked" <?php endif; ?> value="1" /> 
						Left
					</label>
					<label class = "cf_trigger_2_label">
						<input type="radio" name="<?php echo $captainform_trigger_2_position_name; ?>" class="cf_trigger_2_position" <?php if ($captainform_trigger_2_position == 2): ?> checked="checked" <?php endif; ?> value="2" /> 
						Right
					</label>
					<label class = "cf_trigger_2_label">
						<input type="radio" name="<?php echo $captainform_trigger_2_position_name; ?>" class="cf_trigger_2_position" <?php if ($captainform_trigger_2_position == 3): ?> checked="checked" <?php endif; ?> value="3" /> 
						Bottom
					</label>
				</div>
				<div class="clear"></div>

				<div class="left">
					<span class="label">
						Background color:
					</span>
				</div>
				<div class="right">
					<input type="text" name="<?php echo $captainform_trigger_2_background_name; ?>" class="color cf_trigger_2_background_color" value="<?php echo $captainform_trigger_2_background; ?>"/>
				</div>
				<div class="clear"></div>

				<div class="left">	
					<span class="label">
						Text color:
					</span>
				</div>
				<div class="right">
					<input type="text" name="<?php echo $captainform_trigger_2_color_name; ?>" class="color cf_trigger_2_color" value="<?php echo $captainform_trigger_2_color; ?>"/>
				</div>
				<div class="clear"></div>
			</div>
			<div class="clear"></div>

			<div class="cf_trigger_selected_option_container cf_trigger_selected_option_cotainter_3">
				<!-- auto popup -->
				<div class="left">
					<span class="label">
						After : 
					</span>
				</div>
				<div class="right">
					<input type="text" name="<?php echo $captainform_trigger_3_after_name; ?>" class="cf_trigger_selected_option cf_trigger_2_time" value="<?php echo $captainform_trigger_3_after; ?>"/> 
					<span class="captainform_seconds">seconds</span>	
				</div>
				<div class="clear"></div>
			</div>
			<div class="clear"></div>
		</div>

	</div>
</div>