<?php
if ( post_password_required() ) {
	return;
}

	$commenter = wp_get_current_commenter();
?>
<div class="relative left-1/2 w-screen -translate-x-2/4" id="comments">
	<!-- Start feedback block-->
	<div class="relative isolate overflow-hidden bg-gray-900 py-16 sm:py-24 lg:py-32">
		<img
			class="absolute inset-0 -z-10 h-full w-full object-cover md:object-center"
			src="<?php bloginfo( 'template_directory' ); ?>/src/assets/images/feedback-bg.webp"
			alt="feedback"
			width="1920"
			height="501"
		/>
		<?php
			$comment_field = '
				<div class="col-span-full">
					<textarea
						class="block w-full rounded-lg border-0 shadow-sm p-6 text-sm placeholder:text-grizzly text-dark"
						id="comment-form-textarea"
						name="comment-form-textarea"
						rows="3"
						required
						placeholder="' . esc_attr__( 'Start writing', 'custom-theme' ) . '"
					></textarea>
				</div>';

			$toggle_admin_field = '
				<div class="col-span-full">
					<label class="relative inline-flex items-center cursor-pointer">
						<input id="is-get-auth-data" name="is-get-auth-data" type="checkbox" value="true" class="sr-only peer" />
						<div
							class="switcher w-11 h-6 bg-gray-200 rounded-full peer peer-focus:outline-none peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[\'\'] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all"
						></div>
						<span class="ms-3 text-sm font-medium">' . esc_html__( 'Save current username and email?', 'custom-theme' ) . '</span>
					</label>
				</div>';

			$author_field = '
				<div class="comment-form-author col-span-3 col-start-1">
					<input
						class="block w-full rounded-lg border-0 shadow-sm p-6 text-sm placeholder:text-grizzly text-dark"
						id="comment-form-author"
						type="text"
						name="comment-form-author"
						required
						placeholder="' . esc_attr__( 'Enter your name', 'custom-theme' ) . '"
						value="' . esc_attr( $commenter['comment_author'] ) . '"
					/>
				</div>';

			$email_field = '
				<div class="comment-form-email col-span-3">
					<input
						class="block w-full rounded-lg border-0 shadow-sm p-6 text-sm placeholder:text-grizzly text-dark"
						id="comment-form-email"
						type="email"
						name="comment-form-email"
						autocomplete="email"
						required
						placeholder="' . esc_attr__( 'Enter your email', 'custom-theme' ) . '"
						value="' . esc_attr( $commenter['comment_author_email'] ) . '"
					/>
				</div>';

				$rating_field = '
					<div class="col-span-2">
						<div class="h-full flex items-center justify-around">';

			$rating_field = '
				<div class="col-span-2">
					<input 
						class="comment-rating-hidden" 
						id="rating" 
						name="rating" 
						type="hidden"
						value=""
					/>
					<div class="h-full flex items-center justify-around">';

		for ( $i = 1; $i <= 5; $i++ ) {
			$rating_field .= '
						<div id="star-' . $i . '" data-value="' . $i . '" class="comment-star text-center cursor-pointer bg-white-opacity py-3 px-4 rounded-lg md:!p-0 md:bg-transparent">
							<div class="star mb-2">
								<svg
									width="24"
									height="24"
									viewbox="0 0 12 12"
									fill="none"
									xmlns="http://www.w3.org/2000/svg"
								>
									<path
										d="M5.30345 0.963523C5.45313 0.502869 6.10483 0.502872 6.25451 0.963528L7.15601 3.7381C7.22294 3.94411 7.41492 4.08359 7.63154 4.08359H10.5489C11.0333 4.08359 11.2347 4.7034 10.8428 4.9881L8.48262 6.70288C8.30737 6.8302 8.23405 7.05588 8.30098 7.26189L9.20249 10.0365C9.35216 10.4971 8.82492 10.8802 8.43307 10.5955L6.07287 8.88071C5.89763 8.75339 5.66033 8.75339 5.48509 8.88071L3.12487 10.5955C2.73302 10.8802 2.20578 10.4971 2.35545 10.0365L3.25698 7.2619C3.32392 7.05588 3.25059 6.8302 3.07535 6.70288L0.715164 4.9881C0.323307 4.7034 0.524694 4.08359 1.00906 4.08359H3.92639C4.14301 4.08359 4.33498 3.94412 4.40192 3.7381L5.30345 0.963523Z"
										fill="currentColor"
									></path>
								</svg>
							</div>
							<span class="text-base font-normal">' . $i . '</span>
						</div>
					';
		}

			$rating_field .= '
					</div>
				</div>';

			$submit_field = '
				<div class="col-span-2">
					<button
						id="comment-form-submit"
						class="main-button relative flex text-base italic font-black w-full disabled:opacity-75"
						type="submit"
						aria-expanded="false"
					>
						<div
							class="background absolute w-full h-full rounded-lg transform -skew-x-12"
						></div>
						%1$s %2$s
					</button>
				</div>
			</div>';

			$comments_args = array(
				'id_form'              => 'comment_form',
				'comment_field'        => '<div class="grid grid-cols-1 gap-y-4 md:!grid-cols-10 md:!gap-y-8 md:!gap-x-6">' . $comment_field,
				'fields'               => array(
					'is-get-auth-data' => $toggle_admin_field,
					'author'           => $author_field,
					'email'            => $email_field,
					'rating'           => $rating_field,
				),
				'submit_field'         => $submit_field,
				'submit_button'        => '<input name="%1$s" type="submit" id="%2$s" class="comment-submit relative uppercase py-5 mx-auto italic cursor-pointer disabled:opacity-75 submit %3$s" value="%4$s" />',
				'title_reply_before'   => '<h5 id="reply-title" class="comment-reply-title text-base font-black italic uppercase mb-6 md:!text-2xl">',
				'title_reply_after'    => '</h5>',
				'title_reply'          => esc_html__( 'Leave a feedback', 'custom-theme' ),
				'title_reply_to'       => esc_html__( 'Leave a Reply to %s', 'custom-theme' ),
				'comment_notes_before' => null,
				'logged_in_as'         => null,
				'label_submit'         => esc_html__( 'Send', 'custom-theme' ),
				'cancel_reply_before'  => '<span class="inline-block ml-1">',
				'cancel_reply_after'   => '</span>',
				'cancel_reply_link'    => esc_html__( ' Cancel', 'custom-theme' ),
				'class_container'      => 'comment-respond mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 text-white',
				'action'               => '',
			);

			comment_form( $comments_args );
			?>
	</div>
	<!-- End feedback block-->

	<!-- Start comments block-->
	<div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
		<div class="comments-wrapper py-10 md:py-14">
			<h5
				class="text-base font-black italic uppercase mb-6 md:!text-2xl"
			>
				<?php esc_html_e( 'Comments', 'custom-theme' ); ?>
			</h5>
			<p class="max-w-3xl text-base mb-6 md:mb-11">
				<?php 
					$default_description = __(
						'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut urna ipsum sagittis auctor
					vitae. Facilisi urna, arcu a tincidunt. Molestie pulvinar mauris, est quis venenatis sed
					eu. Urna in nullam amet mi eu. Vulputate duis sit augue vel tristique ac. Molestie id
					gravida dolor pretium fermentum pharetra ut.<br /><br />Facilisi urna, arcu a tincidunt.
					Molestie pulvinar mauris, est quis venenatis sed eu. Urna in nullam amet mi eu.',
						'custom-theme'
					);

					$allowed_html = array(
						'a'      => array(
							'href'   => true,
							'title'  => true,
							'target' => true,
						),
						'br'     => array(),
						'em'     => array(),
						'strong' => array(),
						'span'   => array(),
						'p'      => array(),
					);
					echo wp_kses(
						! empty( get_theme_mod( 'comments_description' ) ) ?
						get_theme_mod(
							'comments_description',
							$default_description
						) : $default_description,
						$allowed_html 
					);
					?>
			</p>

			<?php 
			if ( have_comments() ) : 
				$max_comments_number = get_option( 'comments_per_page' );

				?>
					<ul class="comment-list">
						<?php
							wp_list_comments(
								array(
									'avatar_size' => 0,
									'style'       => 'ul',
									'callback'    => 'comment_custom',
									'short_ping'  => true,
									'reply_text'  => esc_html__( 'Reply', 'custom-theme' ),
								)
							);
						?>
					</ul>

				<?php 
				$comments_number = get_comments_number();

				if ( $comments_number > $max_comments_number ) {
					?>
					<div class="text-center font-black text-base italic uppercase mt-6">
						<span 
							id="load-comments" 
							class="cursor-pointer"
							data-post-id="<?php echo esc_attr( get_the_ID() ); ?>"
							data-comment-per-page="<?php echo esc_attr( $max_comments_number ); ?>"
							data-comment-all-count="<?php echo esc_attr( $comments_number ); ?>"
						>
							<?php 
								echo esc_html__( 'Show', 'custom-theme' ) . ' ' . esc_html( $max_comments_number ) . ' ' . esc_html__( 'more feedbacks', 'custom-theme' ); 
							?>
						</span>
					</div>
				<?php } ?>

				<?php else : ?>
					<div class="empty-comments text-center font-black text-base italic uppercase mt-6">
						<span>
							<?php esc_html_e( 'No comments', 'custom-theme' ); ?>
						</span>
					</div>
			<?php endif; ?>
		</div>
	</div>
	<!-- End comments block-->
</div>
