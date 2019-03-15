<?php
echo paginate_links( array(
    'base'         => esc_url_raw( str_replace( 999999999, '%#%', remove_query_arg( 'add-to-cart', get_pagenum_link( 999999999, false ) ) ) ),
    'format'       => '',
    'add_args'     => '',
    'current'      => max( 1, get_query_var( 'paged' ) ),
    'total'        => $wp_query->max_num_pages,
    'prev_text'    => '<i class="fa fa-angle-double-left"></i>',
    'next_text'    => '<i class="fa fa-angle-double-right"></i>',
    'type'         => 'list',
    'end_size'     => 1,
    'mid_size'     => 2
) );
