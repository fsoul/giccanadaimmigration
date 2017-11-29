<?php
class Top_Menu_Walker_Nav extends Walker_Nav_Menu {

	function start_lvl( &$output, $depth = 0, $args = array() ) {
		if ( $depth === 0 ) {
			$output .= "\n<ul class=\"dropdown-menu\">\n";
		} else {
			parent::start_lvl( $output, $depth, $args );
		}
	}

	function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
		$item_html = '';
		parent::start_el( $item_html, $item, $depth, $args );

		if ( $item->is_dropdown ) {
			switch ( $depth ) {
				case 0:
					$item_html = str_replace( '<a', '<a class="dropdown-toggle" data-toggle="dropdown"', $item_html );
					break;
				case 1:
					$item_html = str_replace( '<a href="#">', '<a href="javascript:void(0);" class="dropdown-submenu-header">', $item_html );
					break;
			}
		}

		$output .= $item_html;
	}

	function display_element( $element, &$children_elements, $max_depth, $depth = 0, $args, &$output ) {
		if ( $element->current ) {
			$element->classes[] = 'active';
		}

		$element->is_dropdown = ! empty( $children_elements[ $element->ID ] );

		if ( $element->is_dropdown ) {
			switch ( $depth ) {
				case 0:
					$element->classes[] = 'dropdown'; //#top-menu ul li
					break;
				case 1:
					$element->classes[] = 'dropdown-submenu'; //#top-menu ul li ul li
					break;
			}
		}

		parent::display_element( $element, $children_elements, $max_depth, $depth, $args, $output );
	}
}

class Mobile_Top_Menu_Walker_Nav extends Walker_Nav_Menu {

	function start_lvl( &$output, $depth = 0, $args = array() ) {
		$output .= "\n<ul class=\"row\">\n";
	}

	function display_element( $element, &$children_elements, $max_depth, $depth = 0, $args, &$output ) {
		switch ( $depth ) {
			case 0:
				$element->classes[] = 'main-menu-item'; //#top-menu ul li
				break;
		}

		parent::display_element( $element, $children_elements, $max_depth, $depth, $args, $output );
	}
}

class Footer_Menu_Walker_Nav extends Walker_Nav_Menu {

	function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
		$item_html = '';
		parent::start_el( $item_html, $item, $depth, $args );

		$item_html = str_replace( '<a', '<a class="nav-link footer-text footer-nav-item white-link-underline"', $item_html );
		$output .= $item_html;
	}
}