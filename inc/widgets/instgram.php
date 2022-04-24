<?php

class Wpc_Instgrame extends WP_Widget
{
    function __construct()
    {
        parent::__construct('wpc_instgrame_widget', 'Wpc_Instgrame', ['description' => 'This Widgets For embeded code for post in instgrame']);
    } //end function

    function widget($args, $instance)
    {
        echo $args['before_widget'];


        //apply filter in title
        $title = apply_filters('widget_title', $instance['title']);
        if (!empty($title)) {
            echo $args['before_title'] . $title . $args['after_title'];
        }

         echo $instance['empded_code']  ;   

        echo $args['after_widget'];
    } //end function

    function form($instance)
    {
        // field title name in widget
        if (isset($instance['title'])) {
            $title = $instance['title'];
        } else {
            $title = 'Instagram Feed';
        }

        if (isset($instance['empded_code'])) {
            $empded_code = $instance['empded_code'];
        } else {
            $empded_code = 'Please embeded code here..';
        }

?>
        <!-- field title name in widget -->
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"> Widget Title</label>
            <input id="<?php echo $this->get_field_id('title'); ?>" type="text" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo esc_attr($title); ?>">
        </p>

        <p>
            <label for="<?php echo $this->get_field_id('empded_code'); ?>"> Widget Embeded Code</label>
            <textarea id="<?php echo $this->get_field_id('empded_code'); ?>" type="text" name="<?php echo $this->get_field_name('empded_code'); ?>" value="<?php echo esc_attr($empded_code); ?>"></textarea>
        </p>

<?php

    } //end function

    // update widgets field
    function update($new_instance, $old_instance)
    {
        $new_data = [];
        $new_data['title'] = (!empty($new_instance['title'])) ? strip_tags($new_instance['title']) : $old_instance['title'];
        $new_data['empded_code'] = (!empty($new_instance['empded_code'])) ? $new_instance['empded_code'] : $old_instance['empded_code'];

    
        return $new_data;
    } //end function

} //end class





