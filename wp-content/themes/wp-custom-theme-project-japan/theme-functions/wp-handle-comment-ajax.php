<?php

function wp_handle_comment_ajax( $comment_data ) {
	$comment_post_id      = 0;
	$comment_author       = '';
	$comment_author_email = '';
	$comment_author_url   = '';
	$comment_content      = '';
	$comment_parent       = 0;
	$user_id              = 0;
	$is_save_user_data    = false;

	if ( isset( $comment_data['comment_post_ID'] ) ) {
		$comment_post_id = (int) $comment_data['comment_post_ID'];
	}
	if ( isset( $comment_data['comment-form-author'] ) && is_string( $comment_data['comment-form-author'] ) ) {
		$comment_author = trim( strip_tags( $comment_data['comment-form-author'] ) );
	}
	if ( isset( $comment_data['comment-form-email'] ) && is_string( $comment_data['comment-form-email'] ) ) {
		$comment_author_email = trim( $comment_data['comment-form-email'] );
	}
	if ( isset( $comment_data['url'] ) && is_string( $comment_data['url'] ) ) {
		$comment_author_url = trim( $comment_data['url'] );
	}
	if ( isset( $comment_data['comment-form-textarea'] ) && is_string( $comment_data['comment-form-textarea'] ) ) {
		$comment_content = trim( $comment_data['comment-form-textarea'] );
	}   
	if ( isset( $comment_data['is-get-auth-data'] ) ) {
		$is_save_user_data = filter_var( $comment_data['is-get-auth-data'], FILTER_VALIDATE_BOOLEAN );
	}
	if ( isset( $comment_data['comment_parent'] ) ) {
		$comment_parent        = absint( $comment_data['comment_parent'] );
		$comment_parent_object = get_comment( $comment_parent );

		if ( 0 !== $comment_parent 
			&& ( ! $comment_parent_object instanceof WP_Comment 
			|| 0 === (int) $comment_parent_object->comment_approved )
		) {
			/**
			 * Fires when a comment reply is attempted to an unapproved comment.
			 *
			 * @since 6.2.0
			 *
			 * @param int $comment_post_id Post ID.
			 * @param int $comment_parent  Parent comment ID.
			 */
			do_action( 'comment_reply_to_unapproved_comment', $comment_post_id, $comment_parent );

			return new WP_Error( 'comment_reply_to_unapproved_comment', __( 'Sorry, replies to unapproved comments are not allowed.' ), 403 );
		}
	}

	$post = get_post( $comment_post_id );

	if ( empty( $post->comment_status ) ) {

		/**
		 * Fires when a comment is attempted on a post that does not exist.
		 *
		 * @since 1.5.0
		 *
		 * @param int $comment_post_id Post ID.
		 */
		do_action( 'comment_id_not_found', $comment_post_id );

		return new WP_Error( 'comment_id_not_found' );
	}

	// get_post_status() will get the parent status for attachments.
	$status = get_post_status( $post );

	if ( ( 'private' === $status ) && ! current_user_can( 'read_post', $comment_post_id ) ) {
		return new WP_Error( 'comment_id_not_found' );
	}

	$status_obj = get_post_status_object( $status );

	if ( ! comments_open( $comment_post_id ) ) {

		/**
		 * Fires when a comment is attempted on a post that has comments closed.
		 *
		 * @since 1.5.0
		 *
		 * @param int $comment_post_id Post ID.
		 */
		do_action( 'comment_closed', $comment_post_id );

		return new WP_Error( 'comment_closed', __( 'Sorry, comments are closed for this item.' ), 403 );
	} elseif ( 'trash' === $status ) {

		/**
		 * Fires when a comment is attempted on a trashed post.
		 *
		 * @since 2.9.0
		 *
		 * @param int $comment_post_id Post ID.
		 */
		do_action( 'comment_on_trash', $comment_post_id );

		return new WP_Error( 'comment_on_trash' );
	} elseif ( ! $status_obj->public && ! $status_obj->private ) {

		/**
		 * Fires when a comment is attempted on a post in draft mode.
		 *
		 * @since 1.5.1
		 *
		 * @param int $comment_post_id Post ID.
		 */
		do_action( 'comment_on_draft', $comment_post_id );

		if ( current_user_can( 'read_post', $comment_post_id ) ) {
			return new WP_Error( 'comment_on_draft', __( 'Sorry, comments are not allowed for this item.' ), 403 );
		} else {
			return new WP_Error( 'comment_on_draft' );
		}
	} elseif ( post_password_required( $comment_post_id ) ) {

		/**
		 * Fires when a comment is attempted on a password-protected post.
		 *
		 * @since 2.9.0
		 *
		 * @param int $comment_post_id Post ID.
		 */
		do_action( 'comment_on_password_protected', $comment_post_id );

		return new WP_Error( 'comment_on_password_protected' );
	} else {
		/**
		 * Fires before a comment is posted.
		 *
		 * @since 2.8.0
		 *
		 * @param int $comment_post_id Post ID.
		 */
		do_action( 'pre_comment_on_post', $comment_post_id );
	}

	$user = wp_get_current_user();
	
	// approve for admin
	$is_admin_user = current_user_can( 'manage_options' );
	if ( $is_admin_user ) {
		add_filter( 'pre_comment_approved', 'pre_comment_approved_filter', 10, 2 ); 
		function pre_comment_approved_filter( $approved, $commentdata ) {
			return true;
		}
	}
	
	if ( $is_save_user_data ) {
		if ( $user->exists() ) {
			if ( empty( $user->display_name ) ) {
				$user->display_name = $user->user_login;
			}

			$comment_author       = $user->display_name;
			$comment_author_email = $user->user_email;
			$comment_author_url   = $user->user_url;
			$user_id              = $user->ID;

			if ( current_user_can( 'unfiltered_html' ) ) {
				if ( ! isset( $comment_data['_wp_unfiltered_html_comment'] )
					|| ! wp_verify_nonce( $comment_data['_wp_unfiltered_html_comment'], 'unfiltered-html-comment_' . $comment_post_id )
				) {
					kses_remove_filters(); // Start with a clean slate.
					kses_init_filters();   // Set up the filters.
					remove_filter( 'pre_comment_content', 'wp_filter_post_kses' );
					add_filter( 'pre_comment_content', 'wp_filter_kses' );
				}
			}
		} elseif ( get_option( 'comment_registration' ) ) {
			return new WP_Error( 'not_logged_in', __( 'Sorry, you must be logged in to comment.' ), 403 );
		}
	}
	if ( get_option( 'require_name_email' ) && ! $user->exists() ) {
		if ( '' === $comment_author_email || '' === $comment_author ) {
			return new WP_Error( 
				'require_name_email',
				'<strong>' . __( 'Error' ) . ':</strong> ' . __( 'Please fill the required fields.', 'custom-theme' ),
				200 
			);
		} elseif ( ! is_email( $comment_author_email ) ) {
			return new WP_Error( 
				'require_valid_email',
				'<strong>' . __( 'Error' ) . ':</strong> ' . __( 'Please enter a valid email address.', 'custom-theme' ),
				200 
			);
		}
	}

	$commentdata = array(
		'comment_post_ID' => $comment_post_id,
	);

	$commentdata += compact(
		'comment_author',
		'comment_author_email',
		'comment_author_url',
		'comment_content',
		'comment_type',
		'comment_parent',
		'user_id'
	);

	/**
	 * Filters whether an empty comment should be allowed.
	 *
	 * @since 5.1.0
	 *
	 * @param bool  $allow_empty_comment Whether to allow empty comments. Default false.
	 * @param array $commentdata         Array of comment data to be sent to wp_insert_comment().
	 */
	$allow_empty_comment = apply_filters( 'allow_empty_comment', false, $commentdata );
	if ( '' === $comment_content && ! $allow_empty_comment ) {
		return new WP_Error(
			'require_valid_comment', 
			'<strong>' . __( 'Error' ) . ':</strong> ' . __( 'Please type your comment text.', 'custom-theme' ),
			200 
		);
	}

	$check_max_lengths = wp_check_comment_data_max_lengths( $commentdata );
	if ( is_wp_error( $check_max_lengths ) ) {
		return $check_max_lengths;
	}

	$comment_id = wp_new_comment( wp_slash( $commentdata ), true );
	if ( is_wp_error( $comment_id ) ) {
		return $comment_id;
	}

	if ( ! $comment_id ) {
		return new WP_Error(
			'comment_save_error',
			'<strong>' . __( 'Error' ) . ':</strong> ' . __( 'The comment could not be saved. Please try again later.', 'custom-theme' ),
			500 
		);
	}

	return get_comment( $comment_id );
}
