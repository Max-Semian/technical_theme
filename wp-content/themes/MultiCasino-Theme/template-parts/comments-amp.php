<?php

/**
 * The template for displaying Comments.
 *
 * The area of the page that contains comments and the comment form.
 *
 * @package WordPress
 * @subpackage top10
 * @since top10 1.0
 */

/*
 * If the current post is protected by a password and the visitor has not yet
 * entered the password we will return early without loading the comments.
 */
if (post_password_required()) {
	return;
}
?>

<section id="comments" class="block yMSFpu0QsG">
	<h2 class="ttOKnNStIgHIN">Comments</h2>
	<section class="wGqAvAqEZHHnGjj">
		<?php
		$commenter = wp_get_current_commenter();
		$aria_req = '';
		$html_req = 'required';

		$comments_args = array(
			'fields' => array(
				'author' => '<section class="field"><input id="author" name="author" type="text" maxlength="20" placeholder="Your Name" value="' . esc_attr($commenter['comment_author']) . '" ' . $aria_req . $html_req . ' /></section>',
			),
			'comment_field' => '
				<section class="field">
					<textarea id="comment" name="comment" maxlength="400" placeholder="Leave your comment..." cols="45" rows="8" aria-required="true" required></textarea>
				</section>
				<section class="field">
					<label for="stars">Rate:</label>
				<amp-selector name="stars" required layout="container" class="XRFEmyzhcoTHuWz">
  <div option="5" class="star"></div>
  <div option="4" class="star"></div>
  <div option="3" class="star"></div>
  <div option="2" class="star"></div>
  <div option="1" class="star"></div>
</amp-selector>
				</section>',
			'class_submit' => 'button HKYDfj0abmr',
			'label_submit' => __('Add Comment'),
			'submit_button' => '<section class="buttons wAmpxCjjIPk4zEo"><button name="%1$s" type="submit" id="%2$s" class="%3$s">%4$s</button></section>',
			'comment_notes_before' => '',
			'comment_notes_after'  => '',
		);

		ob_start();
		comment_form($comments_args);
		$output = ob_get_clean();

		// Очистить лишнее
		$output = preg_replace('/<p class="comment-notes">.*<\/p>/', '', $output);
		$output = preg_replace('/<p class="form-allowed-tags">.*<\/p>/', '', $output);
		$output = preg_replace('/<p class="form-submit">.*<\/p>/', '', $output);
		$output = preg_replace('/<h3 id="reply-title".*<\/h3>/', '', $output);
		$output = preg_replace('/<p class="comment-form-cookies-consent">.*<\/p>/', '', $output);

		echo $output;
		?>
	</section>

	<?php if (have_comments()) : ?>
		<section class="TdZwzsdVqxYz">
			<?php
			wp_list_comments(array(
				'style'      => 'ol',
				'short_ping' => true,
				'avatar_size' => 74,
				'callback'   => 'top10_comment', // Используй свой callback
			));
			?>
		</section>

		<?php if (get_comment_pages_count() > 1 && get_option('page_comments')) : ?>
			<nav class="navigation comment-navigation" role="navigation">
				<h1 class="screen-reader-text section-heading"><?php _e('Comment navigation', 'twentythirteen'); ?></h1>
				<section class="nav-previous"><?php previous_comments_link(__('&larr; Older Comments', 'twentythirteen')); ?></section>
				<section class="nav-next"><?php next_comments_link(__('Newer Comments &rarr;', 'twentythirteen')); ?></section>
			</nav>
		<?php endif; ?>

		<?php if (! comments_open() && get_comments_number()) : ?>
			<p class="no-comments"><?php _e('Comments are closed.', 'twentythirteen'); ?></p>
		<?php endif; ?>
	<?php endif; ?>
</section>
<!-- #comments -->
