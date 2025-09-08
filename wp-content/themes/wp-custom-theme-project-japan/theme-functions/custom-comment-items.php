<?php

$allowed_html = array(
	'a'      => array(
		'href'       => true,
		'title'      => true,
		'target'     => true,
		'class'      => true,
		'rel'        => true,
		'data-*'     => true,
		'aria-label' => true, 
	),
	'br'     => array(),
	'em'     => array(),
	'strong' => array(),
	'span'   => array(),
	'p'      => array(),
	'div'    => array(
		'class' => true,
	),
	'svg'    => array(
		'width'   => true,
		'height'  => true,
		'viewbox' => true,
		'fill'    => true,
		'xmlns'   => true,
	),
	'path'   => array(
		'd'    => true,
		'fill' => true,
	),
);

function comment_custom_template( $comment, $comment_class = '', $depth = 1, $args = array() ) {
	global $allowed_html;

	$comment_id = $comment->comment_ID;
	$post_id    = $comment->comment_post_ID;
	$rating     = get_comment_meta( $comment_id, 'rating', true );

	if ( 'div' === $args['style'] ) {
		$tag       = 'div';
		$add_below = 'comment';
	} else {
		$tag       = 'li ';
		$add_below = 'div-comment';
	}

	$comment_classes = $comment_class . '
		my-3 rounded-lg 
		[&>ul]:ml-8 
		[&>.comment-respond]:rounded-lg 
		[&>.comment-respond]:text-dark 
		[&>.comment-respond]:py-4 
		[&>.comment-respond]:sm:py-6 
		[&>.comment-respond]:lg:px-8 
	';

	if ( empty( $args['has_children'] ) ) {
		$comment_classes .= '[&.odd]:bg-primary-brightest';
	} else {
		$comment_classes .= '[&.odd>div]:bg-primary-brightest';
	}

	?>

	<<?php echo esc_attr( $tag ); ?><?php comment_class( $comment_classes, $comment ); ?> id="comment-<?php echo esc_attr( $comment_id ); ?>">

		<?php if ( 'div' != $args['style'] ) { ?>
			<div id="div-comment-<?php echo esc_attr( $comment_id ); ?>" class="comment-wrapper rounded-lg relative p-4 sm:!py-8 sm:!px-6">
		<?php } ?>

		<div class="comment-content">
			<div class="flex flex-col mb-6 sm:items-center sm:justify-between sm:!flex-row">
				<div class="mb-2 flex items-center sm:mb-0">
					<p class="comment-author font-semibold text-lg">
						<?php echo esc_html( get_comment_author( $comment_id ) ); ?>
					</p>
					<?php if ( function_exists( 'custom_star_rating' ) ) { ?>
						<div class="ml-4 flex gap-x-1">
							<?php
								custom_star_rating(
									array(
										'rating' => $rating,
										'rating_stars_number' => 5,
									)
								);
							?>
						</div>
					<?php } ?>
				</div>

				<p class="text-grizzly-light font-medium text-sm">
					<?php echo esc_html( get_comment_date( get_option( 'date_format' ), $comment_id ) ); ?>
				</p>
			</div>
			<div class="text-base font-normal">
				<?php comment_text( $comment_id ); ?>
			</div>

			<?php
			$is_can_edit_comment = current_user_can( 'edit_comment', $comment_id );
			$reply_link          = get_comment_reply_link(
				array_merge( 
					$args, 
					array( 
						'add_below' => $add_below, 
						'depth'     => $depth, 
						'max_depth' => $args['max_depth'], 
					) 
				),
				$comment_id,
				$post_id 
			);

			if ( $is_can_edit_comment || ! empty( $reply_link ) ) { 
				$edit_link = '<a class="comment-edit-link" href="' . esc_url( get_edit_comment_link( $comment ) ) . '">(' . esc_html__( 'Edit', 'custom-theme' ) . ')</a>';
				
				?>
				<div class="mt-6">  
					<?php echo wp_kses( $edit_link, $allowed_html ); ?>
					<?php echo wp_kses( $reply_link, $allowed_html ); ?>
				</div>

			<?php } ?>

		</div>
	<?php if ( 'div' !== $args['style'] ) { ?>
		</div>
		<?php 
	}
}

function comment_custom( $comment, $args, $depth ) {
	$comment_class = empty( $args['has_children'] ) ? '' : 'parent';

	comment_custom_template( $comment, $comment_class, $depth, $args ); 
}
