
<!-- Pagination -->
 <div class="page-pagination">
<?php
    global $tt_query;
    global $wp_query;
    if(!empty($tt_query))
        $total_pages = $tt_query->max_num_pages;
    else
        $total_pages = $wp_query->max_num_pages;
	$big = 999999999; // need an unlikely integer
	if ( get_query_var('paged') ) 
        { $paged = get_query_var('paged'); }
    elseif ( get_query_var('page') ) 
        { $paged = get_query_var('page'); }
    else { $paged = 1; }
	if ( $total_pages > 1 ) {
		$current_page = $paged;
		$args = array(
			'base' 		   => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
			'format' 	   => '/page/%#%',
			'total'        => $total_pages,
			'current'      => $current_page,
			'show_all'     => False,
			'end_size'     => 1,
			'mid_size'     => 2,
			'prev_next'    => True,
			'prev_text'    => '<',
			'next_text'    => '>',
			'type'         => 'list',
			'add_args'     => False,
			'add_fragment' => ''
		);
		echo paginate_links( $args );
	}
?>
</div>