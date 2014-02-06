<?php
/**
 * Widget Muffin Twitter
 *
 * @package Kora
 * @author Muffin group
 * @link http://muffingroup.com
 */

class Mfn_Twitter_Widget extends WP_Widget {

	
	/* ---------------------------------------------------------------------------
	 * Constructor
	 * --------------------------------------------------------------------------- */
	function Mfn_Twitter_Widget() {
		$widget_ops = array( 'classname' => 'widget_mfn_twitter', 'description' => __( 'Use this widget on pages to display photos from Twitter photostream.', 'mfn-opts' ) );
		$this->WP_Widget( 'widget_mfn_twitter', __( 'Muffin Twitter', 'mfn-opts' ), $widget_ops );
		$this->alt_option_name = 'widget_mfn_twitter';
	}
	
	
	/* ---------------------------------------------------------------------------
	 * Outputs the HTML for this widget.
	 * --------------------------------------------------------------------------- */
	function widget( $args, $instance ) {

		if ( ! isset( $args['widget_id'] ) ) $args['widget_id'] = null;
		extract( $args, EXTR_SKIP );

		echo $before_widget;
		
		$title = apply_filters( 'widget_title', $instance['title'], $instance, $this->id_base);
		if( $title ) echo $before_title . $title . $after_title;
		
		echo '<div class="Twitter">';
			echo '<ul id="twitter_update_list"><li>Twitter feed loading...</li></ul>';
			echo '<script src="http://twitter.com/javascripts/blogger.js"></script>';
			echo '<script src="https://api.twitter.com/1/statuses/user_timeline/'. $instance['userID'] .'.json?callback=twitterCallback2&amp;count='. $instance['count'] .'"></script>';
		echo '</div>';

		echo $after_widget;
	}


	/* ---------------------------------------------------------------------------
	 * Deals with the settings when they are saved by the admin.
	 * --------------------------------------------------------------------------- */
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['userID'] = strip_tags( $new_instance['userID'] );
		$instance['count'] = (int) $new_instance['count'];
		
		return $instance;
	}

	
	/* ---------------------------------------------------------------------------
	 * Displays the form for this widget on the Widgets page of the WP Admin area.
	 * --------------------------------------------------------------------------- */
	function form( $instance ) {
		
		$title = isset( $instance['title']) ? esc_attr( $instance['title'] ) : '';
		$userID = isset( $instance['userID']) ? esc_attr( $instance['userID'] ) : 'Muffin_Group';
		$count = isset( $instance['count'] ) ? absint( $instance['count'] ) : 2;

		?>
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php _e( 'Title:', 'mfn-opts' ); ?></label>
				<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
			</p>
			
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'userID' ) ); ?>"><?php _e( 'Twitter Username:', 'mfn-opts' ); ?></label>
				<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'userID' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'userID' ) ); ?>" type="text" value="<?php echo esc_attr( $userID ); ?>" />
			</p>
			
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'count' ) ); ?>"><?php _e( 'Number of tweets:', 'mfn-opts' ); ?></label>
				<input id="<?php echo esc_attr( $this->get_field_id( 'count' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'count' ) ); ?>" type="text" value="<?php echo esc_attr( $count ); ?>" size="3"/>
			</p>
		<?php
	}
}
?>