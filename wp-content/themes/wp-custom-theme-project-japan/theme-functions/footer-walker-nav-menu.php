<?php
// Safe footer walker (PHP 7/8 compatible).
if ( ! class_exists( 'Footer_Walker_Nav_Menu' ) ) {
    /**
     * Footer_Walker_Nav_Menu
     */
    class Footer_Walker_Nav_Menu extends Walker_Nav_Menu {

        public function start_lvl( &$output, $depth = 0, $args = null ) {
            $indent = ( $depth > 0 ? str_repeat( "\t", $depth ) : '' );
            $classes = 'sub-menu';
            $output .= "\n{$indent}<ul class=\"{$classes}\">\n";
        }

        public function end_lvl( &$output, $depth = 0, $args = null ) {
            $indent = ( $depth > 0 ? str_repeat( "\t", $depth ) : '' );
            $output .= "{$indent}</ul>\n";
        }

        public function start_el( &$output, $item, $depth = 0, $args = null, $id = 0 ) {
            $indent = ( $depth > 0 ? str_repeat( "\t", $depth ) : '' );

            // Depth dependent classes for the <li> itself.
            $custom_classes     = array( 'text-sm', 'font-bold' );
            $custom_class_names = esc_attr( implode( ' ', $custom_classes ) );

            // Passed classes from WP.
            $classes = empty( $item->classes ) ? array() : (array) $item->classes;
            $class_names = esc_attr( implode( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) ) );

            // Open <li>.
            $output .= $indent . '<li id="nav-menu-item-' . $item->ID . '" class="' . $custom_class_names . ' ' . $class_names . '">';

            $link_class_names = 'no-underline duration-200';

            // Build <a> attributes.
            $attributes  = ! empty( $item->attr_title ) ? ' title="' . esc_attr( $item->attr_title ) . '"' : '';
            $attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target ) . '"' : '';
            $attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn ) . '"'    : '';
            $attributes .= ! empty( $item->url )        ? ' href="'   . esc_url( $item->url ) . '"'      : '';
            $attributes .= ' class="menu-link ' . $link_class_names . '"';

            // Guarded access to $args props (can be array or missing props).
            $before      = ( is_object( $args ) && property_exists( $args, 'before' ) ) ? $args->before : '';
            $link_before = ( is_object( $args ) && property_exists( $args, 'link_before' ) ) ? $args->link_before : '';
            $link_after  = ( is_object( $args ) && property_exists( $args, 'link_after' ) ) ? $args->link_after : '';
            $after       = ( is_object( $args ) && property_exists( $args, 'after' ) ) ? $args->after : '';

            $title = apply_filters( 'the_title', $item->title, $item->ID );

            $item_output = sprintf( '%1$s<a%2$s>%3$s%4$s%5$s</a>%6$s', $before, $attributes, $link_before, $title, $link_after, $after );

            // Output item HTML.
            $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
        }

        public function end_el( &$output, $item, $depth = 0, $args = null ) {
            $output .= "</li>\n";
        }
    }
}
