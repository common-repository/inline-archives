<?php
class Inline_Archives_Widget extends WP_Widget
{
	function __construct() {
		parent::WP_Widget('inline_archives', 'Inline Archives', array('description'=>'Inline Archives'));
		$this->widget_options['classname'] = "widget-inline-archives";
	}

	function widget($args, $instance) {
		extract($args);
		$title = @$instance['title'];
		if (empty($title)) $title = $this->name;
		?>
			<?php echo $before_widget; ?>
				<?php echo $before_title. $title. $after_title; ?>
				<ul>
				<?php 
					if (function_exists('inline_archives_get_contents')) {
						inline_archives_get_contents();
					} else {
						wp_get_archives('type=monthly');
					}
				?>
				</ul>
			<?php echo $after_widget; ?>
		<?php
	}

	function update($new_instance, $old_instance) {
		return $new_instance;
	}

	function form($instance) {
	    $title = esc_attr(@$instance['title']);
	    ?>
			<p>
				<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?></label>
				<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
			</p>
		<?php 
	}
}
