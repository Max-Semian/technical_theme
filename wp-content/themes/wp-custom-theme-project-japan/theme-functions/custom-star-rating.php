<?php

function custom_star_rating( $args = array() ) {
	$allowed_star_html = array(
		'div'  => array(
			'class' => true,
		),
		'svg'  => array(
			'width'   => true,
			'height'  => true,
			'viewbox' => true,
			'fill'    => true,
			'xmlns'   => true,
			'class'   => true,
		),
		'g'    => array(
			'mask' => true,
		),
		'mask' => array(
			'id'        => true,
			'style'     => true,
			'maskUnits' => true,
			'x'         => true,
			'y'         => true,
			'width'     => true,
			'height'    => true,
		),
		'path' => array(
			'd'            => true,
			'fill'         => true,
			'fill-rule'    => true,
			'clip-rule'    => true,
			'stroke'       => true,
			'stroke-width' => true,
			'class'        => true,
		),
		'rect' => array(
			'x'      => true,
			'y'      => true,
			'width'  => true,
			'height' => true,
			'fill'   => true,
			'class'  => true,
		),
	);

	$defaults = array(
		'rating'              => 0,
		'echo'                => true,
		'rating_stars_number' => 0,
		'wrapper_classes'     => 'gap-x-1',
		'star_classes'        => '',
	);
	

	$parsed_args = wp_parse_args( $args, $defaults );

	$rating_stars_number = $parsed_args['rating_stars_number'];

	if ( ! $rating_stars_number ) {
		if ( get_option( 'custom_rating_stars_number' ) ) {
			$rating_stars_number = get_option( 'custom_rating_stars_number' );
		} else {
			$rating_stars_number = 5;
		}
	} 

	$rating = (float) str_replace( ',', '.', $parsed_args['rating'] );

	$full_stars = floor( $rating );

	if ( $full_stars > $rating_stars_number ) {
		$full_stars = $rating_stars_number;
		$rating     = $rating_stars_number;
	}

	$half_stars  = ceil( $rating - $full_stars );
	$empty_stars = $rating_stars_number - $full_stars - $half_stars;

	$star_classes = $parsed_args['star_classes'];

	$star_el = '
		<svg
			width="12"
			height="12"
			viewbox="0 0 12 12"
			fill="none"
			xmlns="http://www.w3.org/2000/svg"
			class="' . $star_classes . '"
		>
			<path
				d="M5.30345 0.963523C5.45313 0.502869 6.10483 0.502872 6.25451 0.963528L7.15601 3.7381C7.22294 3.94411 7.41492 4.08359 7.63154 4.08359H10.5489C11.0333 4.08359 11.2347 4.7034 10.8428 4.9881L8.48262 6.70288C8.30737 6.8302 8.23405 7.05588 8.30098 7.26189L9.20249 10.0365C9.35216 10.4971 8.82492 10.8802 8.43307 10.5955L6.07287 8.88071C5.89763 8.75339 5.66033 8.75339 5.48509 8.88071L3.12487 10.5955C2.73302 10.8802 2.20578 10.4971 2.35545 10.0365L3.25698 7.2619C3.32392 7.05588 3.25059 6.8302 3.07535 6.70288L0.715164 4.9881C0.323307 4.7034 0.524694 4.08359 1.00906 4.08359H3.92639C4.14301 4.08359 4.33498 3.94412 4.40192 3.7381L5.30345 0.963523Z"
				fill="currentColor"
			></path>
		</svg>
	';

	$star_half_el = '
		<svg 
			width="12"
			height="12"
			viewbox="0 0 12 12"
			fill="none" 
			xmlns="http://www.w3.org/2000/svg"
			class="' . $star_classes . '"
		>
			<path 
				fill-rule="evenodd" 
				clip-rule="evenodd" 
				d="M5 8.16722V0.381279V0C4.81837 0.0105597 4.64197 0.125455 4.57402 0.344687L3.7141 3.11926C3.65025 3.32528 3.46714 3.46475 3.26052 3.46475H0.47784C0.01583 3.46475 -0.176262 4.08456 0.197509 4.36926L2.44876 6.08404C2.61591 6.21136 2.68586 6.43704 2.62201 6.64306L1.76209 9.41766C1.61932 9.87826 2.12223 10.2614 2.49599 9.97666L4.74728 8.26187C4.82303 8.20417 4.91095 8.17262 5 8.16722Z" 
				class="star active"
				fill="currentColor"
			/>
			<path 
				fill-rule="evenodd" 
				clip-rule="evenodd" 
				d="M5 8.16722V0.381279V0C5.19042 0.0105597 5.37536 0.125455 5.44659 0.344687L6.34812 3.11926C6.41506 3.32528 6.60703 3.46475 6.82365 3.46475H9.74098C10.2253 3.46475 10.4267 4.08456 10.0349 4.36926L7.67469 6.08404C7.49945 6.21136 7.42612 6.43704 7.49306 6.64306L8.39459 9.41766C8.54426 9.87826 8.01702 10.2614 7.62517 9.97666L5.26495 8.26187C5.18553 8.20417 5.09336 8.17262 5 8.16722Z" 
				class="star"
				fill="currentColor"
			/>
		</svg>
	';


	$empty_star_el = '<div class="star">' . $star_el . '</div>';
	$half_star_el  = '<div>' . $star_half_el . '</div>';
	$full_star_el  = '<div class="star active">' . $star_el . '</div>';

	$wrapper_classes = $parsed_args['wrapper_classes'];

	$output  = '<div class="flex ' . $wrapper_classes . '">';
	$output .= str_repeat( $full_star_el, $full_stars );
	$output .= str_repeat( $half_star_el, $half_stars );
	$output .= str_repeat( $empty_star_el, $empty_stars );
	$output .= '</div>';
	 
	if ( $parsed_args['echo'] ) {
		echo wp_kses( $output, $allowed_star_html );
	}
	 
	return $output;
}
