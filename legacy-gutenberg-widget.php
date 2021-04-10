<?php
class Gutenberg_Legacy_Test_Widget extends WP_Widget {
	public function __construct() {
		parent::__construct(
			'gutenberg',
			__( 'Legacy Gutenberg Test Widget' ),
			array(
				'description'                 => __( 'Displays a legacy Gutenberg Test Widget' ),
				'customize_selective_refresh' => true,
			)
		);
	}

	public function widget( $args, $instance ) {
		$title = empty( $instance['title'] ) ? '' : $instance['title'];
		/** This filter is documented in wp-includes/widgets/class-wp-widget-pages.php */
		$title = apply_filters( 'widget_title', $title, $instance, $this->id_base );

		echo $args['before_widget']; // phpcs:ignore WordPress.Security.EscapeOutput
		if ( $title ) {
			echo $args['before_title'] . $title . $args['after_title']; // phpcs:ignore WordPress.Security.EscapeOutput
		}
		printf( '<p>%s</p>', esc_html__( 'Just a legacy Gutenberg test widget.') );
		echo $args['after_widget']; // phpcs:ignore WordPress.Security.EscapeOutput
	}

	public function update( $new_instance, $old_instance ) {
		$instance = array( 'title' => sanitize_text_field( $new_instance['title'] ) );

		return $instance;
	}

	public function form( $instance ) {
		$options = array(
			'dropdown'   => array( 'string' => __( 'Displays as a dropdown' ), 'default' => 0 ),
			'show_names' => array( 'string' => __( 'Displays language names' ), 'default' => 1 ),
			'show_flags' => array( 'string' => __( 'Displays flags', ), 'default' => 0 ),
		);
		$instance = wp_parse_args( (array) $instance, array_merge( array( 'title' => '' ), wp_list_pluck( $options, 'default' ) ) );
		printf(
			'<p><label for="%1$s">%2$s</label><input class="widefat" id="%1$s" name="%3$s" type="text" value="%4$s" /></p>',
			esc_attr( $this->get_field_id( 'title' ) ),
			esc_html__( 'Title:' ),
			esc_attr( $this->get_field_name( 'title' ) ),
			esc_attr( $instance['title'] )
		);
		foreach ( wp_list_pluck( $options, 'string' ) as $key => $str ) {
			$field_id = esc_attr( $this->get_field_id( $key ) );
			$field_name = esc_attr( $this->get_field_name( $key ) );

			printf(
				'<div%5$s%6$s><input type="checkbox" class="checkbox %7$s" id="%1$s" name="%2$s"%3$s /><label for="%1$s">%4$s</label></div>',
				esc_attr( $this->get_field_id( $key ) ),
				esc_attr( $this->get_field_name( $key ) ),
				checked( $instance[ $key ], true, false ),
				esc_html( $str ),
				in_array( $key, array( 'show_names', 'show_flags' ) ) ? sprintf( ' class="no-dropdown-%s"', esc_attr( $this->id ) ) : '',
				( ! empty( $instance['dropdown'] ) && in_array( $key, array( 'show_names', 'show_flags' ) ) ? ' style="display:none;"' : '' ),
				esc_attr( 'gutenberg-' . $key )
			);
		}

	}

}

function gutenberg_register_legacy_test_widget() {
	register_widget( 'Gutenberg_Legacy_Test_Widget' );
}
add_action( 'widgets_init', 'gutenberg_register_legacy_test_widget' );

function gutenberg_legacy_test_widget_enqueue_script() {
	wp_enqueue_script( 'gutenberg_legacy_widgets', WPMU_PLUGIN_URL . '/legacy-gutenberg-widget.js', array( 'jquery' ), '1.0.0', true );
}
add_action( 'admin_enqueue_scripts', 'gutenberg_legacy_test_widget_enqueue_script' );
