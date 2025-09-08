<?php

function load_comments_ajax_handler() {
	$comment_post_id        = 0;
	$comments_per_page      = 5;
	$comments_current_count = 0;

	$query_params = wp_unslash( $_POST );

	if ( isset( $query_params['post-id'] ) ) {
		$comment_post_id = (int) $query_params['post-id'];
	}
	if ( isset( $query_params['per-page'] ) ) {
		$comments_per_page = (int) $query_params['per-page'];
	}
	if ( isset( $query_params['current-count'] ) ) {
		$comments_current_count = (int) $query_params['current-count'];
	}

	$args = array(
		'post_id'   => $comment_post_id,
		'post_type' => 'page',
		'status'    => 'approve',
		'orderby'   => 'comment_date_gmt',
		'number'    => $comments_per_page,
		'offset'    => $comments_current_count,
	);

	$comments  = get_comments( $args );
	$max_depth = get_option( 'thread_comments_depth' );

	if ( $comments ) {
		foreach ( $comments as $comment ) {
			comment_custom_template(
				$comment,
				'',
				1, // TODO get current comment depth level
				array(
					'avatar_size' => 0,
					'max_depth'   => $max_depth,
					'style'       => 'ul',
					'callback'    => 'comment_custom',
					'short_ping'  => true,
					'respond_id'  => 'respond',
					'reply_text'  => esc_html__( 'Reply', 'custom-theme' ),
				) 
			);
		}
	}

	wp_die();
}

add_action( 'wp_ajax_load_comments', 'load_comments_ajax_handler' );
add_action( 'wp_ajax_nopriv_load_comments', 'load_comments_ajax_handler' );
