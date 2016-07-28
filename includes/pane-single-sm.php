<?php

/**
 * Small (quarter width) single article display widget.
 */
class Huntingslow_Pane_Single_Sm extends WP_Widget {
	/**
	 * Register widget with WordPress.
	 */
	function __construct() {
		parent::__construct(
			'Huntingslow_Pane_Single_Sm', // Base ID
			__('Quarter Strap Article', 'text_domain'), // Name
			array( 'description' => 'Quarter width single article.') // Args
		);
	}

	/**
	 * Front-end display of widget.
	 *
	 * @see WP_Widget::widget()
	 *
	 * @param array $args     Widget arguments.
	 * @param array $instance Saved values from database.
	 */
	function widget( $args, $instance ) {

		// Populate the variables from the saved instance
		$story_URL = $instance['story_URL'];
		// not sure that this is the best point in the logic to do this.
		// possibly better to update on each save
		$story_ID = url_to_postid( $story_URL );
		$display_byline = $instance['display_byline'];
		$display_primary_tag = $instance['display_primary_tag'];
		$display_standfirst = $instance['display_standfirst'];

		$headlines = new WP_Query( array(
			'category_name' => 'news',
			'posts_per_page' => 2
		) );

		// Set up the variables needed for the markup

		// Spit out the markup
    echo $args['before_widget'];
		?>

		<div class="single-sm">
			<h1 class="single-sm__headline">Placeholder headline</h1>
			<p class="single-sm__standfirst">Placeholder standfirst</p>
		</div>

		<?php
    wp_reset_postdata();
		echo $args['after_widget'];
	}
	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 */
	function form( $instance ) {
		// Check values
		if( $instance ) {
			$story_URL = esc_attr( $instance['story_URL'] );
			$display_byline = esc_attr( $instance['display_byline'] );
			$display_primary_tag = esc_attr( $instance['display_primary_tag'] );
			$display_standfirst = esc_attr( $instance['display_standfirst'] );
		} else {
			$story_URL = '';
			$display_byline = '';
			$display_primary_tag = '';
			$display_standfirst = '';
		}  ?>
		<p>
		<label for="<?php echo esc_attr( $this->get_field_id( 'story_URL' ) ); ?>"><?php _e( 'Story URL:', 'wp_widget_plugin' ); ?></label>
		<input id="<?php echo esc_attr( $this->get_field_id( 'story_URL' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'Story URL' ) ); ?>" type="text" value="<?php echo esc_attr( $story_URL ); ?>" />
		</p>

		<p>
		<input id="<?php echo esc_attr( $this->get_field_id( 'display_byline' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'display_byline' ) ); ?>" type="checkbox" value="1" <?php checked( '1', $display_byline ); ?> />
		<label for="<?php echo esc_attr( $this->get_field_id( 'display_byline' ) ); ?>"><?php _e( 'Display byline.', 'wp_widget_plugin' ); ?></label>
		</p>

		<p>
		<input id="<?php echo esc_attr( $this->get_field_id( 'display_primary_tag' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'display_primary_tag' ) ); ?>" type="checkbox" value="1" <?php checked( '1', $display_primary_tag ); ?> />
		<label for="<?php echo esc_attr( $this->get_field_id( 'display_primary_tag' ) ); ?>"><?php _e( 'Display primary tag', 'wp_widget_plugin' ); ?></label>
		</p>

		<p>
		<input id="<?php echo esc_attr( $this->get_field_id( 'display_standfirst' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'display_standfirst' ) ); ?>" type="checkbox" value="1" <?php checked( '1', $display_standfirst ); ?> />
		<label for="<?php echo esc_attr( $this->get_field_id( 'display_standfirst' ) ); ?>"><?php _e( 'Display standfirst', 'wp_widget_plugin' ); ?></label>
		</p>


	<?php
	}

	/**
	 * Sanitize widget form values as they are saved.
	 *
	 * @see WP_Widget::update()
	 *
	 * @param array $new_instance Values just sent to be saved.
	 * @param array $old_instance Previously saved values from database.
	 *
	 * @return array Updated safe values to be saved.
	 */
	 function update($new_instance, $old_instance) {
       $instance = $old_instance;
       // Fields
			 $instance['story_URL'] = strip_tags($new_instance['story_URL']);
			 $instance['display_byline'] = strip_tags($new_instance['display_byline']);
			 $instance['display_primary_tag'] = strip_tags($new_instance['display_primary_tag']);
			 $instance['display_standfirst'] = strip_tags($new_instance['display_standfirst']);

      return $instance;
 }
}