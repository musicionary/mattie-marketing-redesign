<?php 
wp_reset_postdata();
if(comments_open( ) || have_comments()) : ?>
<div class="comments-area">
	<?php if ( post_password_required() ) : ?>
				<p><?php _e( 'This post is password protected. Enter the password to view any comments ', 'credo' ); ?></p>
			</div>

		<?php
		/* Stop the rest of comments.php from being processed,
		 * but don't kill the script entirely -- we still have
		 * to fully load the template.
		 */
		return;
		endif;?>
	<?php 
		$args = array(
		'fields' => apply_filters( 'comment_form_default_fields', array(
			'author' => '<div class="row"><div class="col-md-6"><input name="author" type="text" value="' . esc_attr( $commenter[ 'comment_author' ] ) . '" aria-required="true" placeholder="'.__('Enter your name','credo').'"></div><div class="col-md-6"><span>'.__('Name*','credo').'</span></div></div>',
			'email' => '<div class="row"><div class="col-md-6"><input name="email" type="text" value="' . esc_attr( $commenter[ 'comment_author_email' ] ) . '" aria-required="true" placeholder="'.__('Enter your email','credo').'"></div><div class="col-md-6"><span>'.__('E-mail*','credo').'</span></div></div>',
			'url' => '<div class="row"><div class="col-md-6"><input name="url" type="text" placeholder="'.__('Enter your website','credo').'" value="' . esc_attr( $commenter[ 'comment_author_url' ] ) . '"></div><div class="col-md-6"><span>'.__('Website*','credo').'</span></div></div>'
				)
		),

		'comment_notes_after' => '',
		'comment_notes_before' => '',
		'title_reply' => _x('LEAVE A COMMENT','comment-form','credo'),
		'comment_field' => '<textarea name="comment" placeholder="'.__('Message', 'credo').'"></textarea>',
		'class_submit' => 'submit',
		'label_submit' => _x('Write','comment-form','credo')
		);

    	comment_form( $args );
	?>

	<?php if ( have_comments() ) : ?>
		<h3><?php comments_number( __('No Comments','credo'), __('1 Comment','credo'), '% '.__('Comments','credo') ); ?></h3>
		<div class="comments_navigation page-numbers center">
			<?php paginate_comments_links(array(
			'show_all'     => False,
			'end_size'     => 1,
			'mid_size'     => 2,
			'prev_next'    => True,
			'prev_text'    => '&larr;',
			'next_text'    => '&rarr;',
			'type'         => 'list',
			'add_args'     => False,
			'add_fragment' => ''
		)); ?>
		</div>

		<ul class="comments-area-ul">
			<?php wp_list_comments( array( 'callback' => 'tt_custom_comments' , 'avatar_size'=>'64','style'=>'ul') ); ?>
		</ul>	
	
	<?php endif; ?>

</div>
<?php endif; ?>